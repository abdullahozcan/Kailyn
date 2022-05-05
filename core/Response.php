<?php
namespace Core;

class Response{

    public function json($data){
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function redirect($url){
        header('Location: '.$url);
    }

    public function view($view, $data = []){
        require_once '../app/Views/'.$view.'.php';
    }

    public function error($message){
        echo $message;
    }

    public function error404(){
        header('HTTP/1.0 404 Not Found');
        echo '404 Not Found';
    }

    public function error500(){
        header('HTTP/1.0 500 Internal Server Error');
        echo '500 Internal Server Error';
    }

    public function error503(){
        header('HTTP/1.0 503 Service Unavailable');
        echo '503 Service Unavailable';
    }

    public function error401(){
        header('HTTP/1.0 401 Unauthorized');
        echo '401 Unauthorized';
    }

    public function error403(){
        header('HTTP/1.0 403 Forbidden');
        echo '403 Forbidden';
    }

    public function error400(){
        header('HTTP/1.0 400 Bad Request');
        echo '400 Bad Request';
    }

    public function error405(){
        header('HTTP/1.0 405 Method Not Allowed');
        echo '405 Method Not Allowed';
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