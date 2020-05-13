<?php
require_once('Manager.php');
class UserManager extends Manager{

    public function connection($username) {
        $db = $this->dbConnection();
        $req = $db->prepare('SELECT * FROM users WHERE username= ?');
        $login->execute(array($username));
        return $login;  
    }
}