<?php

class AutoRecharge
{
    public function handleRequest(RpcRequest $request): RpcResult
    {
        switch ($request->action) {
            case 'status':
                return $this->status($request->params);
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
     * @param mixed $customer
     * @param mixed $data
     */
    private function recordPayment($customer, $data)
    {
        $payment = ORM::for_table("tbl_payment_gateway")->create();
        $payment->username = $customer;
        $payment->gateway = 'MPESA';
        $payment->plan_id = 0;
        $payment->plan_name = "N/A";
        $payment->routers_id = 0;
        $payment->routers = "N/A";
        $payment->price = $data["TransAmount"];
        $payment->payment_method = 'MPESA ' . $data["TransactionType"];
        $payment->payment_channel = 'MPESA';
        $payment->pg_paid_response = json_encode($data);
        $payment->created_date = date('Y-m-d H:i:s');
        $payment->paid_date = date('Y-m-d H:i:s');
        $payment->status = 2;
        $payment->gateway_trx_id = $data["TransID"];
        $payment->pg_url_payment = "N/A";
        $payment->pg_request = $data["MSISDN"];
        $payment->expired_date = date('Y-m-d H:i:s', strtotime("+5 minutes"));
        $payment->save();

        return $payment;
    }
    /**
     * @return void
     * @param mixed $payment
     * @param mixed $customer
     * @param mixed $data
     */
    private function updatePayment($payment, $data): void
    {
        $payment->price = $data["TransAmount"];
        $payment->pg_paid_response = json_encode($data);
        $payment->paid_date = date('Y-m-d H:i:s');
        $payment->status = 2;
        $payment->gateway_trx_id = $data["TransID"];
        $payment->pg_request = $data["MSISDN"];
        $payment->save();
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
        $refnumber = $data["BillRefNumber"];

        $trx = ORM::for_table("tbl_payment_gateway")
            ->where("gateway_trx_id", $refnumber)
            ->where("status", 1)
            ->find_one();

        if($trx) {
            $customer = Customer::getByAttribute("username", $trx["username"]);
            if($customer) {
                $this->updatePayment($trx, $data);
                Package::rechargeUser($customer["id"], $trx["routers"], $trx["plan_id"], "MPESA-".$data["TransID"], $data["TransactionType"]);
                $plan = HotspotPlan::getById($trx["plan_id"]);
                require_once(Package::getDevice($plan));
                try {
                    $router = new MikrotikHotspot();
                    $router->add_customer($customer, $plan);
                    $router->connect_customer($customer, $customer["ip_address"], $customer["mac_address"], $plan["routers"]);
                } catch (\Exception $e) {
                    return new RpcResult(false, "Could not purchase plan!", [$customer, $plan["routers"]]);
                }
                return new RpcResult(true, "User recharged!");
            }
        }

        $customer = Customer::getByAttribute("username", $refnumber);

        if(! $customer) {
            $this->recordPayment("PENDING-".$refnumber, $data);
            return new RpcResult(false, "Customer not found!");
        }

        $plan = UserRecharge::getLastRecharge($customer["id"]);
        $payment = $this->recordPayment($refnumber, $data);

        if(! $plan || $plan["status"] == "on") {
            // we record into balance
            Customer::setBalance($customer["id"], $customer["balance"] + $data["TransAmount"]);
            return new RpcResult(true, "Transaction recorded!");
        } else {
            Package::rechargeUser($customer["id"], $plan["routers"], $plan["plan_id"], "MPESA", $data["TransactionType"]);
            return new RpcResult(true, "User recharged!");
        }
    }
}
