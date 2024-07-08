<?php

class RpcResult
{
  public $success;
  public $message;
  public $result;
  public $meta;

  public function __construct($success, $message, $result = null, $meta = null)
  {
    $this->success = $success;
    $this->message = $message;
    $this->result = $result;
    $this->meta = $meta;
  }
}

class RpcRequest
{
  public $action;
  public $params;

  public function __construct($action, $params)
  {
    $this->action = $action;
    $this->params = $params;
  }
}

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
      "pppoe_password" => $params["macAddress"],
      "fullname" => $params["phoneNumber"],
      "phonenumber" => $params["phoneNumber"],
      "service_type" => "Hotspot",
    ]);

    $trx = ORM::for_table("tbl_payment_gateway")->create([
      "username" => $params["phoneNumber"],
      "status" => 1,
    ]);
    $trx->save();

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

    $customer = Customer::getByAttribute("phonenumber", $params["username"]);

    if (empty($customer)) {
      return new RpcResult(false, "Invalid username or password!");
    }

    $plans = UserRecharge::getByCustomer($customer["id"]);

    if (empty($plans)) {
      return new RpcResult(false, "User does not have an active plan!",);
    }
    $routerName = Router::getName($plans[0]["routers"]);
    try {
      $router  = new MikrotikHotspot();
      $router->connect_customer($customer, $ipAddress, $macAddress, $routerName);
      return new RpcResult(true, "User connected!",);
    } catch (\Exception $e) {
      return new RpcResult(false, "Could not connect user!", $e);
    }
  }

  /**
   * Top up account.
   * @param array $params An associative array containing parameters:
   *   - 'phoneNumber' (string): The username of the customer.
   *   - 'amount' (string): The deposit amount.
   * @return RpcResult
   */
  private function requestDeposit($params)
  {
    // stk push
    try {
      $customer = Customer::getByAttribute("phonenumber", $params["phoneNumber"]);
      $push = new StkPush();
      list($response, $time) = $push->initiate($params["phoneNumber"], $params["amount"], "RequestDeposit", "Hotspot");
      $result = json_decode($response);

      if ($result->errorCode || $result->ResponseCode != 0) {
        return new RpcResult(false, "Could not request payment!", $result);
      }

      $payment = ORM::for_table('tbl_payment_gateway')
              ->where('username', $customer["username"])
              ->where('status', 1)
              ->find_one();
      $payment->gateway_trx_id = $result->CheckoutRequestID;
      $payment->pg_url_payment = $time;
      $payment->pg_request = $customer["id"];
      $payment->expired_date = date('Y-m-d H:i:s', strtotime("+5 minutes"));
      $payment->save();


      return new RpcResult(true, "Requested mpesa payment!");
    } catch (\Exception $e) {
      // Handle exception (e.g., log error, return false)
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
      ->find_one();

    $push = new StkPush();
    $response = $push->query($payment["gateway_trx_id"]);
    $result = json_decode($response);

    if ($result->errorCode) {
      return new RpcResult(false, "Could not complete query!", $result);
    }

    if ($result->ResponseCode === 1) {
      return new RpcResult(false, "Payment not complete!", $result);
    } else if($result->ResponseCode === 2 && $payment["status"] != 2) {
      $payment->pg_paid_response = json_encode($result);
      $payment->payment_method = 'M-Pesa';
      $payment->payment_channel = 'M-Pesa StkPush';
      $payment->paid_date = date('Y-m-d H:i:s');
      $payment->status = 2;
      $payment->save();
      return new RpcResult(true, "Payment not complete!", $result);
    }
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
    $customer = Customer::getByAttribute("phonenumber", $params["username"]);

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

    // add customer to router
    $router = new MikrotikHotspot();
    try {
      $router->add_customer($customer, $next_plan);

      if ($current_plan) {
        // delete the plan
        $router->remove_plan($customer, $current_plan);
        UserRecharge::delete($current_plan["id"]);
      }
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
        "method" => "Voucher",
        "routers" => $next_plan["routers"],
        "type" => $next_plan["type"]
      ]);

      // record the transaction
      Transaction::create([
        "invoice" => date("Y-m-d/H:i:s"),
        "username" => $customer["username"],
        "plan_name" => $next_plan["name_plan"],
        "price" => $next_plan["price"],
        "recharged_time" => $time,
        "expiration" => $expiry["date"],
        "time" => $expiry["time"],
        "method" => "Voucher",
        "routers" => $next_plan["routers"],
        "type" => $next_plan["type"]
      ]);

      // subtract user balance
      Customer::setBalance($customer["id"], $customer["balance"] - $next_plan["price"]);
      return new RpcResult(true, "Purchased plan!");
    } catch (\Exception $e) {
      // Handle exception (e.g., log error, return false)
      return new RpcResult(false, "Could not purchase plan!");
    }
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

$result = ORM::for_table('tbl_appconfig')->find_many();
foreach ($result as $value) {
  $setting = $value["setting"];
  $value = $value["value"];
  if (preg_match("/^MPESA/i", $setting)) {
    putenv($setting . "=" . $value);
  }
}

$postData = file_get_contents('php://input');
$requestData = json_decode($postData, true);

if ($requestData && isset($requestData['action']) && isset($requestData['params'])) {
  $request = new RpcRequest($requestData['action'], $requestData['params']);
  $hotspotRpc = new HotspotRpc();
  $response = $hotspotRpc->handleRequest($request);
} else {
  $response = new RpcResult(false, "Invalid request data");
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
