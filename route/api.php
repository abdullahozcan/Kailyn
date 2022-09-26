<?php
namespace Route;
use Core\Router;

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

$route->get('/home',[(new \App\Controllers\HomeController()),'home']);

// User
$route->get('/user/list',[(new \App\Controllers\UserController()),'list']);
$route->post('/user/create',[(new \App\Controllers\UserController()),'store']);
$route->post('/user/update',[(new \App\Controllers\UserController()),'update']);
$route->post('/user/:id/edit',[(new \App\Controllers\HomeController()),'edit']);
$route->post('/user/delete',[(new \App\Controllers\UserController()),'delete']);

// article
$route->post('/article/create',[(new \App\Controllers\HomeController()),'store']);
$route->post('article/:id/edit',[(new \App\Controllers\HomeController()),'edit']);
$route->post('/article/update',[(new \App\Controllers\HomeController()),'store']);
$route->post('/article/delete',[(new \App\Controllers\HomeController()),'store']);
$route->post('/article/list',[(new \App\Controllers\HomeController()),'list']);
