<?php

use PEAR2\Net\RouterOS;

class NetworkAccessLogsRpc
{
    public function handleRequest(RpcRequest $request): RpcResult
    {
        switch ($request->action) {
            case 'sync':
                return $this->sync($request->params);
            case 'terminateLog':
                return $this->terminateLog($request->params);
            case 'startLog':
                return $this->startLog($request->params);
            case 'status':
                return $this->status($request->params);
            default:
                return new RpcResult(false, "Unknown action: {$request->action}");
        }
    }
    /**
     * @param mixed $params
     */
    private function status($params): RpcResult
    {
        $message = "Server status";
        $result = [
            "time" => date("Y-m-d H:i:s"),
            "zone" => date_default_timezone_get()
        ];

        return new RpcResult(true, $message, $result);
    }

    /**
     * @param $params Array of user log data
     *      - username customer username
     *      - service  service type
     *      - ip customer ip address
     *      - mac  customer mac address
     * @return RpcResult
     */
    private function startLog($params): RpcResult
    {
        $customer = Customer::getByAttribute("username", $params["username"]);

        if(empty($customer)) {
            return new RpcResult(false, "Customer not found!");
        }

        Customer::update($customer["id"], ["ip_address" => $params["ip"]]);
        $plan = UserRecharge::getByCustomer($customer["id"]);
        $original = HotspotPlan::getById($plan["plan_id"]);
        $log = NetworkAccessLog::create([
            "service" => $params["service"],
            "router" => $original["routers"],
            "plan" => $original["name_plan"],
            "active" => true,
            "start" => $params["start"],
            "ip" => $params["ip"],
            "mac" => $params["mac"],
            "upload" => Conversions::bytesToReadable(0),
            "download" => Conversions::bytesToReadable(0),
            "total" => Conversions::bytesToReadable(0),
            "customer" => $customer["id"],
        ]);

        return new RpcResult(true, "Log started!", $log["id"]);
    }

    /**
     * @param $params  Associative array containing params
     *
     *    - customer:  customer id
     *    - service:   the service to which this customer is connected
     * @return RpcResult
     */
    private function terminateLog($params): RpcResult
    {
        $end = date("Y-m-d H:i:s");
        NetworkAccessLog::update($params["id"], [
            "active" => false,
            "end" => $end,
        ]);

        return new RpcResult(true, "Log terminated!");
    }
    /**
     * @return void
     * @param mixed $id
     * @param mixed $data
     */
    private function updateLog($id, $data): void
    {
        $log = NetworkAccessLog::find($id);
        $update = [
            "upload" => $data["upload"],
            "download" => $data["download"],
            "total" => $data["total"],
            "uptime" => $data["uptime"],
        ];
        NetworkAccessLog::update($id, $update);
    }

    /**
     * @return RpcResult
     */
    private function sync(): RpcResult
    {
        $active_logs = array_reduce(NetworkAccessLog::findActive(), function ($list, $log) {
            $customer = Customer::getById($log["customer"]);
            $list[$customer["username"]] = $log;
            return $list;
        }, []);

        $connected_devices = array_reduce(Router::getAllEnabled(), function ($list, $router) {
            $list = array_merge($list, $this->fetchActivePPPUsers($router));
            $list = array_merge($list, $this->fetchActiveHotSpotUsers($router));
            return $list;
        }, []) ;

        // Check connected devices and update/create logs
        foreach ($connected_devices as $username => $data) {
            $customer = Customer::getByAttribute("username", $username);
            if (array_key_exists($username, $active_logs)) {
                $log = $active_logs[$username];
                Customer::update($customer["id"], ["ip_address" => $log["ip"], "online"=>true]);
                $this->updateLog($log["id"], $data);
            } else {
                $result = $this->startLog([
                    "username" => $data["username"],
                    "service" => $data["service"],
                    "ip" => $data["ip"],
                    "mac" => $data["mac"],
                    "start" => $this->calculateSessionStart($data["uptime"])
                ]);
                if ($result->success) {
                    Customer::update($customer["id"], ["ip_address" => $log["ip"], "online"=>true]);
                    $this->updateLog($result->result, $data);
                }
            }
        }

        foreach ($active_logs as $key => $log) {
            if ($log['active'] && !array_key_exists($key, $connected_devices)) {
                $customer = Customer::getByAttribute("username", $key);
                Customer::update($customer["id"], ["online"=>false]);
                $this->terminateLog(["id" => $log["id"]]);
            }
        }

        NetworkAccessLog::rotate();
        return new RpcResult(true, "Logs synced!");
    }
    /**
     * @return array<int,array<string,mixed>>
     * @param mixed $router
     */
    private function fetchActiveHotSpotUsers($router): array
    {
        global $routes;
        $client = Mikrotik::getClient($router['ip_address'], $router['username'], $router['password']);
        $hotspotActive = $client->sendSync(new RouterOS\Request('/ip/hotspot/active/print'));

        $hotspotList = [];
        foreach ($hotspotActive as $hotspot) {
            $username = $hotspot->getProperty('user');
            $address = $hotspot->getProperty('address');
            $uptime = $hotspot->getProperty('uptime');
            $server = $hotspot->getProperty('server');
            $mac = $hotspot->getProperty('mac-address');
            $sessionTime = $hotspot->getProperty('session-time-left');
            $rxBytes = $hotspot->getProperty('bytes-in');
            $txBytes = $hotspot->getProperty('bytes-out');

            $hotspotList[] = [
                'router' => $router["name"],
                'username' => $username,
                'ip' => $address,
                'uptime' => $uptime,
                'service' => "Hotspot",
                'mac' => $mac,
                'upload' => Conversions::bytesToReadable($rxBytes),
                'download' => Conversions::bytesToReadable($txBytes),
                'total' => Conversions::bytesToReadable($txBytes + $rxBytes),
            ];
        }
        return $hotspotList;
    }

