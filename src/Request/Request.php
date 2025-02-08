<?php

namespace App\Request;


class Request
{
    /** @var Request */
    protected static $instance = null;

    public string $requestMethod = '';
    public array $params = [];
    protected array $input = [];

    private function __construct()
    {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            $this->requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
            $input = $this->getBody();
            $this->input = [];
            if (function_exists('mb_parse_str')) {
                mb_parse_str($input, $this->input);
            } else {
                parse_str($input, $this->input);
            }
        }
    }

    public static function getInstance(): Request
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get(string $key = null)
    {
        $value = null;

        if (isset($this->params[$key])) {
            $value = $this->params[$key];
        } else if ($this->isSetPost($key)) {
            $value = $this->getPost($key);
        } else if ($this->isSetGet($key)) {
            $value = $this->getGet($key);
        }

        return $value;
    }

    public function getGet(string $key = null, string $default = null)
    {
        if (null === $key && $this->isGet()) {
            return $_GET;
        }

        return $this->isSetGet($key) ? $_GET[$key] : $default;
    }

    public function getPost(string $key = null, string $default = null)
    {
        if (null === $key && $this->isPost()) {
            return $_POST;
        }

        return $this->isSetPost($key) ? $_POST[$key] : $default;
    }

    public function isSetGet(?string $key): bool
    {
        if ($key === null) {
            return false;
        }

        if ($this->isGet() && isset($_GET[$key]) && ($_GET[$key] !== null)) {
            return true;
        }

        return false;
    }

    public function isSetPost(?string $key): bool
    {
        if ($key === null) {
            return false;
        }

        if ($this->isPost() && isset($_POST[$key]) && ($_POST[$key] !== null)) {
            return true;
        }

        return false;
    }

    public function isGet(): bool
    {
        if (is_array($_GET) && !empty($_GET)) {
            return true;
        }

        return false;
    }

    public function isPost(): bool
    {
        if (is_array($_POST) && !empty($_POST)) {
            return true;
        }

        return false;
    }


    public function getBody(): string
    {
        return (string)file_get_contents('php://input');
    }


    public function getUploadedFileContent(string $index = 'file'): array
    {
        $parsedFile = file_get_contents($_FILES[$index]['tmp_name']);
        if (empty($parsedFile)) {
            return [];
        }
        $data = json_decode($parsedFile, true);
        if (json_last_error()) {
            trigger_error(json_last_error_msg());
            return [];
        }

        return $data;
    }
}