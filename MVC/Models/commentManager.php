<?php namespace App\Models;
require_once('Manager.php');
class CommentManager extends Manager {

    public function getComments($postId)
    {
        $db = $this->dbConnection();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        return $comments;
    }

    public function getAnimalComments($animal_id)
    {
        $db = $this->dbConnection();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments WHERE animal_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($animal_id));
        return $comments;
    }

    public function addComment($postId, $author, $comment)
    {
        $db = $this->dbConnection();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $addaComment = $comments->execute(array($postId, $author, $comment));
        return $addaComment;
    }

    public function addCommentAnimal($animalId, $author, $comment)
    {
        $db = $this->dbConnection();
        $comments = $db->prepare('INSERT INTO comments(animal_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $addaCommentAnimal = $comments->execute(array($animalId, $author, $comment));
        return $addaCommentAnimal;
    }

    public function removeComment($comment_id)
    {
        $db = $this->dbConnection();
        $removeaComment = $db->prepare('DELETE FROM comments WHERE reported=1 AND id=?');
        $remove = $removeaComment->execute(array($comment_id));
        return $remove;
    }

    public function removeAllCommentsFromPost($post_id)
    {
        $db = $this->dbConnection();
        $removeaComment = $db->prepare('DELETE FROM comments WHERE post_id=?');
        $remove = $removeaComment->execute(array($post_id));
        return $remove;
    }

}