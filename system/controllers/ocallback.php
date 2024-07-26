<?php

$allowedIps = [
    '196.201.214.200',
    '196.201.214.206',
    '196.201.213.114',
    '196.201.214.207',
    '196.201.214.208',
    '196.201.213.44',
    '196.201.212.127',
    '196.201.212.138',
    '196.201.212.129',
    '196.201.212.136',
    '196.201.212.74',
    '196.201.212.69'
];

function getClientIp()
{
    $ipAddress = '';

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
    }

    // Sanitize and validate the IP address
    $ipAddress = trim($ipAddress);
    if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        return $ipAddress;
    }

    return false; // Return false if the IP address is not valid
}

function isIpAllowed($clientIp, $allowedIps)
{
    return in_array($clientIp, $allowedIps);
}

$clientIp = getClientIp();

if ($clientIp && isIpAllowed($clientIp, $allowedIps)) {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $request = new RpcRequest("activatePlan", $data);
    $hotspotRpc = new AutoRecharge();
    $response = $hotspotRpc->handleRequest($request);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
} else {
    header('HTTP/1.1 403 Forbidden');
    echo "Access denied.";
    exit;
}