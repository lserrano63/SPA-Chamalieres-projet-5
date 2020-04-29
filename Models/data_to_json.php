<?php
require_once('Manager.php');
class Data_to_json extends Manager {

    public function data_to_json()
    {
        $db = $this->dbConnection();
        $reqjson = $db->query('SELECT * FROM others_spa');
        return $reqjson;
    }
}