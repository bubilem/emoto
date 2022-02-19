<?php

class ReplyModel
{
    private $data;

    public function __construct()
    {
        $this->data = [];
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

    public function __toString()
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }
}
