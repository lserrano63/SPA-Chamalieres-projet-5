<?php
require_once('Manager.php');
class AnimalManager extends Manager {

    public function getAllAnimals()
    {
        $db = $this->dbConnection();
        $req = $db->query('SELECT id, name, description, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr, type, age, sexe FROM animals ');
        $allAnimals = $req->fetchAll();
        return $allAnimals;
    }

    public function getAnimal($animal_id)
    {
        $db = $this->dbConnection();
        $req = $db->prepare('SELECT id, name, description, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr, type, age, sexe FROM animals WHERE id = ?');
        $req->execute(array($animal_id));
        $animal = $req->fetch();
        return $animal;
    }

    public function sliderAnimals()
    {
        $db = $this->dbConnection();
        $req = $db->query('SELECT * FROM animals ORDER BY id DESC LIMIT 0,5');
        return $req;
    }

    public function addAnimal($name, $description, $type, $age, $sexe)
    {
        $db = $this->dbConnection();
        $reqAnimal = $db->prepare('INSERT INTO animals(`id`, `name`, `description`, `date`, `type`, `age`, `sexe`) VALUES(NULL, ?, ?, NOW(), ?, ?,?)');
        $addanAnimal = $reqAnimal->execute(array($name, $description, $type, $age, $sexe));
        return $addanAnimal;
    }

    public function modifyAnimal($name, $description, $type, $age, $sexe, $animal_id)
    {
        $db = $this->dbConnection();
        $modifyanAnimal = $db->prepare('UPDATE animals SET name = :name, description = :description, type = :type, age = :age, sexe = :sexe WHERE id= :id');
        $modifyAnimal = $modifyanAnimal->execute(array(
            'name' => $name,
            'description' => $description,
            'type' => $type,
            'age' => $age,
            'sexe' => $sexe,
            'id' => $animal_id
        ));
    }

    public function removeAnimal($animal_id)
    {
        $db = $this->dbConnection();
        $removeAnAnimal = $db->prepare('DELETE FROM animals WHERE id = ?');
        $removeAnimal = $removeAnAnimal->execute(array($animal_id));
        return $removeAnimal;
    }

    public function getAnimals()
    {
        $db = $this->dbConnection();
        $req = $db->query('SELECT id, name, description, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr, type, age, sexe FROM animals ORDER BY date ');
        $animals = $req->fetchAll();
        return $animals;
    }

    public function getLastAnimal()
    {
        $db = $this->dbConnection();
        $req = $db->query('SELECT id FROM animals ORDER BY date DESC LIMIT 1');
        return $req;
    }
}