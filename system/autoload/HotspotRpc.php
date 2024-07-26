<?php

function nullify($data, $props)
{
    foreach ($props as $prop) {
        if ($data[$prop]) {
            $data[$prop] = null;
        }
    }
    return $data;
}

function formatPhoneNumber($phoneNumber)
{
    // Remove any non-digit characters from the phone number
    $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

    // Check if the phone number matches Kenyan formats
    if (preg_match('/^(?:\+?254|0)(\d{9})$/', $phoneNumber, $matches)) {
        // Extract the digits and format with '254' prefix
        $formattedNumber = '254' . $matches[1];
        return $formattedNumber;
    } else {
        // Invalid phone number format
        return null;
    }
}

class HotspotRpc
{
    public function handleRequest(RpcRequest $request): RpcResult
    {
        if ($request->params["phoneNumber"]) {
            $phoneNumber = formatPhoneNumber($request->params["phoneNumber"]);
            if ($phoneNumber == null) {
                return new RpcResult(false, "Invalid parameters");
            }
            $request->params["phoneNumber"] = $phoneNumber;
        }
        switch ($request->action) {
            case 'status':
                return $this->status($request->params);
            case 'registerCustomer':
                return $this->registerCustomer($request->params);
            case 'purchasePlan':
                return $this->purchasePlan($request->params);
            case 'getCustomer':
                return $this->getCustomer($request->params);
            case 'connectCustomer':
                return $this->connectCustomer($request->params);
            case 'activatePlan':
                return $this->activatePlan($request->params);
            default:
                return new RpcResult(false, "Unknown action: {$request->action}");
        }
    }

    /**
     * get server status
     *
     * @return RpcResult
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
     * get the customer identified by username and password
     * @params array
     *   - 'username' (string): Username.
     *   - 'password' (string): Password
     * @return RpcResult
     * @param mixed $params
     */
    private function getCustomer($params): RpcResult
    {
        $customer = Customer::getByAttribute("username", formatPhoneNumber($params["username"]));

        if (empty($customer)) {
            return new RpcResult(false, "Invalid Username or Password", [$customer, $params]);
        }
        $plans = UserRecharge::getByCustomer($customer["id"]);
        $customer["plans"] = $plans;
        return new RpcResult(true, "Customer found", nullify($customer, ["password", "pppoe_password"]));
    }

    /**
     * Registers a new customer with the provided details.
     *
     * @param array $params An associative array containing parameters:
     *   - 'phoneNumber' (string): The phone number of the customer.
     *   - 'macAddress' (string): The MAC address associated with the customer's device.
     *
     * @return RpcResult
     */
    private function registerCustomer($params): RpcResult
    {
        $found = Customer::getByAttribute("username", $params["phoneNumber"]);
        if ($found) {
            return new RpcResult(false, "Customer exists!");
        }

        $customer = Customer::create([
            "username" => $params["phoneNumber"],
            "password" => $params["macAddress"],
            "email" => $params["phoneNumber"] . "@anon.com",
            "pppoe_password" => $params["macAddress"],
            "fullname" => $params["phoneNumber"],
            "phonenumber" => $params["phoneNumber"],
            "service_type" => "Hotspot",
        ]);

        if ($customer) {
            $customer["password"] = null;
            $customer["pppoe_password"] = null;
            return new RpcResult(true, "Customer created", $customer);
        }
    }

    /**
     * connects the user to the network.
     * @param array $params An associative array containing parameters:
     *   - 'username' (string): The phone number of the customer.
     *   - 'password' (string): The MAC address associated with the customer's device.
     *   - 'macAddress' (string): The MAC address associated with the customer's device.
     *   - 'ipAddress' (string): The ip address associated with the customer's device.
     *
     * @return RpcResult
     */
    private function connectCustomer($params): RpcResult
    {
        $ipAddress = $params['ipAddress'];
        $macAddress = $params['macAddress'];

        $customer = Customer::getByAttribute("phonenumber", formatPhoneNumber($params["username"]));

        if (empty($customer)) {
            return new RpcResult(false, "Invalid username or password!");
        }

        $recharge = UserRecharge::getByCustomer($customer["id"]);

        if (! $recharge || $recharge["status"] == "off") {
            return new RpcResult(false, "User does not have an active plan!", $recharge);
        }

        $plan = HotspotPlan::getById($recharge["plan_id"]);
        try {
            $device = Package::getDevice($plan);
            require_once($device);

            $router  = new MikrotikHotspot();
            $router->add_customer($customer, $plan);
            $router->connect_customer($customer, $ipAddress, $macAddress, $plan["routers"]);

            return new RpcResult(true, "User connected!");
        } catch (\Exception $e) {
            return new RpcResult(false, "Could not connect user!", $e);
        }
    }

