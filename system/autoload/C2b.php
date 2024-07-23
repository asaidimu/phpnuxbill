<?php

class C2b extends MpesaSdk
{
    public function register($params)
    {
        $mpesa_sdk = new MpesaSdk();
        $access_token = $mpesa_sdk->getToken([
            "key" => $params["key"],
            "secret" => $params["secret"],
            "env" => $params["env"],
        ]);
        $env = $params["env"];
        $version = $params["version"];
        $registerUrl = ($version == 'v1' ? ($env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl' : 'https://api.safaricom.co.ke/mpesa/c2b/v1/registerurl') : ($env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/c2b/v2/registerurl' : 'https://api.safaricom.co.ke/mpesa/c2b/v2/registerurl'));
        $payload = array(
         'ShortCode' => $params["code"],
         'ResponseType' => 'Completed',
         'ConfirmationURL' => $params["confirmation"],
         'ValidationURL' => $params["validation"],
    );
        $ch = curl_init();
        curl_setopt_array(
            $ch,
            array(
            CURLOPT_URL => $registerUrl,
            CURLINFO_HEADER_OUT => true,
            CURLOPT_HTTPHEADER =>  array('Content-Type: application/json', 'Authorization:Bearer ' . $access_token),
            CURLOPT_POST =>  true,
            CURLOPT_POSTFIELDS =>  json_encode($payload),
            CURLOPT_RETURNTRANSFER =>  true,
            CURLOPT_SSL_VERIFYPEER =>  false,
            CURLOPT_SSL_VERIFYHOST =>  false
      )
        );
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        return curl_exec($ch);
    }

    public function simulate($phone_number, $amount, $bill_ref_number)
    {
        $mpesa_sdk = new MpesaSdk();
        $access_token = $mpesa_sdk->generateAccessToken();
        $env = getenv('MPESA_ENV');
        $simulateUrl = $env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate' : 'https://api.safaricom.co.ke/mpesa/c2b/v1/simulate';
        $payload = array(
          'ShortCode' => getenv('MPESA_SHORTCODE'),
          'CommandID' => 'CustomerPayBillOnline',
          'Amount' => $amount,
          'Msisdn' => $phone_number,
          'BillRefNumber' => $bill_ref_number
        );
        $ch = curl_init();
        curl_setopt_array(
            $ch,
            array(
            CURLOPT_URL => $simulateUrl,
            CURLINFO_HEADER_OUT => true,
            CURLOPT_HTTPHEADER =>  array('Content-Type: application/json', 'Authorization:Bearer ' . $access_token),
            CURLOPT_POST =>  true,
            CURLOPT_POSTFIELDS =>  json_encode($payload),
            CURLOPT_RETURNTRANSFER =>  true,
            CURLOPT_SSL_VERIFYPEER =>  false,
            CURLOPT_SSL_VERIFYHOST =>  false
      )
        );
        return curl_exec($ch);
    }


}
