<?php

class EchoController extends MainController
{

    public function run(): void
    {
        $requestData = $this->request->getData();
        if (
            empty($requestData['dttm']) ||
            empty($requestData['vehicle_code']) ||
            empty($requestData['message']) ||
            empty($requestData['signature'])
        ) {
            echo (string) $this->reply->status(4);
            return;
        }

        // Connect to DB
        $db = new DB();
        if (!$db->init(DB_HOST, DB_USER, DB_PASS, DB_DTBS)) {
            echo (string) $this->reply->status(5);
            return;
        }

        // Vehicle load - code and secret
        $result = $db->query(
            "SELECT code, secret FROM vehicle WHERE code = '" .
                htmlspecialchars($requestData["vehicle_code"], ENT_QUOTES) . "'"
        );
        if ($db->getLastError() || !$result) {
            echo (string) $this->reply->status(6);
            return;
        }
        $vehicle = $db->fetch($result);
        if (empty($vehicle['code']) || empty($vehicle['secret'])) {
            echo (string) $this->reply->status(6);
            return;
        }

        // Signature check
        if (!SignatureModel::check($vehicle['secret'], $requestData)) {
            echo (string) $this->reply->status(9);
            return;
        }

        //echo reply
        echo (string) $this->reply
            ->set('vehicle_code', $vehicle['code'])
            ->set('message', $requestData['message'])
            ->status(0)
            ->sign($vehicle['secret']);
    }
}
