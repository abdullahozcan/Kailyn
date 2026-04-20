<?php
namespace Route;
use Src\Core\Router;

/**
 * get()
 * post()
 * put()
 * delete()
 *
 * @route Api
 */

$route = new Router();

$route->get('/',function(){
    echo 'API V1';
});

$route->get('/abdullah',function(){
    phpinfo();
});

$route->get('/home',[(new \App\Http\Controllers\HomeController()),'home']);

// User
$route->get('/user/list',[(new \App\Http\Controllers\UserController()),'list']);
$route->post('/user/create',[(new \App\Http\Controllers\UserController()),'store']);
$route->post('/user/update',[(new \App\Http\Controllers\UserController()),'update']);
$route->post('/user/:id/edit',[(new \App\Http\Controllers\HomeController()),'edit']);
$route->post('/user/delete',[(new \App\Http\Controllers\UserController()),'delete']);

// article
$route->post('/article/create',[(new \App\Http\Controllers\HomeController()),'store']);
$route->post('article/:id/edit',[(new \App\Http\Controllers\HomeController()),'edit']);
$route->post('/article/update',[(new \App\Http\Controllers\HomeController()),'store']);
$route->post('/article/delete',[(new \App\Http\Controllers\HomeController()),'store']);
$route->post('/article/list',[(new \App\Http\Controllers\HomeController()),'list']);
