<?php

class Manager {

    protected function dbConnection()
    {
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=spa_chamalieres;charset=utf8', 'root', '');
            return $db;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
}