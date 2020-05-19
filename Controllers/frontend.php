<?php

function viewPost(){
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);
        require('Views/Public/postView.php');
    }
    else {
        echo 'Erreur : aucun identifiant de billet envoyé';
    }
}

function viewAnimal(){
    $animalManager = new AnimalManager();
    $commentManager = new CommentManager();
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $animal = $animalManager->getAnimal($_GET['id']);
        $comments = $commentManager->getAnimalComments($_GET['id']);
        require('Views/Public/animalView.php');
    }
    else {
        echo 'Erreur : aucun identifiant de billet envoyé';
    }
}

function addOneComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();
    $addaComment = $commentManager->addComment($postId, htmlspecialchars($author), htmlspecialchars($comment));
    if ($addaComment === false) {
        die('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=viewPost&id=' . $postId);
    }
}

function addOneCommentFromAnimalPage($animalId, $author, $comment)
{
    $commentManager = new CommentManager();
    $addaComment = $commentManager->addCommentAnimal($animalId, htmlspecialchars($author), htmlspecialchars($comment));
    if ($addaComment === false) {
        die('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=viewAnimal&id=' . $animalId);
    }
}

function login($name, $password)
{
    $userManager = new UserManager();
    $login = $userManager->connection($name, $password);
    if ($login === false) {
        $error = "Utilisateur inconnu ou mot de passe erroné";
    }
    else {
       
        if (password_verify($password, $login['password'])){
            $_SESSION['connected'] = true;
            header('Location: index.php');
        } else {
            $error = "Utilisateur inconnu ou mot de passe erroné";
        }
    }
    require('Views/Public/login.php');
}