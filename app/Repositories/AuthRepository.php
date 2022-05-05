<?php
namespace App\Repositories;
use \Core\Repository;
use App\Models\User;

class AuthRepository extends Repository
{
    private $userModel;
    public function __construct(){
        $this->userModel = new User();
    }

    public function tokenCheck($token){
        $this->userModel->where('token', $token);
        $response = $this->userModel->first();
        if($response){
            return $response;
        }
        return false;
    }
}