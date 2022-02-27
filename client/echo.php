<?php
require "_conf.php";

// data to send
$data = [
    "dttm" => date("Y-m-d H:i:s"),
    "vehicle_code" => "ZIDAN",
    "message" => "This message will be sent to the server that sends it back."
];

// add signature to data
$data['signature'] = makeSignature($data);

// send request to server and get result
$result = sendRequest("echo", $data);

// show result
echo json_encode($result, JSON_PRETTY_PRINT);

// check signature if exists
echo "\n" .
    (!isset($result['signature'])
        ? 'No'
        : (checkSignature($result) ? "Valid" : "Bad")
    ) .
    " signature";
