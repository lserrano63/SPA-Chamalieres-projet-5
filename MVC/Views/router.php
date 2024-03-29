<?php

$action = $_GET['action'];
$frontEndController = new \App\frontend\FrontEndController();
$backEndController = new \App\backend\BackEndController();

try {
    if($action == 'spajson')
    {
        $backEndController->spa_jsonView();
    } elseif($action == 'viewPost')
    {
        $frontEndController->viewPost();
    } elseif($action == 'viewPosts')
    {
        $frontEndController->postsView();

    } elseif ($action == 'addComment') 
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) 
        {
            if (!empty($_POST['author']) && !empty($_POST['comment'])) 
            {
                $frontEndController->addOneComment($_GET['id'], $_POST['author'], $_POST['comment']);
            }
        }
        else {
            throw new \Exception('Erreur : aucun identifiant de billet envoyé');
        } 
    } elseif($action == 'viewAnimal')
    {
        $frontEndController->viewAnimal();
    } elseif($action == 'viewAnimals')
    {
        $frontEndController->animalsView();
    } elseif ($action == 'addCommentAnimal') 
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) 
        {
            if (!empty($_POST['author']) && !empty($_POST['comment'])) 
            {
                $frontEndController->addOneCommentFromAnimalPage($_GET['id'], $_POST['author'], $_POST['comment']);
            }
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    } elseif ($action == 'reportedCommentPost') {
        if (isset($_GET['id']) && $_GET['id'] > 0){
            $frontEndController->reportFromPost($_GET['id']);
        }
    } elseif ($action == 'reportedCommentAnimal') {
        if (isset($_GET['id']) && $_GET['id'] > 0){
            $frontEndController->reportFromAnimal($_GET['id']);
        }
    } elseif ($action=="mentions"){
        require('MVC/Views/Public/mentions.php');
    } elseif ($action=="login"){
        if (isset($_POST["name"]) && isset($_POST["password"])) {	
            $frontEndController->login($_POST['name'], $_POST['password']);
        } else {
            require('MVC/Views/Public/login.php');
        }
    } elseif (isset($_SESSION['connected']) && ($_SESSION['connected'] == true)){
        if ($action == 'disconnect') {
            $_SESSION = array();
            session_destroy();
            $backEndController->disconnectRedirection();;
        } elseif ($action == 'admin') {
            $backEndController->showAdminView();
        } elseif ($action == 'postCreation') {
            require('MVC/Views/Private/adminPostCreation.php');
        } elseif ($action == 'addPost') {
            if (!empty($_POST['title']) && !empty($_POST['post'])) 
            {
                $backEndController->addOnePost($_POST['title'], $_POST['post']);
            }
        } elseif ($action == 'formAnimal') {
            require('MVC/Views/Private/adminformAnimal.php');
        } elseif ($action == 'addAnimal') {
            if (!empty($_POST['name']) && !empty($_POST['description']) && isset($_POST['type']) && isset($_POST['age']) && isset($_POST['sexe'])  && !empty($_FILES['animal_image'])){
                $backEndController->addOneAnimal($_POST['name'], $_POST['description'], $_POST['type'], $_POST['age'], $_POST['sexe']);
                require('MVC/Views/Private/adminformAnimal.php');
            }
        } elseif ($action == 'adminAnimal') {
            $backEndController->adminAnimalsView();
        } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminAnimalModify')) {
            $backEndController->viewAnimalAdmin();
        } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminAnimalModified')){
            $backEndController->modifyOneAnimal($_POST['name'], $_POST['description'], $_POST['type'], $_POST['age'], $_POST['sexe'], $_GET['id']);
        } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminAnimalDelete')){
            $backEndController->deleteOneAnimal($_GET['id']);
        } elseif ($action == 'viewComments') {
            $backEndController->adminCommentsView();
        } elseif ($action == 'accept') {
            if (isset($_GET['id']) && $_GET['id'] > 0){
                $backEndController->acceptComment($_GET['id']);
            }
        } elseif ($action == 'remove') {
            if (isset($_GET['id']) && $_GET['id'] > 0){
                $backEndController->removeComment($_GET['id']);
            }
        } elseif ($action == 'manageRights') {
            require('MVC/Views/Private/adminManageRights.php');
        } elseif ($action == 'addRights') {
            if (!empty($_POST['email'])) { 
                $backEndController->addOneAdmin($_POST['email'],$password, $_POST['email']);
            }
        } elseif ($action == 'viewProfile') {
            require('MVC/Views/Private/adminProfile.php');
        } elseif ($action == 'modifyAdminProfile') {
            if (!empty($_POST['password']) && !empty($_POST['password_check'])) {
                $backEndController->modifyProfileAdmin($_POST['password'],$_POST['password_check'],$_SESSION['name']);
            }
        } elseif ($action == 'adminPost') {
            $backEndController->adminPostView();
        } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminPostModify')) {
            $backEndController->viewPostAdmin();
        } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminPostModified')){
            $backEndController->modifyOnePost($_POST['title'], $_POST['post'], $_GET['id']);
        } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminPostDelete')){
            $backEndController->deleteOnePost($_GET['id']);
        }
    } else {
        header('Location : https://projetsls.fr/SPA-Chamalieres');
    }
} catch (\Exception $e){
    $error = $e->getMessage();
    require('MVC/Views/Public/errorView.php');
}