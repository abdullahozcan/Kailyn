<?php

/*
 * Project: BlogSistem
 * File: core/database.php
 * Author: Abdullah ÖZCAN
 */

namespace Core;

class Database
{
    public $db;

    public function __construct()
    {
       try {
           $this->db = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
       } catch (\PDOException $e) {
           DB_NAME." ".$e->getMessage();
       }
    }

    public function query($sql, $data = [])
    {
        try{
            $query = $this->db->prepare($sql);
            $query->execute($data);
        }catch (\PDOException $e){
            echo $e->getMessage();
        }
        
        return $query;
    }

    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

    public function fetchAll($sql, $data = [])
    {
        $query = $this->query($sql, $data);
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function fetch($sql, $data = [])
    {
        $query = $this->query($sql, $data);
        return $query->fetch(\PDO::FETCH_OBJ);
    }

    public function fetchColumn($sql, $data = [])
    {
        $query = $this->query($sql, $data);
        return $query->fetchColumn();
    }

    public function rowCount($sql, $data = [])
    {
        $query = $this->query($sql, $data);
        return $query->rowCount();
    }

    public function beginTransaction()
    {
        return $this->db->beginTransaction();
    }

    public function endTransaction()
    {
        return $this->db->commit();
    }   

    public function cancelTransaction()
    {
        return $this->db->rollBack();
    }

    public function close()
    {
        $this->db = null;
    }   

    public function __destruct()
    {
        $this->close();
    }   

}