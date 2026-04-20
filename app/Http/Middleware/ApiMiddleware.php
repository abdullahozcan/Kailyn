<?php
namespace App\Middleware;

use Core\Middleware;
/**
 * ApiMiddleware class
 *
 * @package App
 */
class ApiMiddleware extends Middleware{
    
    public function handle($next, $request){
        $this->response->getallheaders();
        if(!$response->getHeader('Content-Type')){
            $response->setHeader('Content-Type', 'application/json');
        }
        print_r($response);
    }
}