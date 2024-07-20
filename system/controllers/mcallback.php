<?php
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$request = new RpcRequest("recordDeposit", $data->Body->stkCallback);
$hotspotRpc = new HotspotRpc();
$hotspotRpc->handleRequest($request);
