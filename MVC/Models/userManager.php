<?php namespace App\Models;
require_once('Manager.php');
class UserManager extends Manager{

    public function connection($name, $password) {
        $db = $this->dbConnection();
        $req = $db->prepare('SELECT * FROM users WHERE name= :name');
        $req->execute(array(
            'name' => $name));
        $resultat = $req->fetch();
        return $resultat;
    }
}