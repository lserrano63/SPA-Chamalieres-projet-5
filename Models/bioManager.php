<?php
require_once('Manager.php');
class BioManager extends Manager {

    public function getBiography()
    {
        $db = $this->dbConnection();
        $reqBio = $db->query('SELECT bio,contact FROM biography');
        return $reqBio;
    }
    
    public function modifyBiography($bio, $contact)
    {
        $db = $this->dbConnection();
        $modifyaBio = $db->prepare('UPDATE biography SET bio = :bio , contact = :contact');
        $modifyBio = $modifyaBio->execute(array(
            'bio' => $bio,
            'contact' => $contact
        ));
    }
}