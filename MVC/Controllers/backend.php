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
            $error = 'Impossible d\'ajouter le post !';
            $previousPostTitle = $title;
            $previousPost = $post;
            require('MVC/Views/Private/adminPostCreation.php');
        }
        else {
            header('Location: https://projetsls.fr/SPA-Chamalieres/Acceuil');
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
            $index = random_int(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }
        //We need to check if email already exist
        $userManager = new UserManager();
        $checkemails = $userManager->checkEmail($email);
        try {
            if ($checkemails['email'] === $email){
                throw new \Exception('Email déja enregistré dans la base de données');
            } else {
                //If not we sent name password and email to the database
                $addanAdmin = $userManager->addAdmin($name, password_hash($result, PASSWORD_DEFAULT), $email);
                if ($addanAdmin === false) {
                    throw new \Exception('Impossible de créer le compte administrateur!');
                    //die('Impossible de créer le compte administrateur!');
                }
                else {
                    //if all good we send an email for the recap and instructions
                    $from = "spa.chamalieres.contact@gmail.com";
                    $to = $email; 
                    $subject = "Création compte administrateur SPA Chamalières"; 
                    $message = 'Votre compte administrateur a bien été crée !
                    Pour vous connecter, veuillez utiliser votre adresse e-mail et votre mot de passe ci-dessous.
                    Votre mot de passe temporaire : ' . $result . '
                    Pour changer votre mot de passe : https://projetsls.fr/SPA-Chamalieres/Profil'; 
                    $headers = "From:" . $from;
                    mb_send_mail($to,$subject,$message, $headers);
                    header('Location: https://projetsls.fr/SPA-Chamalieres/Administration');
                }
            }
        } catch (\Exception $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

    }

    public function modifyProfileAdmin($password,$passwordCheck,$name)
    {
        try {
            if ($password == $passwordCheck){
                $userManager = new UserManager();
                $adminModify = $userManager->modifyProfile(password_hash($password, PASSWORD_DEFAULT),$name);
                if ($adminModify === false) {
                    throw new \Exception('Votre mot de passe ne peut être modifié');
                    //$error = 'Votre mot de passe ne peut être modifié';
                }
                else {
                    //$message = 'Votre mot de passe à été réinitialisé !';
                    
                    header('Location: https://projetsls.fr/SPA-Chamalieres/Administration?msg=success-pwd');
                }
            } else {
                //die('Ca marcheeeeeeeee pas');
                throw new \Exception('Vos mots de passes ne sont pas identiques !');
                //echo 'Exception reçue : ',  $e->getMessage('Vos mots de passes ne sont pas identiques !'), "\n";
                //$errors = 'Vos mots de passes ne sont pas identiques !';
                //$error = 'Vos mots de passes ne sont pas identiques !';

            }
        } catch (\Exception $e){
            $error = $e->getMessage();
            require ('MVC/Views/Private/adminProfile.php');
        }
    }

    public function modifyOneAnimal($name, $description, $type, $age, $sexe, $animal_id)
    {
        $animalManager = new AnimalManager();
        $animalManager->modifyAnimal($name, $description, $type, $age, $sexe, $animal_id);
    }

    public function showAdminView(){
        if (isset($_GET['msg']){
            if ($_GET['msg'] == 'success-pwd') {
                $message = 'Votre mot de passe à été réinitialisé !';
            }
        }
        require('MVC/Views/Private/adminView.php');
    }

}