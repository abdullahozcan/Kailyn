<?php
namespace App\Controllers;
use Core\Controller;
use Core\Request;
use Core\Response;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    private $userRepositoy;
    private $request;
    private $response;

    public function __construct()
    {
        $this->userRepositoy = new UserRepository();
        $this->request = new Request();
        $this->response = new Response();
    }

    public function store(){
        $return_response = $this->userRepositoy->addUser($this->request->getBody());
        if($return_response){
            return $this->response->json($return_response);
        }
    }

    public function update(){

    }

    public function list(){
        return $this->userRepositoy->getUser();
    }
}