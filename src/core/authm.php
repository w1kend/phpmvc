<?php

namespace src\core;

use \Delight\Auth\Auth; 

class Authm
{
    private $db;
    private $auth;

    public function __construct()
    {
        $this->db = new \PDO('mysql:dbname=test;host=127.0.0.1;charset=utf8mb4','root','root');
        $this->auth = new Auth($this->db);
    }

    public function getAuth()
    {
        return $this->auth;
    }
}