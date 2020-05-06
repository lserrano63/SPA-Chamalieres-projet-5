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

/*function login()
{
    if (isset($_POST["name"])  == $login["name"]){
        if (isset($_POST["password"]) && password_verify($_POST["password"], '$login["password"]')){			
            $_SESSION['connected'] = true;
            header('Location: index.php');
        } else {
            echo 'Mot de passe non valide';
        }
    }
}
*/