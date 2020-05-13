<?php

$action = $_GET['action'];

if($action == 'spajson')
{
    require('Models/data_to_json.php');
    require('Views/Private/spa_json.php');
} elseif($action == 'viewPost')
{
    require('Controllers/frontend.php');
    viewPost();
} elseif ($action == 'addComment') 
{
    if (isset($_GET['id']) && $_GET['id'] > 0) 
    {
        if (!empty($_POST['author']) && !empty($_POST['comment'])) 
        {
            require('Controllers/frontend.php');
            addOneComment($_GET['id'], $_POST['author'], $_POST['comment']);
        }
    }
    else {
        echo 'Erreur : aucun identifiant de billet envoyé';
    } 
} elseif ($action=="mentions"){
    require('Views/Public/mentions.php');
} elseif ($action=="login"){
    /*if (isset($_POST["name"]) && $_POST["name"] == $resultat['user'] ){
        if (isset($_POST["password"]) && password_verify($_POST["password"], '' . $resultat['password'] )){			
            $_SESSION['connected'] = true;
            header('Location: index.php');
        } else {
            echo 'Mot de passe non valide';
        }
    }*/
    if(!empty($_POST['name']) && !empty($_POST['password'])){
        $password = password_verify($_POST["password"], '' . $resultat['password'] );
        require('Controllers/frontend.php');
        login($_POST['name'], $password);
    } else {
        require('Views/Public/login.php');
    }
} elseif (isset($_SESSION['connected']) && ($_SESSION['connected'] == true)){
    if ($action == 'disconnect') {
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
    } elseif ($action == 'admin') {
        require('Views/Private/adminView.php');
    } elseif ($action == 'postCreation') {
        require('Views/Private/adminPostCreation.php');
    } elseif ($action == 'addPost') {
        if (!empty($_POST['title']) && !empty($_POST['post'])) 
        {
            require('Controllers/backend.php');
            addOnePost($_POST['title'], $_POST['post']);
        }
    } elseif ($action == 'formAnimal') {
        require('Views/Private/adminformAnimal.php');
    } elseif ($action == 'addAnimal') {
        if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['type']) && !empty($_POST['age']) && !empty($_POST['sexe'])){
            require('Controllers/backend.php');
            addOneAnimal($_POST['name'], $_POST['description'], $_POST['type'], $_POST['age'], $_POST['sexe']);
        }
    } elseif ($action == 'adminAnimal') {
        require('Views/Private/adminAnimalView.php');
    } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminAnimalModify')) {
        require('Controllers/frontend.php');
        require('Controllers/backend.php');
        viewAnimalAdmin();
    } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminAnimalModified')){
        require('Controllers/backend.php');
        modifyOneAnimal($_POST['name'], $_POST['description'], $_POST['type'], $_POST['age'], $_POST['sexe'], $_GET['id']);
        header('Location: index.php?action=adminAnimal');
    } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminAnimalDelete')){
        require('Controllers/backend.php');
        deleteOneAnimal($_GET['id']);
        header('Location: index.php?action=adminAnimal');
    } elseif ($action == 'viewComments') {
        require('Views/Private/adminManageComments.php');
    } elseif ($action == 'removeComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0){
            require('Controllers/backend.php');
            removeComment($_GET['id']);
            header('Location: index.php?action=adminManageComments');
        }
    } elseif ($action == 'adminRights') {
        require('Views/Private/adminManageRights.php');
    } elseif ($action == 'adminPost') {
        require('Views/Private/adminPostView.php');
    } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminPostModify')) {
        require('Controllers/frontend.php');
        require('Controllers/backend.php');
        viewPostAdmin();
    } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminPostModified')){
        require('Controllers/backend.php');
        modifyOnePost($_POST['title'], $_POST['post'], $_GET['id']);
        header('Location: index.php?action=adminPost');
    } elseif ((isset($_GET['id']) && $_GET['id'] > 0) && ($action == 'adminPostDelete')){
        require('Controllers/backend.php');
        deleteOnePost($_GET['id']);
        header('Location: index.php?action=adminPost');
    }
} 