<?php
namespace App\Controllers;
use Core\Controller;
use Core\Request;
use App\Repositories\UserRepository;

class HomeController extends Controller
{
    private $userRepositoy;

    public function __construct()
    {
        $this->userRepositoy = new UserRepository();
    }

}