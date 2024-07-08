<?php

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
