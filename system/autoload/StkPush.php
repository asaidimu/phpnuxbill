<?php

class StkPush extends MpesaSdk
{
    public function initiate($params, $reference, $description)
    {
        $mpesa_sdk = new MpesaSdk();
        $access_token = $mpesa_sdk->getToken([
            "key" => $params["MPESA_CONSUMER_KEY"],
            "secret" => $params["MPESA_CONSUMER_SECRET"],
            "env" => $params["MPESA_ENV"]
        ]);
        $env = $params["MPESA_ENV"];
        $url = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest' : 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_VERBOSE, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $access_token)); //setting custom header
        $time = date("YmdHis");
        $curl_post_data = array(
          //Fill in the request parameters with valid values
          'BusinessShortCode' => $params["MPESA_SHORTCODE"],
          'Password' => base64_encode($params["MPESA_SHORTCODE"].$params["MPESA_PASSKEY"] . $time),
          'Timestamp' => $time,
          'TransactionType' => 'CustomerPayBillOnline',
          'Amount' => $params["amount"],
          'PartyA' => $params["phone"],
          'PartyB' => $params["MPESA_SHORTCODE"],
          'PhoneNumber' => $params["phone"],
          'CallBackURL' => $params["MPESA_CALLBACK_URL"],
          'AccountReference' => $reference,
          'TransactionDesc' => $description
        );
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        return [$curl_response, $time];
    }

    public function query($checkout_request_id)
    {
        $mpesa_sdk = new MpesaSdk();
        $access_token = $mpesa_sdk->generateAccessToken();
        $env = getenv('MPESA_ENV');
        $url = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query' : 'https://api.safaricom.co.ke/mpesa/stkpushquery/v1/query';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $access_token)); //setting custom header
        $curl_post_data = array(
          //Fill in the request parameters with valid values
          'BusinessShortCode' => getenv('MPESA_SHORTCODE'),
          'Password' => base64_encode(getenv('MPESA_SHORTCODE') . getenv('MPESA_PASSKEY') . date("YmdHis")),
          'Timestamp' => date("YmdHis"),
          'CheckoutRequestID' => $checkout_request_id
        );
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        return $curl_response;
    }
}
