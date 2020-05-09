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
    require('Views/mentions.php');
}  elseif (isset($_SESSION['connected']) && ($_SESSION['connected'] == true)){
    if ($action == 'disconnect') {
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
    } elseif ($action == 'admin') {
        require('Views/adminView.php');
    } elseif ($action == 'postCreation') {
        require('Views/adminPostCreation.php');
    } elseif ($action == 'addPost') {
        if (!empty($_POST['title']) && !empty($_POST['post'])) 
        {
            require('Controllers/backend.php');
            addOnePost($_POST['title'], $_POST['post']);
        }
    } elseif ($action == 'viewComments') {
        require('Views/adminManageComments.php');
    } elseif ($action == 'removeComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0){
            require('Controllers/backend.php');
            removeComment($_GET['id']);
            header('Location: index.php?action=adminManageComments');
        }
    }
    elseif ($action == 'adminPost') {
        require('Views/adminPostView.php');
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