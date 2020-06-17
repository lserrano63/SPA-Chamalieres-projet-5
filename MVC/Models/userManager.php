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

    public function addAdmin($name, $password, $email)
    {
        $db = $this->dbConnection();
        $reqAdmin = $db->prepare('INSERT INTO users(name, password, email) VALUES(?, ?, ?)');
        $addanAdmin = $reqAdmin->execute(array($name, $password, $email));
        return $addanAdmin;
    }

    public function modifyProfile($password,$name)
    {
        $db = $this->dbConnection();
        $modifyaPost = $db->prepare('UPDATE users SET password = :password WHERE name = :name');
        $modifyPost = $modifyaPost->execute(array(
            'password' => $password,
            'name' => $name
        ));
    }

    public function checkEmail($email)
    {
        $db = $this->dbConnection();
        $req = $db->prepare('SELECT email FROM users WHERE email = :email');
        $req->execute(array(
            'email' => $email
        ));
        $checkemails = $req->fetch();
        return $checkemails;
    }

}