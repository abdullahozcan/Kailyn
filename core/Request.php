<?php
namespace Core;
use Closure;
class Request{

    public function get($key){
        if(isset($_GET[$key])){
            return $_GET[$key];
        }
        return null;
    }

    public function post($key){
        if(isset($_POST[$key])){
            return $_POST[$key];
        }
        return null;
    }

    public function all(){
        return $_REQUEST;
    }

    public function isMethod($method){
        return $_SERVER['REQUEST_METHOD'] === $method;
    }

    public function getBody(){
        return file_get_contents('php://input');
    }

    public function getBodyJson(){
        return json_decode($this->getBody());
    }

    public function getHeader($key){
        if(isset($_SERVER[$key])){
            return $_SERVER[$key];
        }
        return false;
    }
}