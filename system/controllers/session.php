<?php

$postData = file_get_contents('php://input');
$requestData = json_decode($postData, true);

if ($requestData && isset($requestData['action']) && isset($requestData['params'])) {
  $request = new RpcRequest($requestData['action'], $requestData['params']);
  $rpc = new NetworkAccessLogsRpc();
  $response = $rpc->handleRequest($request);
} else {
  $response = new RpcResult(false, "Invalid request data");
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
