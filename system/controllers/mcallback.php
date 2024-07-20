<?php

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$request = new RpcRequest("activatePlan", $data["Body"]["stkCallback"]);
$hotspotRpc = new HotspotRpc();
$response = $hotspotRpc->handleRequest($request);
header('Content-Type: application/json');
echo json_encode($response);
exit();

