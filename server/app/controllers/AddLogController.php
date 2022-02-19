<?php

class AddLogController extends MainController
{

    public function run(): void
    {
        $input = $this->request->getData();
        if (
            empty($input['dttm']) ||
            empty($input['vehicle_code']) ||
            empty($input['mileage']) ||
            empty($input['battery_capacity'])
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
            "SELECT code FROM vehicle WHERE code = '$vehicleCode'"
        );
        if ($db->getLastError() || !$result) {
            echo (string) $this->reply->status(6);
            return;
        }
        $vehicle = $db->fetch($result);
        if (!$vehicle || empty($vehicle['code'])) {
            echo (string) $this->reply->status(6);
            return;
        }
        $result = $db->query(
            "INSERT INTO log (vehicle_code, mileage, battery_capacity) VALUES " .
                "('$vehicleCode', '" . $input['mileage'] . "','" . $input['battery_capacity'] . "')"
        );
        if ($db->getLastError() || !$result) {
            echo (string) $this->reply->status(7);
            return;
        }
        $db->close();
        echo (string) $this->reply
            ->set('message', 'Log saved')
            ->set('dttm', $input['dttm'])
            ->status(0);
    }
}
