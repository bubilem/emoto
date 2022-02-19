<?php

class GetLastLogController extends MainController
{

    public function run(): void
    {
        $input = $this->request->getData();
        if (
            empty($input['dttm']) ||
            empty($input['vehicle_code'])
        ) {
            echo (string) $this->reply->status(4);
            return;
        }
        $db = new DB();
        if (!$db->init(DB_HOST, DB_USER, DB_PASS, DB_DTBS)) {
            echo (string) $this->reply->status(5);
            return;
        }
        $vehicleCode = $input["vehicle_code"];
        $result = $db->query(
            "SELECT dttm, vehicle_code, mileage, battery_capacity " .
                "FROM log " .
                "WHERE vehicle_code = '$vehicleCode'" .
                "ORDER BY dttm DESC LIMIT 1"
        );
        if ($db->getLastError() || !$result) {
            echo (string) $this->reply->status(8);
            return;
        }
        $log = $db->fetch($result);
        if (!$log) {
            echo (string) $this->reply->status(8);
            return;
        }

        $db->close();
        echo (string) $this->reply
            ->set('log', $log)
            ->set('dttm', $input['dttm'])
            ->status(0);
    }
}
