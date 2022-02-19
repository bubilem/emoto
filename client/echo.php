<?php
require "_conf.php";

/* just a communication test */
sendRequestAndShowResult(
    "echo",
    [
        "dttm" => date("Y-m-d H:i:s"),
        "message" => "This is echo message."
    ]
);
