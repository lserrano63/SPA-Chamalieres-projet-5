<?php

namespace App\frontend;
use App\Models\AnimalManager;
use App\Models\CommentManager;
use App\Models\UserManager;
use App\Models\PostManager;

class FrontEndController {

    public function indexView(){
        $animalManager = new \App\Models\AnimalManager();
        $slider = $animalManager->sliderAnimals();
        $postManager = new \App\Models\PostManager();
        $postsIndex = $postManager->getPostsIndex();
        require('MVC/Views/Public/indexView.php');
    }

    public function animalsView(){
        $animalManager = new \App\Models\AnimalManager();
        $animals = $animalManager->getAllAnimals();
        require('MVC/Views/Public/animalsView.php');
    }

    public function viewPost(){
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        try {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $post = $postManager->getPost($_GET['id']);
                $postComments = $commentManager->getComments($_GET['id']);
                require('MVC/Views/Public/postView.php');
            }
            else {
                throw new \Exception('Erreur : aucun identifiant de billet envoyé !');
            }
        } catch(\Exception $e){
            $error = $e->getMessage();
            require('MVC/Views/Public/postView.php');
        }
        
    }

    public function viewAnimal(){
        $animalManager = new AnimalManager();
        $commentManager = new CommentManager();
        try {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $animal = $animalManager->getAnimal($_GET['id']);
                $animalComments = $commentManager->getAnimalComments($_GET['id']);
                require('MVC/Views/Public/animalView.php');
            }
            else {
                throw new \Exception('Erreur : aucun identifiant de billet envoyé !');
            }
        } catch(\Exception $e){
            $error = $e->getMessage();
            require('MVC/Views/Public/animalView.php');
        }
        
    }

    public function addOneComment($postId, $author, $comment)
    {
        $commentManager = new CommentManager();
        try {
            $addaComment = $commentManager->addComment($postId, htmlspecialchars($author), htmlspecialchars($comment));
            if ($addaComment === false) {
                throw new Exception('Impossible d\'ajouter le commentaire !');
            }
            else {
                header('Location: https://projetsls.fr/SPA-Chamalieres/Posts/Post-' . $postId);
            }
        } catch(\Exception $e){
            $error = $e->getMessage();
            require('MVC/Views/Public/postView.php');
        }
        
    }

    public function addOneCommentFromAnimalPage($animalId, $author, $comment)
    {
        $commentManager = new CommentManager();
        try {
            $addaComment = $commentManager->addCommentAnimal($animalId, htmlspecialchars($author), htmlspecialchars($comment));
            if ($addaComment === false) {
                throw new \Exception('Impossible d\'ajouter le commentaire !');
            }
            else {
                header('Location: https://projetsls.fr/SPA-Chamalieres/Animaux/Animal-' . $animalId);
            }
        } catch(\Exception $e){
            $error = $e->getMessage();
            require('MVC/Views/Public/animalView.php');
        }
        
    }

    public function login($name, $password)
    {
        $userManager = new UserManager();
        try {
            $login = $userManager->connection($name, $password);
            if ($login === false) {
                throw new \Exception('Utilisateur inconnu ou mot de passe erroné');
            }
            else {
                if (password_verify($password, $login['password'])){
                    $_SESSION['connected'] = true;
                    $_SESSION['name'] = $_POST["name"];
                    header('Location: https://projetsls.fr/SPA-Chamalieres/Acceuil');
                } else {
                    throw new \Exception('Utilisateur inconnu ou mot de passe erroné');
                }
            }
            require('MVC/Views/Public/login.php');
        } catch(\Exception $e){
            $error = $e->getMessage();
            require('MVC/Views/Public/login.php');
        }
       
    }

    public function reportFromPost($comment_id)
    {
        $commentManager = new CommentManager();
        $commentManager->report($comment_id);
        header('Location: https://projetsls.fr/SPA-Chamalieres/Posts/Post-'. $_GET['post_id']);
    }

    public function reportFromAnimal($comment_id)
    {
        $commentManager = new CommentManager();
        $commentManager->report($comment_id);
        header('Location: https://projetsls.fr/SPA-Chamalieres/Animaux/Animal-'. $_GET['animal_id']);
    }

}