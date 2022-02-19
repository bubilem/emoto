<?php

abstract class MainController
{

    protected $request;
    protected $reply;

    public function __construct(RequestModel $request = null)
    {
        $this->messages = [];
        if ($request instanceof RequestModel) {
            $this->request = $request;
        } else {
            $this->request = new RequestModel();
        }
        $this->reply = new ReplyModel();
    }

    public function getRequest(): RequestModel
    {
        return $this->request;
    }

    public abstract function run(): void;
}
