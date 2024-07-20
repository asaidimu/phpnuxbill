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
class HotspotRpc
{
  public function handleRequest(RpcRequest $request)
  {
    if ($request->params["phoneNumber"]) {
      $phoneNumber = formatPhoneNumber($request->params["phoneNumber"]);
      if ($phoneNumber == null) {
        return new RpcResult(false, "Invalid parameters");
      }
      $request->params["phoneNumber"] = $phoneNumber;
    }
    switch ($request->action) {
      case 'listCustomers':
        return $this->listCustomers($request->params);
      case 'registerCustomer':
        return $this->registerCustomer($request->params);
      case 'purchasePlan':
        return $this->purchasePlan($request->params);
      case 'getCustomer':
        return $this->getCustomer($request->params);
      case 'connectCustomer':
        return $this->connectCustomer($request->params);
      case 'requestDeposit':
        return $this->requestDeposit($request->params);
      case 'checkDeposit':
        return $this->checkDeposit($request->params);
      case 'recordDeposit':
        return $this->recordDeposit($request->params);
      default:
        return new RpcResult(false, "Unknown action: {$request->action}");
    }
  }

  /**
   * Lists all customers registered in the database
   *
   * @return RpcResult
   */
  private function listCustomers()
  {
    $customers = Customer::getAll();
    $data = [];
    foreach ($customers as $customer) {
      $data[] = nullify($customer, ["password", "pppoe_password"]);
    }

    return new RpcResult(true, "Customers found", $data);
  }

