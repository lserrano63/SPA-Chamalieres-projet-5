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

function removeComment($comment_id)
{
    $commentManager = new CommentManager();
    $commentManager->removeComment($comment_id);
}

function viewPostAdmin(){
    $postManager = new PostManager();
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $postAdmin = $postManager->getPost($_GET['id']);
        require('Views/Private/adminModify.php');
    }
    else {
        echo 'Erreur : aucun identifiant de billet envoyé';
    }
}

function viewAnimalAdmin(){
    $animalManager = new AnimalManager();
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $animalAdmin = $animalManager->getAnimal($_GET['id']);
        require('Views/Private/adminAnimalModify.php');
    }
    else {
        echo 'Erreur : aucun identifiant de billet envoyé';
    }
}

function addOneAnimal($name, $description, $type, $age, $sexe)
{
    $animalManager = new AnimalManager();
    $addanAnimal = $animalManager->addAnimal($name, $description, $type, $age, $sexe);
    if ($addanAnimal === false) {
        die('Impossible de créer la fiche animale !');
    }
    else {
        header('Location: index.php');
    }
}

function modifyOneAnimal($name, $description, $type, $age, $sexe, $animal_id)
{
    $animalManager = new AnimalManager();
    $animalManager->modifyAnimal($name, $description, $type, $age, $sexe, $animal_id);
}

function deleteOneAnimal($animal_id)
{
    $animalManager = new AnimalManager();
    $animalManager->removeAnimal($animal_id);
    $commentManager = new CommentManager();
    $commentManager->removeAllCommentsFromPost($animal_id);
}

/*function removeComment($comment_id) ANIMAL comment a faire en commentmanagaer
{
    $commentManager = new CommentManager();
    $commentManager->removeComment($comment_id);
}*/