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
                if(file_exists("images/animals/" . $_FILES["animal_image"]["name"])){ //Checking if the image is already in the folder with the same name
                    echo $_FILES["animal_image"]["name"] . " existe déjà.";
                } else { //If not we send the form data, we change the image's location and we rename it with the last entry on our database.
                    $animalManager = new AnimalManager();
                    $addanAnimal = $animalManager->addAnimal($name, $description, $type, $age, $sexe);    
                    if ($addanAnimal === false) {
                        die('Impossible de créer la fiche animale !');
                    }
                    else {
                        $lastanimal = $animalManager->lastAnimal();
                        move_uploaded_file($_FILES["animal_image"]["tmp_name"], "images/animals/" . $_FILES["animal_image"]["name"]);
                        rename("images/animals/" . $_FILES["animal_image"]["name"], "images/animals/" . $lastanimal['id'] . ".jpg");
                        echo "Votre fichier a été téléchargé.";
                        //header('Location: index.php?action=viewAnimals');
                    }
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
        $userManager = new UserManager();
        $addanAdmin = $userManager->addAdmin($name, password_hash($password, PASSWORD_DEFAULT), $email);
        if ($addanAdmin === false) {
            die('Impossible de créer le compte administrateur!');
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

    public function sendEmailCreationAdmin($email)
    {
        $from = "spa.chamalieres.contact@gmail.com";
        $to = $email; 
        $subject = "Création compte administrateur sur le site de la SPA de Chamlières"; 
        $message = 'Veuillez remplir le formulaire à l\'addresse suivante : https://projetsls.fr/SPA-Chamalieres/index.php?action=newAdminUser'; 
        $headers = "From:" . $from;
        mail($to,$subject,$message, $headers);
        header('Location: index.php?action=admin');
    }

}