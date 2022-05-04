<?php
namespace Core;

class Database
{
    protected $db;

    public function __construct()
    {
       try {
           $this->db = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
       } catch (\PDOException $e) {
           DB_NAME." ".$e->getMessage();
       }
    }
}