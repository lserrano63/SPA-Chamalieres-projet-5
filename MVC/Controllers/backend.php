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
        if(isset($_FILES["animal_image"])){

            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg");
            $filename = $_FILES["animal_image"]["name"];
            $filetype = $_FILES["animal_image"]["type"];
            $filesize = $_FILES["animal_image"]["size"];

            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)){
                die("Erreur : Veuillez sélectionner un format jpg.");
            }

            $maxsize = 5 * 1024 * 1024; //5Mo 
            if($filesize > $maxsize) { //Checking file's weight
                die("Error: La taille du fichier est supérieure à 5 Mo.");
            }

            if(in_array($filetype, $allowed)){ //Checking if the extension is allowed
                $animalManager = new AnimalManager();
                $addanAnimal = $animalManager->addAnimal($name, $description, $type, $age, $sexe);    
            if ($addanAnimal === false) {
                    //die('Impossible de créer la fiche animale !');
                    $errors = "Impossible de créer la fiche animale !";
                }
                else {
                    $lastanimal = $animalManager->lastAnimal();
                    move_uploaded_file($_FILES["animal_image"]["tmp_name"], "images/animals/" . $_FILES["animal_image"]["name"]);
                    rename("images/animals/" . $_FILES["animal_image"]["name"], "images/animals/" . $lastanimal['id'] . ".jpg");
                    echo "Votre fichier a été téléchargé.";
                    //header('Location: index.php?action=viewAnimals');
                }
            } else {
                echo "Error: Il y a eu un problème de téléchargement. Veuillez réessayer."; 
            }
        } else {
            echo "Error: " . $_FILES["animal_image"]["error"];
        }
    }

    public function addOneAdmin($name, $password, $email)
    {
        //First we are going to generate a random password
        $length = 10;
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars); //return $chars's length
    
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        //And we up name password and email to the database
        $userManager = new UserManager();
        $addanAdmin = $userManager->addAdmin($name, password_hash($result, PASSWORD_DEFAULT), $email);
        if ($addanAdmin === false) {
            die('Impossible de créer le compte administrateur!');
        }
        else {
            //if all good we send an email for the recap and instructions
            $from = "spa.chamalieres.contact@gmail.com";
            $to = $email; 
            $subject = "Création compte administrateur SPA Chamalières"; 
            $message = 'Votre compte administrateur a bien été crée !
            Pour vous connecter, veuillez utiliser votre adresse e-mail et votre mot de passe ci-dessous.
            Votre mot de passe temporaire : ' . $result . '
            Pour changer votre mot de passe : https://projetsls.fr/SPA-Chamalieres/index.php?action=viewProfile'; 
            $headers = "From:" . $from;
            mb_send_mail($to,$subject,$message, $headers);
            header('Location: index.php?action=admin');
        }
    }

    public function modifyProfileAdmin($password)
    {
        $userManager = new UserManager();
        $adminModify = $userManager->modifyProfile(password_hash($password, PASSWORD_DEFAULT),$name);
        if ($adminModify === false) {
            die('Ca marche pas');
        }
        else {
            header('Location: index.php?action=admin');
        }
    }

    public function modifyOneAnimal($name, $description, $type, $age, $sexe, $animal_id)
    {
        $animalManager = new AnimalManager();
        $animalManager->modifyAnimal($name, $description, $type, $age, $sexe, $animal_id);
    }

}