    /**
     * Request deposit & activate plan
     * @param array $params An associative array containing parameters:
     *   - phoneNumber (string): The username of the customer.
     *   - macAddress' (string): The MAC address associated with the customer's device.
     *   - ipAddress' (string): The MAC address associated with the customer's device.
     *   - planId (number): The name of the hotspot plan
     * @return RpcResult
     */
    private function purchasePlan($params): RpcResult
    {
        // stk push
        try {
            $customer = Customer::getByAttribute("username", $params["phoneNumber"]);

            if (! $customer) {
                $this->registerCustomer($params);
                $customer = Customer::getByAttribute("username", $params["phoneNumber"]);
            }

            Customer::update($customer["id"], [
                "ip_address" => $params["ipAddress"],
                "mac_address" => $params["macAddress"]
            ]);

            $plan = HotspotPlan::getById($params["planId"]);

            if (empty($plan)) {
                return new RpcResult(false, "Could not find plan!");
            }

            $router = Router::getByName($plan["routers"]);

            $push = new StkPush();
            $trx_id = $this->generateHash($customer["phonenumber"]);

            $params = [
                "phone" => $customer["phonenumber"],
                "amount" => intval($plan["price"]),
            ];

            $config = ORM::for_table('tbl_appconfig')
                        ->where_like('setting', '%MPESA%')
                        ->find_many();
            foreach ($config as $c) {
                if (preg_match("/^MPESA/i", $c["setting"])) {
                    $params[$c["setting"]] = $c["value"];
                }
            }
            list($response, $time) = $push->initiate($params, $trx_id, "Hotspot");
            $result = json_decode($response);

            if ($result->errorCode || $result->ResponseCode != 0) {
                return new RpcResult(false, "Could not request payment!", $result, $params);
            }
            $payment = ORM::for_table("tbl_payment_gateway")->create();
            $payment->username = $customer["username"];
            $payment->gateway = 'MPESA';
            $payment->plan_id = $plan["id"];
            $payment->plan_name = $plan["name_plan"];
            $payment->routers_id = $router["id"];
            $payment->routers = $router["name"];
            $payment->price = $plan["price"];
            $payment->payment_method = 'MPESA';
            $payment->payment_channel = 'M-Pesa StkPush';
            $payment->pg_request = null;
            $payment->pg_paid_response = null;
            $payment->created_date = date('Y-m-d H:i:s');
            $payment->paid_date = null;
            $payment->status = 1;
            $payment->gateway_trx_id = $trx_id;
            $payment->pg_url_payment = $time;
            $payment->pg_request = $customer["id"];
            $payment->expired_date = date('Y-m-d H:i:s', strtotime("+5 minutes"));
            $payment->save();

            return new RpcResult(true, "Requested mpesa payment!");
        } catch (\Exception $e) {
            return new RpcResult(false, "Could not request payment!", $e);
        }
    }
    /**
     * Generate a hash from a phone number and the current time.
     *
     * @param string $phoneNumber The Kenyan phone number in the format 254XXXXXXXXX.
     * @return string The first 6 digits of the hash or an error message if the format is invalid.
     */
    private function generateHash(string $phoneNumber): string
    {
        if (!preg_match('/^254\d{9}$/', $phoneNumber)) {
            return "Invalid phone number format.";
        }

        $currentTime = date('YmdHis');
        $combinedString = $phoneNumber . $currentTime;
        $hashedString = hash('sha256', $combinedString);

        return strtoupper(substr($hashedString, 0, 6));
    }

