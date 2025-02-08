<?php
namespace Core;

class Response
{
    protected $headers = [];
    protected $statusCode = 200;
    protected $content;

    public function json($data, $statusCode = 200)
    {
        $this->setStatusCode($statusCode);
        $this->setHeader('Content-Type', 'application/json');
        $this->setContent(json_encode($data));
        $this->send();
    }

    public function redirect($url, $statusCode = 302)
    {
        $this->setStatusCode($statusCode);
        $this->setHeader('Location', $url);
        $this->send();
    }

    public function view($view, $data = [], $statusCode = 200)
    {
        $this->setStatusCode($statusCode);
        extract($data);
        $viewPath = realpath('../app/Views/' . $view . '.php');
        if ($viewPath && strpos($viewPath, realpath('../app/Views/')) === 0) {
            ob_start();
            require_once $viewPath;
            $this->setContent(ob_get_clean());
            $this->send();
        } else {
            $this->error404();
        }
    }

    public function setHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function send()
    {
        http_response_code($this->statusCode);
        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }
        echo $this->content;
    }

    public function error($message, $statusCode = 500)
    {
        $this->setStatusCode($statusCode);
        $this->setContent($message);
        $this->send();
    }

    public function error404($message = '404 Not Found')
    {
        $this->error($message, 404);
    }

    public function error500($message = '500 Internal Server Error')
    {
        $this->error($message, 500);
    }

    public function error503($message = '503 Service Unavailable')
    {
        $this->error($message, 503);
    }

    public function error401($message = '401 Unauthorized')
    {
        $this->error($message, 401);
    }

    public function error403($message = '403 Forbidden')
    {
        $this->error($message, 403);
    }

    public function error400($message = '400 Bad Request')
    {
        $this->error($message, 400);
    }

    public function error405($message = '405 Method Not Allowed')
    {
        $this->error($message, 405);
    }

    public function error422(){
        header('HTTP/1.0 422 Unprocessable Entity');
        echo '422 Unprocessable Entity';
    }

    public function error501(){
        header('HTTP/1.0 501 Not Implemented');
        echo '501 Not Implemented';
    }

    public function error503ServiceUnavailable(){
        header('HTTP/1.0 503 Service Unavailable');
        echo '503 Service Unavailable';
    }
}