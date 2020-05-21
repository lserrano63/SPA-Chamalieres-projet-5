<?php
namespace App\Models;

class Manager {

    protected function dbConnection()
    {
        try
        {
            $db = new \PDO('mysql:host=db5000394821.hosting-data.io;port=3306;dbname=dbs377869;charset=utf8', 'dbu10053', 'kkd/5R@.');
            return $db;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
}