    /**
     * Record a deposit.
     * @param array $params An associative array containing parameters:
     *   - 'data' (string): data from mpesa callback
     * @return RpcResult
     * @param mixed $data
     */
    private function activatePlan($data): RpcResult
    {
        $payment = ORM::for_table('tbl_payment_gateway')
            ->where('gateway_trx_id', $data["CheckoutRequestID"])
            ->where('status', 1)
            ->find_one();

        if (!$payment) {
            return new RpcResult(false, "Usuccsessful payment!");
        }

        if ($data["ResultCode"] != 0) {
            $payment->status = 3;
            $payment->save();
            return new RpcResult(false, "Usuccsessful payment!");
        }

        $meta = $data["CallbackMetadata"];
        $receipt = $meta["Item"][1]["Value"];
        $customer = Customer::getByAttribute("phonenumber", $payment["username"]);
        $payment->payment_method = "MPESA-" . $receipt;
        $payment->pg_paid_response = json_encode($data);
        $payment->pg_request = $meta["Item"][4]["Value"];
        $payment->paid_date = date('Y-m-d H:i:s');
        $payment->status = 2;
        $payment->save();

        $next_plan = HotspotPlan::getById($payment["plan_id"]);

        if (empty($next_plan)) {
            return new RpcResult(false, "Unknown plan!");
        }

        $current_plan = UserRecharge::getByCustomer($customer["id"]);

        require_once(
            Package::getDevice($next_plan)
        );

        try {
            $router = new MikrotikHotspot();
            $router->add_customer($customer, $next_plan);
            $router->connect_customer($customer, $customer["ip_address"], $customer["mac_address"], $next_plan["routers"]);
        } catch (\Exception $e) {
            return new RpcResult(false, "Could not purchase plan!", [$customer, $next_plan["routers"]]);
        }

        UserRecharge::setStatus($current_plan["id"], "off");
        // record the current plan as a recharge
        $expiry = getExpirationData($next_plan["validity"], $next_plan["validity_unit"]);
        $time = date("H:i:s");

        UserRecharge::create([
            "customer_id" => $customer["id"],
            "username" => $customer["username"],
            "plan_id" => $next_plan["id"],
            "namebp" => $next_plan["name_plan"],
            "recharged_on" => date("Y-m-d"),
            "recharged_time" => $time,
            "expiration" => $expiry["date"],
            "time" => $expiry["time"],
            "status" => "on",
            "method" => "MPESA-" . $receipt,
            "routers" => $next_plan["routers"],
            "type" => $next_plan["type"]
        ]);

        // record the transaction
        Transaction::create([
            "username" => $customer["username"],
            "plan_name" => $next_plan["name_plan"],
            "price" => $next_plan["price"],
            "recharged_on" => date("Y-m-d"),
            "recharged_time" => $time,
            "expiration" => $expiry["date"],
            "time" => $expiry["time"],
            "method" => "MPESA-" . $receipt,
            "routers" => $next_plan["routers"],
            "type" => $next_plan["type"]
        ]);

        return new RpcResult(true, "Purchased plan!");
    }
}

function getExpirationData($offset, $unit)
{
    // Create a DateTime object with the current date and time
    $dateTime = new DateTime();

    // Determine the interval to add based on the unit
    switch (strtolower($unit)) {
        case 'mins':
        case 'minutes':
            $interval = new DateInterval("PT{$offset}M");
            break;
        case 'hrs':
        case 'hours':
            $interval = new DateInterval("PT{$offset}H");
            break;
        case 'days':
            $interval = new DateInterval("P{$offset}D");
            break;
        case 'months':
            $interval = new DateInterval("P{$offset}M");
            break;
        default:
            throw new Exception("Invalid unit provided. Use 'mins', 'hrs', 'days', or 'months'.");
    }

    $dateTime->add($interval);

    $expirationData = [
        'date' => $dateTime->format('Y-m-d'),
        'time' => $dateTime->format('H:i:s')
    ];

    return $expirationData;
}
