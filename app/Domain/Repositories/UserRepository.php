<?php
namespace App\Repositories;
use Core\Repository;

class UserRepository extends Repository
{
    private $userModel;
    function __construct(){
        
        $this->userModel = new \App\Models\User();
    }

    public function getUser(){
        $response = $this->userModel->get();
        return $response;
    }

    public function addUser($data){
        $response = $this->userModel->insert($data);
        return $response;
    }
}