<?php
require_once('Manager.php');
class AnimalManager extends Manager {

    public function sliderAnimals()
    {
        $db = $this->dbConnection();
        $req = $db->query('SELECT * FROM animals ORDER BY id DESC LIMIT 0,5');
        return $req;
    }
}