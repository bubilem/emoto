<?php

class RequestModel
{
    private $uri;

    public function __construct()
    {
        $uri = substr_replace(
            filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL),
            '',
            0,
            strlen(URL_DIR)
        );
        $this->uri = !empty($uri) ? explode("/", trim($uri, "/")) : [];
    }

    public function getUriPart(int $index = 0): string
    {
        return (string) ($this->uri[$index] ?? '');
    }

    public function getData(): array
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() != JSON_ERROR_NONE || !is_array($data)) {
            return [];
        }
        return $data;
    }
}
