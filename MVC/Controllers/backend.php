<?php 

namespace App\backend;
use App\Models\AnimalManager;
use App\Models\CommentManager;
use App\Models\UserManager;
use App\Models\PostManager;

class BackEndController {

    public function adminAnimalsView(){
        $animalManager = new \App\Models\AnimalManager();
        $animals = $animalManager->getAnimals();
        require('MVC/Views/Private/adminAnimalView.php');
    }
    
    public function adminCommentsView(){
        $commentManager = new \App\Models\CommentManager();
        $reportedCommentsPosts = $commentManager->getReportedCommentsPosts();
        $reportedCommentsAnimals = $commentManager->getReportedCommentsAnimals();
        require('MVC/Views/Private/adminManageComments.php');
    }

    public function spa_jsonView()
    {
        $datamanager = new \App\Models\Data_to_json();
        $getjson = $datamanager->all_spas();
        require('MVC/Views/Private/spa_json.php');
    }

    public function adminPostView()
    {
        $postManager = new \App\Models\PostManager();
        $pagiPost = $postManager->paginationPost();
        $numberPosts = $pagiPost['total'];
        $messagePerPage = 5;
        $totalPages = ceil($numberPosts / $messagePerPage); //Round fractions up

        if(isset($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $totalPages) {
            $pageActive = intval($_GET['page']); //Get the integer value of a variable
        }
        else {
            $pageActive = 1;
        }
        $firstMessage = ($pageActive-1) * $messagePerPage; 
        $posts = $postManager->getPosts($firstMessage,$messagePerPage);
        require('MVC/Views/Private/adminPostView.php');
    }

    public function addOnePost($title, $post)
    {
        $postManager = new PostManager();
        try {
            $addaPost = $postManager->addPost($title, $post);
            if ($addaPost === false) { //if an error pop here title and post will be saved 
                $previousPostTitle = $title;
                $previousPost = $post;
                throw new \Exception('Impossible d\'ajouter le post !');
                require('MVC/Views/Private/adminPostCreation.php');
            }
            else {
                header('Location: https://projetsls.fr/SPA-Chamalieres/Acceuil');
            }
        } catch (\Exception $e){
            $error = $e->getMessage();
            require('MVC/Views/Private/adminPostCreation.php');
        }  
    }

    public function modifyOnePost($title, $post, $postId)
    {
        $postManager = new PostManager();
        $postManager->modifyPost($title, $post, $postId);
        header('Location: https://projetsls.fr/SPA-Chamalieres/Administration-Post/Page-1');
    }

    public function deleteOnePost($post_id)
    {
        $postManager = new PostManager();
        $postManager->removePost($post_id);
        $commentManager = new CommentManager();
        $commentManager->removeAllCommentsFromPost($post_id);
        header('Location: https://projetsls.fr/SPA-Chamalieres/Administration-Post/Page-1');
    }

    public function deleteOneAnimal($animal_id)
    {
        $animalManager = new AnimalManager();
        $animalManager->removeAnimal($animal_id);
        $commentManager = new CommentManager();
        $commentManager->removeAllCommentsFromAnimalPost($animal_id);
        $img_jpg = 'images/animals/' . $animal_id . '.jpg';
        $img_jpeg = 'images/animals/' . $animal_id . '.jpeg';
        if(file_exists($img_jpg)){
            unlink($img_jpg);
        } elseif (file_exists($img_jpeg)){
            unlink($img_jpeg);
        }
        header('Location: https://projetsls.fr/SPA-Chamalieres/Administration-Animaux');
    }

    public function removeComment($comment_id)
    {
        $commentManager = new CommentManager();
        $commentManager->removeComment($comment_id);
        header('Location: https://projetsls.fr/SPA-Chamalieres/Administration-Commentaires');
    }

    public function acceptComment($comment_id)
    {
        $commentManager = new CommentManager();
        $commentManager->acceptComment($comment_id);
        header('Location: https://projetsls.fr/SPA-Chamalieres/Administration-Commentaires');
    }
    
    public function viewPostAdmin(){
        $postManager = new PostManager();
        try {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postAdmin = $postManager->getPost($_GET['id']);
            require('MVC/Views/Private/adminModify.php');
            }
            else {
                throw new \Exception('Erreur : aucun identifiant de billet envoyé');
            }
        } catch (\Exception $e){
            $error = $e->getMessage();
            require('MVC/Views/Private/adminPostView.php');
        }

    }

