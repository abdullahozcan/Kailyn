<?php
namespace App\Controllers;
use Core\Controller;
use Core\Request;
use App\Repositories\UserRepository;
use Core\View;

class HomeController extends Controller
{
    private $userRepositoy;

    public function __construct()
    {
        $this->userRepositoy = new UserRepository();
    }

    public function home(){
        $data = [
            'title' => 'Home',
            'users' => 'bla bla'
        ];
        return View::render('home',$data);
    }

}