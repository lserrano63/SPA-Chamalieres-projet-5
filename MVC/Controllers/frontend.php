<?php

namespace App\frontend;
use App\Models\AnimalManager;
use App\Models\CommentManager;
use App\Models\UserManager;
use App\Models\PostManager;

class FrontEndController {

    public function viewPost(){
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $post = $postManager->getPost($_GET['id']);
            $comments = $commentManager->getComments($_GET['id']);
            require('MVC/Views/Public/postView.php');
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }

    public function viewAnimal(){
        $animalManager = new AnimalManager();
        $commentManager = new CommentManager();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $animal = $animalManager->getAnimal($_GET['id']);
            $comments = $commentManager->getAnimalComments($_GET['id']);
            require('MVC/Views/Public/animalView.php');
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }

    public function addOneComment($postId, $author, $comment)
    {
        $commentManager = new CommentManager();
        $addaComment = $commentManager->addComment($postId, htmlspecialchars($author), htmlspecialchars($comment));
        if ($addaComment === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: https://projetsls.fr/SPA-Chamalieres/Posts/Post-' . $postId);
        }
    }

    public function addOneCommentFromAnimalPage($animalId, $author, $comment)
    {
        $commentManager = new CommentManager();
        $addaComment = $commentManager->addCommentAnimal($animalId, htmlspecialchars($author), htmlspecialchars($comment));
        if ($addaComment === false) {
            die('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: https://projetsls.fr/SPA-Chamalieres/Animaux/Animal-' . $animalId);
        }
    }

    public function login($name, $password)
    {
        $userManager = new UserManager();
        $login = $userManager->connection($name, $password);
        if ($login === false) {
            $error = "Utilisateur inconnu ou mot de passe erroné";
        }
        else {
        
            if (password_verify($password, $login['password'])){
                $_SESSION['connected'] = true;
                $_SESSION['name'] = $_POST["name"];
                header('Location: https://projetsls.fr/SPA-Chamalieres/Acceuil');
            } else {
                $error = "Utilisateur inconnu ou mot de passe erroné";
            }
        }
        require('MVC/Views/Public/login.php');
    }

    public function report($comment_id)
    {
        $commentManager = new CommentManager();
        $commentManager->report($comment_id);
    }
}