    public function viewAnimalAdmin(){
        $animalManager = new AnimalManager();
        try {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $animalAdmin = $animalManager->getAnimal($_GET['id']);
                require('MVC/Views/Private/adminAnimalModify.php');
            }
            else {
                throw new \Exception('Erreur : aucun identifiant de billet envoyé');
            }
        } catch (\Exception $e){
            $error = $e->getMessage();
            require('MVC/Views/Private/adminAnimalView.php');
        }

    }

    public function addOneAnimal($name, $description, $type, $age, $sexe)
    {
        try {
            if(isset($_FILES["animal_image"])){
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg"); //We only want .jpg or .jpeg files, you can change that here if you want
                $filename = $_FILES["animal_image"]["name"];
                $filetype = $_FILES["animal_image"]["type"];
                $filesize = $_FILES["animal_image"]["size"];

                $ext = pathinfo($filename, PATHINFO_EXTENSION); //Returns information about a file path
                if(!array_key_exists($ext, $allowed)){ //Checking if the given key or index exists in the array
                    throw new \Exception('Erreur : Veuillez sélectionner un format jpg.');
                }

                $maxsize = 5 * 1024 * 1024; //5Mo 
                if($filesize > $maxsize) { //Checking file's weight
                    throw new \Exception('Erreur: La taille du fichier est supérieure à 5 Mo.');
                }

                if(in_array($filetype, $allowed)){ //Checking if the extension is allowed
                    $animalManager = new AnimalManager();
                    $addanAnimal = $animalManager->addAnimal($name, $description, $type, $age, $sexe);    
                    if ($addanAnimal === false) {
                        throw new \Exception('Erreur: La taille du fichier est supérieure à 5 Mo.');                 
                    } else { //if all good we check the last animal id, we move the image and we rename it
                        $lastanimal = $animalManager->lastAnimal(); 
                        move_uploaded_file($_FILES["animal_image"]["tmp_name"], "images/animals/" . $_FILES["animal_image"]["name"]);
                        rename("images/animals/" . $_FILES["animal_image"]["name"], "images/animals/" . $lastanimal['id'] . ".jpg");    
                    }
                } else {
                    throw new \Exception('Erreur: Il y a eu un problème de téléchargement. Veuillez réessayer.');
                }
            } else {
                throw new \Exception('Erreur: ' . $_FILES["animal_image"]["error"] .' ');
            }
        } catch (\Exception $e){
            $error = $e->getMessage();
            require('MVC/Views/Private/adminformAnimal.php');
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
            $result .= mb_substr($chars, $index, 1); //read an under chain
        }
        //We need to check if email already exist
        $userManager = new UserManager();
        $checkemails = $userManager->checkEmail($email);
        try {
            if ($checkemails['email'] === $email){
                //If the email already exist we send a new password
                $userManager->modifyProfile(password_hash($result, PASSWORD_DEFAULT),$name);
                $from = "spa.chamalieres.contact@gmail.com";
                $to = $email; 
                $subject = "Création compte administrateur SPA Chamalières"; 
                $msg = 'Votre mot de passe a été réinitialisé.' . "\n" . 'Votre mot de passe temporaire est le suivant : ' . $result . "\n" . 'Pour changer votre mot de passe : https://projetsls.fr/SPA-Chamalieres/Profil'; 
                $headers = "From:" . $from;
                mb_send_mail($to,$subject,$msg, $headers);
                throw new \Exception('Le nouveau mot de passe à été envoyé !');
            } else {
                //If not we sent the name and the password and email to the database
                $addanAdmin = $userManager->addAdmin($name, password_hash($result, PASSWORD_DEFAULT), $email);
                if ($addanAdmin === false) {
                    throw new \Exception('Impossible de créer le compte administrateur!');
                }
                else {
                    //If all good we send an email for the recap and the instructions
                    $from = "spa.chamalieres.contact@gmail.com";
                    $to = $email; 
                    $subject = "Création compte administrateur SPA Chamalières"; 
                    $msg = 'Votre compte administrateur a bien été crée !'. "\n" . 'Pour vous connecter, veuillez utiliser votre adresse e-mail et votre mot de passe ci-dessous.' . "\n" . 'Votre mot de passe temporaire : ' . $result . "\n" . 'Pour changer votre mot de passe : https://projetsls.fr/SPA-Chamalieres/Profil'; 
                    $headers = "From:" . $from;
                    mb_send_mail($to,$subject,$msg, $headers);
                    header('Location: https://projetsls.fr/SPA-Chamalieres/Administration/Mail-nouvel-administrateur-envoyé');
                }
            }
        } catch (\Exception $e){
            $error = $e->getMessage();
            require('MVC/Views/Private/adminManageRights.php');
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
                }
                else {
                    header('Location: https://projetsls.fr/SPA-Chamalieres/Administration/Mot-de-passe-changé');
                }
            } else {
                throw new \Exception('Vos mots de passes ne sont pas identiques !');
            }
        } catch (\Exception $e){
            $error = $e->getMessage();
            require('MVC/Views/Private/adminProfile.php');
        }
    }

    public function modifyOneAnimal($name, $description, $type, $age, $sexe, $animal_id)
    {
        $animalManager = new AnimalManager();
        $animalManager->modifyAnimal($name, $description, $type, $age, $sexe, $animal_id);
        header('Location: https://projetsls.fr/SPA-Chamalieres/Administration-Animaux');
    }

    public function showAdminView(){
        if (isset($_GET['msg'])){
            if ($_GET['msg'] == 'pass_success') {
                $message = 'Votre mot de passe à été réinitialisé !';
            } elseif ($_GET['msg'] == 'new_admin_success') {
                $message = 'Le mail a été envoyé a l\'adresse indiquée !';
            } 
        }
        require('MVC/Views/Private/adminView.php');
    }

    public function disconnectRedirection(){
        header('Location: https://projetsls.fr/SPA-Chamalieres/Acceuil');
    }

}