<?php
require "_conf.php";

/* send vehicle log to database */
sendRequestAndShowResult(
    "add-log",
    [
        "dttm" => date("Y-m-d H:i:s"),
        "vehicle_code" => "MB42",
        "mileage" => "5",
        "battery_capacity" => "48"
    ]
);
