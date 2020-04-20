<?php 

function addOnePost($title, $post)
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

function modifyOnePost($title, $post, $postId)
{
    $postManager = new PostManager();
    $postManager->modifyPost($title, $post, $postId);
}

function deleteOnePost($post_id)
{
    $postManager = new PostManager();
    $postManager->removePost($post_id);
    $commentManager = new CommentManager();
    $commentManager->removeAllCommentsFromPost($post_id);
}

function acceptComment($comment_id)
{
    $commentManager = new CommentManager();
    $commentManager->acceptComment($comment_id);
}

function removeComment($comment_id)
{
    $commentManager = new CommentManager();
    $commentManager->removeComment($comment_id);
}

function viewPostAdmin(){
    $postManager = new PostManager();
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $postAdmin = $postManager->getPost($_GET['id']);
        require('Views/adminModify.php');
    }
    else {
        echo 'Erreur : aucun identifiant de billet envoyé';
    }
}

function modifyTheBiography($bio, $contact)
{
    $bioManager = new BioManager();
    $bioManager->modifyBiography($bio, $contact);
}