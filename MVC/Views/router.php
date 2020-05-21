<?php

$action = $_GET['action'];

if($action == 'spajson')
{
    require('MVC/Models/data_to_json.php');
    require('MVC/Views/Private/spa_json.php');
} elseif($action == 'viewPost')
{
    require('MVC/Controllers/frontend.php');
    $frontEndController = new \App\frontend\FrontEndController();
    $frontEndController->viewPost();
} elseif ($action == 'addComment') 
{
    if (isset($_GET['id']) && $_GET['id'] > 0) 
    {
        if (!empty($_POST['author']) && !empty($_POST['comment'])) 
        {
            require('MVC/Controllers/frontend.php');
            $frontEndController = new \App\frontend\FrontEndController();
            $frontEndController->addOneComment($_GET['id'], $_POST['author'], $_POST['comment']);
        }
    }
    else {
        echo 'Erreur : aucun identifiant de billet envoyé';
    } 
} elseif($action == 'viewAnimal')
{
    require('MVC/Controllers/frontend.php');
    $frontEndController = new \App\frontend\FrontEndController();
    $frontEndController->viewAnimal();
} elseif($action == 'viewAnimals')
{
    require('MVC/Views/Public/animalsView.php');
} elseif ($action == 'addCommentAnimal') 
{
    if (isset($_GET['id']) && $_GET['id'] > 0) 
    {
        if (!empty($_POST['author']) && !empty($_POST['comment'])) 
        {
            require('MVC/Controllers/frontend.php');
            $frontEndController = new \App\frontend\FrontEndController();
            $frontEndController->addOneCommentFromAnimalPage($_GET['id'], $_POST['author'], $_POST['comment']);
        }
    }
    else {
        echo 'Erreur : aucun identifiant de billet envoyé';
    }
} elseif ($action=="mentions"){
    require('MVC/Views/Public/mentions.php');
} elseif ($action=="login"){
    if (isset($_POST["name"]) && isset($_POST["password"])) {	

            require('MVC/Controllers/frontend.php');
            $frontEndController = new \App\frontend\FrontEndController();
            $frontEndController->login($_POST['name'], $_POST['password']);
    } else {
        require('MVC/Views/Public/login.php');
    }
} elseif (isset($_SESSION['connected']) && ($_SESSION['connected'] == true)){
    if ($action == 'disconnect') {
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
    } elseif ($action == 'admin') {
        require('MVC/Views/Private/adminView.php');
    } elseif ($action == 'postCreation') {
        require('MVC/Views/Private/adminPostCreation.php');
    } elseif ($action == 'addPost') {
        if (!empty($_POST['title']) && !empty($_POST['post'])) 
        {
            require('MVC/Controllers/backend.php');
            $backEndController = new \App\backend\BackEndController();
            $backEndController->addOnePost($_POST['title'], $_POST['post']);
        }
    } elseif ($action == 'formAnimal') {
        require('MVC/Views/Private/adminformAnimal.php');
    } elseif ($action == 'addAnimal') {
        if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['type']) && !empty($_POST['age']) && !empty($_POST['sexe'])){
            require('MVC/Controllers/backend.php');
            $backEndController = new \App\backend\BackEndController();
            $backEndController->addOneAnimal($_POST['name'], $_POST['description'], $_POST['type'], $_POST['age'], $_POST['sexe']);
        }
    } elseif ($action == 'adminAnimal') {
        require('MVC/Views/Private/adminAnimalView.php');
    } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminAnimalModify')) {
        require('MVC/Controllers/frontend.php');
        require('MVC/Controllers/backend.php');
        $backEndController = new \App\backend\BackEndController();
        $backEndController->viewAnimalAdmin();
    } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminAnimalModified')){
        require('MVC/Controllers/backend.php');
        $backEndController = new \App\backend\BackEndController();
        $backEndController->modifyOneAnimal($_POST['name'], $_POST['description'], $_POST['type'], $_POST['age'], $_POST['sexe'], $_GET['id']);
        header('Location: index.php?action=adminAnimal');
    } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminAnimalDelete')){
        require('MVC/Controllers/backend.php');
        $backEndController = new \App\backend\BackEndController();
        $backEndController->deleteOneAnimal($_GET['id']);
        header('Location: index.php?action=adminAnimal');
    } elseif ($action == 'viewComments') {
        require('MVC/Views/Private/adminManageComments.php');
    } elseif ($action == 'removeComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0){
            require('MVC/Controllers/backend.php');
            $backEndController = new \App\backend\BackEndController();
            $backEndController->removeComment($_GET['id']);
            header('Location: index.php?action=adminManageComments');
        }
    } elseif ($action == 'adminRights') {
        require('MVC/Views/Private/adminManageRights.php');
    } elseif ($action == 'adminPost') {
        require('MVC/Views/Private/adminPostView.php');
    } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminPostModify')) {
        require('MVC/Controllers/frontend.php');
        require('MVC/Controllers/backend.php');
        $backEndController = new \App\backend\BackEndController();
        $backEndController->viewPostAdmin();
    } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminPostModified')){
        require('MVC/Controllers/backend.php');
        $backEndController = new \App\backend\BackEndController();
        $backEndController->modifyOnePost($_POST['title'], $_POST['post'], $_GET['id']);
        header('Location: index.php?action=adminPost');
    } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminPostDelete')){
        require('MVC/Controllers/backend.php');
        $backEndController = new \App\backend\BackEndController();
        $backEndController->deleteOnePost($_GET['id']);
        header('Location: index.php?action=adminPost');
    }
} 