<?php

/*
 * Project: BlogSistem
 * File: core/database.php
 * Author: Abdullah ÖZCAN
 */

namespace Core;

use PDO;
use PDOException;

class Database
{
    public $db;

    public function __construct()
    {
        // print_r($_ENV);die;
        // echo 'adsad :' .getenv('APP_NAME');die;
        $dsn = "mysql:host=" . getenv('DB_HOST') . ";port=" . getenv('DB_PORT') . ";dbname=" . getenv('DB_NAME') . ";charset=utf8";
        $username = getenv('DB_USER');
        $password = getenv('DB_PASS');

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->db = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            $this->logError($e->getMessage());
            $this->showErrorPage($e->getMessage());
        }
    }

    public function query($sql, $data = [])
    {
        try {
            $query = $this->db->prepare($sql);
            $query->execute($data);
            return $query;
        } catch (PDOException $e) {
            $this->logError($e->getMessage());
            echo "Sorgu hatası: " . $e->getMessage();
        }
    }

    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

    public function fetchAll($sql, $data = [])
    {
        $query = $this->query($sql, $data);
        return $query->fetchAll();
    }

    public function fetch($sql, $data = [])
    {
        $query = $this->query($sql, $data);
        return $query->fetch();
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

    protected function logError($message)
    {
        // Hataları loglamak için bir dosyaya yazabilir veya başka bir loglama mekanizması kullanabilirsiniz
        error_log($message, 3, __DIR__ . '/../logs/database_errors.log');
    }

    protected function showErrorPage($message)
    {
        http_response_code(500);
        require_once __DIR__ . '/../public/error.php';
        exit;
    }
}