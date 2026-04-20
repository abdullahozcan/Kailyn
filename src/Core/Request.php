<?php
namespace Core;

class Request
{
    protected $headers;
    protected $body;
    protected $method;
    protected $uri;
    protected $queryParams;
    protected $postParams;

    public function __construct()
    {
        $this->headers = $this->getAllHeaders();
        $this->body = $this->getBody();
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->queryParams = $_GET;
        $this->postParams = $_POST;
    }

    public function get($key, $default = null)
    {
        return $this->queryParams[$key] ?? $default;
    }

    public function post($key, $default = null)
    {
        return $this->postParams[$key] ?? $default;
    }

    public function all()
    {
        return array_merge($this->queryParams, $this->postParams);
    }

    public function isMethod($method)
    {
        return $this->method === strtoupper($method);
    }

    public function getBody()
    {
        if ($this->body === null) {
            $this->body = file_get_contents('php://input');
        }
        return $this->body;
    }

    public function getBodyJson()
    {
        return json_decode($this->getBody(), true);
    }

    public function getHeader($key, $default = null)
    {
        $key = strtoupper(str_replace('-', '_', $key));
        return $this->headers[$key] ?? $default;
    }

    protected function getAllHeaders()
    {
        if (!function_exists('getallheaders')) {
            $headers = [];
            foreach ($_SERVER as $name => $value) {
                if (substr($name, 0, 5) == 'HTTP_') {
                    $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                }
            }
            return $headers;
        }
        return getallheaders();
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function has($key)
    {
        return isset($this->queryParams[$key]) || isset($this->postParams[$key]);
    }

    public function input($key, $default = null)
    {
        return $this->queryParams[$key] ?? $this->postParams[$key] ?? $default;
    }

    public function only(array $keys)
    {
        $data = [];
        foreach ($keys as $key) {
            if ($this->has($key)) {
                $data[$key] = $this->input($key);
            }
        }
        return $data;
    }

    public function except(array $keys)
    {
        $data = $this->all();
        foreach ($keys as $key) {
            unset($data[$key]);
        }
        return $data;
    }
}