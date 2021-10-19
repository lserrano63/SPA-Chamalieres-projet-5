<?php
namespace App\Models;

class Manager {

    protected function dbConnection()
    {
        try
        {
            $db = new \PDO('mysql:host=;port=;dbname=;charset=utf8', '', '');
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;
        }

        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
}
