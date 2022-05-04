<?php

namespace Core\Middleware;

use Core\Middleware;
use Core\Response;
use Core\Request;


class AuthMiddleware extends Middleware
{
    
    public function handle()
    {
        $header = $this->request->getHeader('Authorization');
        if (!$header) {
            return $this->response->error403();
        }

        $token = explode(' ', $header)[1];

        if (!$token) {
            return $this->response->error403();
        }

        

    }
}