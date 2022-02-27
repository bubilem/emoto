<?php

class ReplyModel
{
    private $data;

    public function __construct()
    {
        $this->data = [
            'dttm' => date("Y-m-d H:i:s")
        ];
    }

    public function set($key, $value): ReplyModel
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function status(int $statusKey, string $special = ''): ReplyModel
    {
        return $this->set(
            'status_key',
            $statusKey
        )->set(
            'status_mess',
            StatusModel::mess($statusKey) . ($special ? " [$special]" : '')
        );
    }

    public function sign(string $secret): ReplyModel
    {
        $this->data['signature'] = SignatureModel::make($secret, $this->data);
        return $this;
    }

    public function __toString()
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }
}
