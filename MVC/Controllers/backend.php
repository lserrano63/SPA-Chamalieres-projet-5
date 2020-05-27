<?php 

namespace App\backend;
use App\Models\AnimalManager;
use App\Models\CommentManager;
use App\Models\UserManager;
use App\Models\PostManager;

class BackEndController {

    public function addOnePost($title, $post)
    {
        $postManager = new PostManager();
        $addaPost = $postManager->addPost($title, $post);
        if ($addaPost === false) {
            die('Impossible d\'ajouter le post !');
        }
        else {
            header('Location: index.php');
        }
    }

    public function modifyOnePost($title, $post, $postId)
    {
        $postManager = new PostManager();
        $postManager->modifyPost($title, $post, $postId);
    }

    public function deleteOnePost($post_id)
    {
        $postManager = new PostManager();
        $postManager->removePost($post_id);
        $commentManager = new CommentManager();
        $commentManager->removeAllCommentsFromPost($post_id);
    }

    public function deleteOneAnimal($animal_id)
    {
        $animalManager = new AnimalManager();
        $animalManager->removeAnimal($animal_id);
        $commentManager = new CommentManager();
        $commentManager->removeAllCommentsFromAnimalPost($animal_id);
    }

    public function removeComment($comment_id)
    {
        $commentManager = new CommentManager();
        $commentManager->removeComment($comment_id);
    }

    public function acceptComment($comment_id)
    {
        $commentManager = new CommentManager();
        $commentManager->acceptComment($comment_id);
    }
    
    public function viewPostAdmin(){
        $postManager = new PostManager();
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postAdmin = $postManager->getPost($_GET['id']);
            require('MVC/Views/Private/adminModify.php');
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }

    public function viewAnimalAdmin(){
        $animalManager = new AnimalManager();
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $animalAdmin = $animalManager->getAnimal($_GET['id']);
            require('MVC/Views/Private/adminAnimalModify.php');
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }

    public function addOneAnimal($name, $description, $type, $age, $sexe)
    {
        $animalManager = new AnimalManager();
        $addanAnimal = $animalManager->addAnimal($name, $description, $type, $age, $sexe);   
        if ($addanAnimal === false) {
            die('Impossible de créer la fiche animale !');
        }
        else {
            header('Location: index.php');
        }
    }

    public function addOneAdmin($name, $password, $email)
    {
        $userManager = new UserManager();
        $addanAdmin = $userManager->addAdmin($name, password_hash($password, PASSWORD_DEFAULT), $email);
        if ($addanAdmin === false) {
            die('Impossible de créer le compte administrateur!');
        }
        else {
            header('Location: index.php?action=admin');
        }
    }

    public function changeImageNameAndLocation()
    {
        if (isset($_FILES['animal_image']['tmp_name'])) {
            copy($_FILES['animal_image']['tmp_name'], $_FILES['animal_image']['name']);
        }
    }

    public function modifyOneAnimal($name, $description, $type, $age, $sexe, $animal_id)
    {
        $animalManager = new AnimalManager();
        $animalManager->modifyAnimal($name, $description, $type, $age, $sexe, $animal_id);
    }

}