<?php

use PEAR2\Net\RouterOS;
use PEAR2\Net\RouterOS\Client;
use PEAR2\Net\RouterOS\Request;

class NetworkAccessLogsRpc {

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
     * @return RpcResult
     */
    private function sync(): RpcResult {
        return new RpcResult(false, "Could not sync logs");
    }

    /**
     * @return RpcResult
     */
    private function startLog(): RpcResult {
        return new RpcResult(false, "Could not start log");
   }

    /**
     * @return RpcResult
     */
    private function terminateLog():RpcResult {
        return new RpcResult(false, "Could not terminate log");
    }

    private function getPPPUsers($router) {
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
        }  else {
            $txBytes = 0;
            $rxBytes = 0;
        }

        $userList[] = [
            'username' => $username,
            'address' => $address,
            'uptime' => $uptime,
            'service' => $service,
            'caller_id' => $callerid,
            'tx' => $txBytes,
            'rx' => $rxBytes,
            'total' => $txBytes + $rxBytes,
        ];
    }
    return $userList;
    }

}