    /**
     * @return array<int,array<string,mixed>>
     * @param mixed $router
     */
    private function fetchActivePPPUsers($router): array
    {
        $client = Mikrotik::getClient($router['ip_address'], $router['username'], $router['password']);
        $pppUsers = $client->sendSync(new RouterOS\Request('/ppp/active/print'));
        $interfaceTraffic = $client->sendSync(new RouterOS\Request('/interface/print'));
        $interfaceData = [];
        foreach ($interfaceTraffic as $interface) {
            $name = $interface->getProperty('name');
            if (empty($name)) {
                continue;
            }

            $interfaceData[$name] = [
                'txBytes' => intval($interface->getProperty('tx-byte')),
                'rxBytes' => intval($interface->getProperty('rx-byte')),
            ];
        }

        $userList = [];
        foreach ($pppUsers as $pppUser) {
            $username = $pppUser->getProperty('name');
            if(empty($username)) {
                continue;
            }
            $address = $pppUser->getProperty('address');
            $uptime = $pppUser->getProperty('uptime');
            $service = $pppUser->getProperty('service');
            $callerid = $pppUser->getProperty('caller-id');

            // Retrieve user usage based on interface name
            $interfaceName = "<pppoe-$username>";

            if (isset($interfaceData[$interfaceName])) {
                $trafficData = $interfaceData[$interfaceName];
                $txBytes = $trafficData['txBytes'];
                $rxBytes = $trafficData['rxBytes'];
            } else {
                $txBytes = 0;
                $rxBytes = 0;
            }

            $userList[$username] = [
                "router" => $router["name"],
                'username' => $username,
                'ip' => $address,
                'uptime' => $uptime,
                'service' => "PPPOE",
                'mac' => $callerid,
                'upload' => Conversions::bytesToReadable($txBytes),
                'download' => Conversions::bytesToReadable($rxBytes),
                'total' => Conversions::bytesToReadable($txBytes + $rxBytes),
            ];
        }
        return $userList;
    }
    /**
     * @return string|bool
     * @param mixed $uptime
     */
    private function calculateSessionStart($uptime): string
    {
        // Define the regex pattern to match the uptime string
        $pattern = '/(?:(\d+)d)?(?:(\d+)h)?(?:(\d+)m)?(?:(\d+)s)?/';

        // Match the pattern against the provided uptime string
        preg_match($pattern, $uptime, $matches);

        // Initialize the time components
        $days = isset($matches[1]) ? (int)$matches[1] : 0;
        $hours = isset($matches[2]) ? (int)$matches[2] : 0;
        $minutes = isset($matches[3]) ? (int)$matches[3] : 0;
        $seconds = isset($matches[4]) ? (int)$matches[4] : 0;

        // Convert all time components to seconds
        $totalSeconds = ($days * 86400) + ($hours * 3600) + ($minutes * 60) + $seconds;

        // Get the current timestamp
        $currentTimestamp = time();

        // Calculate the start timestamp
        $startTimestamp = $currentTimestamp - $totalSeconds;

        // Return the start time in a readable format
        return date('Y-m-d H:i:s', $startTimestamp);
    }
}

