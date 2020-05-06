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
} elseif ($action=="propos"){
    require('Views/propos.php');
}