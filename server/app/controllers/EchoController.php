<?php

class EchoController extends MainController
{

    public function run(): void
    {
        $data = $this->request->getData();
        if (empty($data['dttm']) || empty($data['message'])) {
            echo (string) $this->reply->status(4);
        } else {
            echo (string) $this->reply
                ->set('message', $data['message'])
                ->set('dttm', $data['dttm'])
                ->status(0);
        }
    }
}
