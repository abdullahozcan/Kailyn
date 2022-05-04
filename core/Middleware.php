<?php
namespace Core;

use Core\Interfaces\MiddlewareInterface;
use Core\Response;
use Core\Request;

/**
 * Middleware class
 *
 * @package Core
 */
class Middleware implements MiddlewareInterface
{
    private $request;
    private $response;

    function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

}