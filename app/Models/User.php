<?php
namespace App\Models;
use Core\Model;

class User extends Model
{
    protected $table = 'user';

    function __construct()
    {
        parent::__construct(); // TODO: Change the autogenerated stub
        // $this->table('user');
    }
}