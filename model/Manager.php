<?php
namespace App\model;
use \PDO;

class Manager 
{
    protected function MySQLConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=projet-4;charset=utf8', 'root', '');
        return $db;
    }
}