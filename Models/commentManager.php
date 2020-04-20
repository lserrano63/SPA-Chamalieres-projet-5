<?php
require_once('Manager.php');
class CommentManager extends Manager {

    public function getComments($postId)
    {
        $db = $this->dbConnection();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        return $comments;
    }

    public function addComment($postId, $author, $comment)
    {
        $db = $this->dbConnection();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $addaComment = $comments->execute(array($postId, $author, $comment));
        return $addaComment;
    }

    public function getReportedComments()
    {
        $db = $this->dbConnection();
        $reportedComments = $db->query('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr, reported FROM comments WHERE reported = 1 ORDER BY comment_date DESC');
        return $reportedComments;
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

    public function report($comment_id)
    {
        $db = $this->dbConnection();
        $commentReport = $db->prepare('UPDATE comments SET reported=1 WHERE id=?');
        $report = $commentReport->execute(array($comment_id));
        return $report;
    }
}