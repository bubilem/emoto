<?php
require "_conf.php";

// data to send
$data = [
    "dttm" => date("Y-m-d H:i:s"),
    "vehicle_code" => "ZIDAN",
    "mileage" => "0",
    "battery_capacity" => "0",
    "gps" => "50.9128308N, 14.6171558E"
];

// add signature to data
$data['signature'] = makeSignature($data);

// send request to server and get result
$result = sendRequest("add-log", $data);

// show result
echo json_encode($result, JSON_PRETTY_PRINT);

// check signature if exists
echo "\n" .
    (!isset($result['signature'])
        ? 'No'
        : (checkSignature($result) ? "Valid" : "Bad")
    ) .
    " signature";
