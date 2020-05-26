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

    public function acceptComment($comment_id)
    {
        $db = $this->dbConnection();
        $acceptaComment = $db->prepare('UPDATE comments SET reported=0 WHERE id=?');
        $accept = $acceptaComment->execute(array($comment_id));
        return $accept;
    }

    public function removeComment($comment_id)
    {
        $db = $this->dbConnection();
        $removeaComment = $db->prepare('DELETE FROM comments WHERE id=?');
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

    public function removeAllCommentsFromAnimalPost($animal_id)
    {
        $db = $this->dbConnection();
        $removeaComment = $db->prepare('DELETE FROM comments WHERE animal_id=?');
        $remove = $removeaComment->execute(array($animal_id));
        return $remove;
    }

    public function report($comment_id)
    {
        $db = $this->dbConnection();
        $commentReport = $db->prepare('UPDATE comments SET reported=1 WHERE id=?');
        $report = $commentReport->execute(array($comment_id));
        return $report;
    }

    public function getReportedCommentsPosts()
    {
        $db = $this->dbConnection();
        $reportComPosts = $db->query('SELECT * , DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments WHERE reported = 1 AND (post_id != 0 AND animal_id=0) ORDER BY comment_date DESC');
        $reportedCommentsPosts = $reportComPosts->fetchAll();
        return $reportedCommentsPosts;
    }

    public function getReportedCommentsAnimals()
    {
        $db = $this->dbConnection();
        $reportComAnimals = $db->query('SELECT * , DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments WHERE reported = 1 AND (post_id =0 AND animal_id != 0) ORDER BY comment_date DESC');
        $reportedCommentsAnimals = $reportComAnimals->fetchAll();
        return $reportedCommentsAnimals;
    }
    
}