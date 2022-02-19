<?php
define("SERVER_URL", "http://www/emoto/server/");

function sendRequestAndShowResult(string $operation, array $data)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, SERVER_URL . $operation);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    echo $result !== false
        ? $result
        : '{"staus_key":"1","status_mess":"Communication failure"}';
}
