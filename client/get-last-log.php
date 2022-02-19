<?php
require "_conf.php";

/* get last vehicle log entry from database */
sendRequestAndShowResult(
    "get-last-log",
    [
        "dttm" => date("Y-m-d H:i:s"),
        "vehicle_code" => "MB42"
    ]
);
