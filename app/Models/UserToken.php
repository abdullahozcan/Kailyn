<?php
namespace App\Models;
use Core\Model;

class UserToken extends Model
{
    function __construct()
    {
        parent::__construct(); // TODO: Change the autogenerated stub
        $this->table('user_token');
    }
}