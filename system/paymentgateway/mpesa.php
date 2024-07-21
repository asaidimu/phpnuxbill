<?php

use PEAR2\Cache\SHM\Adapter\APC;

/**
 * PHP Mikrotik Billing (https://github.com/hotspotbilling/phpnuxbill/)
 * Payment Gateway M-Pesa https://developer.safaricom.co.ke/
 *
 **/

function mpesa_show_config()
{
  global $ui, $config;
  $ui->assign('env', json_decode(file_get_contents('system/paymentgateway/mpesa_env.json'), true));
  $ui->assign('_title', 'M-Pesa - Payment Gateway - ' . $config['CompanyName']);
  $ui->display('mpesa.tpl');
}

function mpesa_save_config()
{
  global $_L;

  $mpesa_config = [];
  foreach ($_POST as $key => $value) {
    if (stripos($key, 'MPESA') === 0) {
      $mpesa_config[$key] = $value;
      $_ENV[$key] = $value;
    }
  }


  foreach ($mpesa_config as $key => $value) {
    $setting = ORM::for_table('tbl_appconfig')->where('setting', $key)->find_one();

    if (empty($setting)) {
      $setting = ORM::for_table("tbl_appconfig")->create();
    }

    $setting->setting = $key;
    $setting->value = $value;
    $setting->save();
  }

  r2(U . 'paymentgateway/mpesa', 's', $_L['Settings_Saved_Successfully']);
}


function mpesa_create_transaction($trx, $user)
{
  global $config;

  $request = new RpcRequest("requestDeposit", ["phonenumber" => $user['phonenumber'], "amount" => $user]);
  $hotspotRpc = new HotspotRpc();
  $result = $hotspotRpc->handleRequest($request);
  if ($result->success) {
    r2(U . "order/view/", 's', Lang::T("Create Transaction Success, Please check your phone to process payment"));
  } else {
    r2(U . 'order/package', 'e', Lang::T("Failed to create transaction."));
  }
}

function mpesa_payment_notification()
{

  global $config;

  //CHECK IF OFFLINE IS ENABLED
  $callbackJSONData = file_get_contents('php://input');
  $callbackData = json_decode($callbackJSONData);
  $resultCode = $callbackData->Body->stkCallback->ResultCode;
  $resultDesc = $callbackData->Body->stkCallback->ResultDesc;
  $checkoutRequestID = $callbackData->Body->stkCallback->CheckoutRequestID;


  $trx = ORM::for_table('tbl_payment_gateway')
    ->where('gateway_trx_id', $checkoutRequestID)
    ->find_one();
  if (!$trx) {
    return;
  }
  $user = Customer::getByAttribute("username", $trx["username"]);

  if (empty($user)) {
    return;
  }

  if ($resultDesc == "Confirmation Service not accepted" || $resultCode == 1) {
    $trx->status = 3;
    $trx->save();
    exit();
  } elseif ($resultDesc == "The service request is processed successfully." && $resultCode == 0 && $trx['status'] != 2) {
    $trx->pg_paid_response = json_encode($callbackData);
    $trx->payment_method = 'M-Pesa';
    $trx->payment_channel = 'M-Pesa StkPush';
    $trx->paid_date = date('Y-m-d H:i:s');
    $trx->status = 2;
    $trx->save();
  } else {
    $trx->status = 1;
    $trx->save();
    exit();
  }
}


function mpesa_get_status($trx, $user)
{
  if ($trx->status == 2) {
    r2(U . "order/view/" . $trx['id'], 's', Lang::T("Transaction has been completed."));
    die();
  } elseif ($trx->status == 1) {
    $request = new RpcRequest("checkDeposit", ["PhoneNumber" => $user['phonenumber']]);
    $hotspotRpc = new HotspotRpc();
    $result = $hotspotRpc->handleRequest($request);

    if ($result->success) {
      r2(U . "order/view/" . $trx['id'], 'd', Lang::T("Transaction has been paid.."));
    } else {
      r2(U . "order/view/" . $trx['id'], 'w', Lang::T("Transaction still unpaid."));
    }
  }
}