  /**
   * get the customer identified by username and password
   * @params array
   *   - 'username' (string): Username.
   *   - 'password' (string): Password
   * @return RpcResult
   */
  private function getCustomer($params)
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
  private function registerCustomer($params)
  {
    $found = Customer::getByAttribute("phonenumber", $params["phoneNumber"]);
    if ($found) {
      return new RpcResult(false, "Customer exists!");
    }

    $customer = Customer::create([
      "username" => $params["phoneNumber"],
      "password" => $params["macAddress"],
      "email" => $params["phoneNumber"]."@anon.com",
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
  private function connectCustomer($params)
  {
    $ipAddress = $params['ipAddress'];
    $macAddress = $params['macAddress'];

    $customer = Customer::getByAttribute("phonenumber", formatPhoneNumber($params["username"]));

    if (empty($customer)) {
      return new RpcResult(false, "Invalid username or password!");
    }

    $recharge = UserRecharge::getByCustomer($customer["id"]);
    if (! $recharge) {
      return new RpcResult(false, "User does not have an active plan!", $recharge);
    }
    $plan = HotspotPlan::getById($recharge["plan_id"]);
    try {
      $device = Package::getDevice($plan);
      require_once($device);

      $routerName = Router::getName($plans[0]["routers"]);
      $router  = new MikrotikHotspot();
      $router->add_customer($customer, $plan);
      $router->connect_customer($customer, $ipAddress, $macAddress, $routerName);
      return new RpcResult(true, "User connected!");
    } catch (\Exception $e) {
      return new RpcResult(false, "Could not connect user!", $e);
    }
  }

  /**
   * Top up account.
   * @param array $params An associative array containing parameters:
   *   - 'phoneNumber' (string): The username of the customer.
   *   - 'amount' (string): The deposit amount.
   *   -  plan (string): The name of the hotspot plan
   *   -  router (number): The id of the router
   * @return RpcResult
   */
  private function requestDeposit($params)
  {
    // stk push
    try {
      $customer = Customer::getByAttribute("phonenumber", $params["phoneNumber"]);
      $push = new StkPush();
      list($response, $time) = $push->initiate($params["phoneNumber"], $params["amount"], "ACC_".$params["phoneNumber"], "Hotspot");
      $result = json_decode($response);

      if ($result->errorCode || $result->ResponseCode != 0) {
        return new RpcResult(false, "Could not request payment!", $result);
      }

      $payment = ORM::for_table('tbl_payment_gateway')
        ->where('username', $customer["username"])
        ->where('status', 1)
        ->find_one();

      if (! $payment) {
        $payment = ORM::for_table("tbl_payment_gateway")->create();
        $payment->username = $customer["username"];
        $payment->gateway = 'MPESA';
        $payment->gateway_trx_id = '';
        $payment->plan_id = 0;
        $payment->plan_name = '';
        $payment->routers_id = 0;
        $payment->routers = '';
        $payment->price = $params["amount"];
        $payment->payment_method = 'MPESA';
        $payment->payment_channel = 'M-Pesa StkPush';
        $payment->pg_url_payment = '';
        $payment->pg_request = NULL;
        $payment->pg_paid_response = NULL;
        $payment->expired_date = NULL;
        $payment->created_date = date('Y-m-d H:i:s');
        $payment->paid_date = NULL;
        $payment->trx_invoice = '';
        $payment->status = 1;
      }

      $payment->gateway_trx_id = $result->CheckoutRequestID;
      $payment->pg_url_payment = $time;
      $payment->pg_request = $customer["id"];
      $payment->expired_date = date('Y-m-d H:i:s', strtotime("+5 minutes"));
      $payment->save();


      return new RpcResult(true, "Requested mpesa payment!", $result);
    } catch (\Exception $e) {
      return new RpcResult(false, "Could not request payment!", $e);
    }
  }

  /**
   * Check deposit status
   * @param array $params An associative array containing parameters:
   *   - 'phoneNumber' (string): Customer's phone number.
   *   - 'amount' (string): Deposit amount.
   * @return RpcResult
   */
  private function checkDeposit($params)
  {
    // check database for data
    $customer = Customer::getByAttribute("phonenumber", $params["phoneNumber"]);
    $payment = ORM::for_table('tbl_payment_gateway')
      ->where('username', $customer["username"])
      ->where('status', 1)
      ->where('price', $params["amount"])
      ->find_one();

    $push = new StkPush();
    $response = $push->query($payment["gateway_trx_id"]);
    $result = json_decode($response);

    if (empty($result) || $result->errorCode) {
      return new RpcResult(false, "Could not complete query!", $result);
    }
      $payment->pg_paid_response = json_encode($result);
      $payment->paid_date = date('Y-m-d H:i:s');

    if ($result->ResultCode == 0) {
      $payment->status = 2;
      $payment->save();
      $balance =floatval($customer["balance"]) + floatval($params["amount"]);
      Customer::setBalance($customer["id"], $balance);
      return new RpcResult(true, "Payment complete!", $result);
    } else {
      $payment->status = 3;
      $payment->save();
      return new RpcResult(false, "Payment not complete!", []);
    }
  }

  /**
   * Record a deposit.
   * @param array $params An associative array containing parameters:
   *   - 'data' (string): data from mpesa callback
   * @return RpcResult
   */
  private function recordDeposit($data)
  {
    $payment = ORM::for_table('tbl_payment_gateway')
      ->where('gateway_trx_id', $data->CheckoutRequestID)
      ->where('status', 1)
      ->find_one();

    if(!$payment) {
      return;
    }

    if($data->ResultCode != 0) {
      $payment->status = 3;
      $payment->save();
      return;
    }

    $customer = Customer::getByAttribute("phonenumber", $payment["username"]);
    $payment->pg_paid_response = json_encode($data);
    $payment->paid_date = date('Y-m-d H:i:s');
    $payment->status = 2;
    $payment->save();
    $balance =floatval($customer["balance"]) + floatval($payment["price"]);
    Customer::setBalance($customer["id"], $balance);
  }

  /**
   * Purchase an internet plan.
   * @param array $params An associative array containing parameters:
   *   - 'username' (string): The username of the customer.
   *   - 'password' (string): The MAC address associated with the customer's device.
   *   - 'macAddress' (string): The MAC address associated with the customer's device.
   *   - 'ipAddress' (string): The ip address associated with the customer's device.
   *   - 'planId' (number): The id of the plan which the user is purchasing.
   * @return RpcResult
   */
  private function purchasePlan($params)
  {
    $planId = $params["planId"];
    $customer = Customer::getByAttribute("phonenumber", formatPhoneNumber($params["username"]));

    if (empty($customer)) {
      return new RpcResult(false, "Invalid username or password!");
    }
    $next_plan = HotspotPlan::getById($planId);

    if (empty($next_plan)) {
      return new RpcResult(false, "Unknown plan!");
    }

    if (intval($customer["balance"]) < $next_plan["price"]) {
      return new RpcResult(false, "Insufficient balance.");
    }

    $current_plan = UserRecharge::getByCustomer($customer["id"]);
    require_once(
      Package::getDevice($next_plan)
    );
    try {
      $router = new MikrotikHotspot();
      $router->add_customer($customer, $next_plan);
    } catch (\Exception $e) {
      return new RpcResult(false, "Could not purchase plan!");
    }

    UserRecharge::delete($current_plan["id"]);
    // record the current plan as a recharge
    $expiry = getExpirationData($next_plan["validity"], $next_plan["validity_unit"]);
    $time = date("H:i:s");
    // subtract user balance
    Customer::setBalance($customer["id"], $customer["balance"] - $next_plan["price"]);

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
      "method" => "MPESA",
      "routers" => $next_plan["routers"],
      "type" => $next_plan["type"]
    ]);

    // record the transaction
    $r = Transaction::create([
      "username" => $customer["username"],
      "plan_name" => $next_plan["name_plan"],
      "price" => $next_plan["price"],
      "recharged_on" => date("Y-m-d"),
      "recharged_time" => $time,
      "expiration" => $expiry["date"],
      "time" => $expiry["time"],
      "method" => "MPESA",
      "routers" => $next_plan["routers"],
      "type" => $next_plan["type"]
    ]);
    return new RpcResult(true, "Purchased plan!", [$r]);
  }
}

$result = ORM::for_table('tbl_appconfig')->find_many();
foreach ($result as $value) {
  $setting = $value["setting"];
  $value = $value["value"];
  if (preg_match("/^MPESA/i", $setting)) {
    $_ENV[$setting] = $value;
    putenv($setting . "=" . $value);
  }
}
