<?php

define("API_URL", "http://www/emoto/server/");
define("SECRET", "OzRFZqwb5JTlZX929a91");

/**
 * Send request to the server
 *
 * @param string $operation
 * @param array $data
 * @return array
 */
function sendRequest(string $operation, array $data): array
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, API_URL . $operation);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    return json_decode(
        !empty($result)
            ? $result
            : '{"status_key":"1","status_mess":"Communication failure"}',
        true
    );
}

/**
 * Make a signature
 *
 * @param array $data
 * @return string signature
 */
function makeSignature(array $data): string
{
    return hash(
        'sha1',
        serializeDataValues($data) . '|' . SECRET
    );
}

/**
 * Check the signature
 *
 * @param array $data
 * @return bool true if the signature in data is correct
 */
function checkSignature(array $data): bool
{
    if (empty($data['signature'])) {
        return false;
    }
    $signature = $data['signature'];
    unset($data['signature']);
    return strlen($signature) === 40
        && makeSignature($data) === $signature;
}

/**
 * Serialize data for signature
 *
 * @param array $data
 * @return string serialized data
 */
function serializeDataValues(array $data): string
{
    $output = "";
    foreach ($data as $value) {
        $output .=
            ($output ? "|" : "") .
            (is_array($value) ? implode("|", $value) : $value);
    }
    return $output;
}
