<?php
namespace Core;
use Core\Response;

/*
 *  Basit Bir Router Yapısı
 * */

class Router
{
    private $handlers = [];
    private $middleware = null;
    private $response = null;

    const POST_METHOD = 'POST';
    const GET_METHOD = 'GET';
    const ANY_METHOD = 'GET|POST|PUT';

    public function __construct()
    {
        $this->response = new Response();
    }

    public function get(String $url,$handler=null){
        $this->CatchHandler(self::GET_METHOD, $url, $handler);
    }

    public function post(String $url,$handler=null){
        $this->CatchHandler(self::POST_METHOD, $url, $handler);
    }

    private function CatchHandler($method, String $url, $handler){
        $this->handlers[$method . $url] = [
            'url' => $url,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public function middleware(){
        return new Middleware();
    }

    public function run(){
        $request_uri = parse_url($_SERVER['REQUEST_URI']);
        $request_path = $request_uri['path'];
        $method = $_SERVER['REQUEST_METHOD'];
        $callback = null;


        foreach ($this->handlers as $handler){
            if($handler['url'] === $request_path && $handler['method'] === $method){
                $callback = $handler['handler'];
            }
        }

        if(!$callback){
            return $this->response->error404();
        }

        call_user_func_array($callback, $_REQUEST);
    }
}


