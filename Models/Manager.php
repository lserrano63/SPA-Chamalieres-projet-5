<?php

class Manager {

    protected function dbConnection()
    {
        try
        {
            $db = new PDO('mysql:host=db5000352654.hosting-data.io;port=3306;dbname=dbs343143;charset=utf8', 'dbu620826', 'kjbqs;hbdn3.@S');
            return $db;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
}