<?php
require_once('Manager.php');
class PostManager extends Manager{

    public function getPosts()
    {
        $db = $this->dbConnection();
        $req = $db->query('SELECT id, title, post, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM posts ORDER BY post_date DESC LIMIT 0, 5');
        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnection();
        $req = $db->prepare('SELECT id, title, post, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
        return $post;
    }

    public function addPost($title, $post)
    {
        $db = $this->dbConnection();
        $reqPost = $db->prepare('INSERT INTO posts(title, post, post_date) VALUES(?, ?, NOW())');
        $addaPost = $reqPost->execute(array($title, $post));
        return $addaPost;
    }

    public function modifyPost($title, $post, $postId)
    {
        $db = $this->dbConnection();
        $modifyaPost = $db->prepare('UPDATE posts SET title = :title , post = :post WHERE id= :id');
        $modifyPost = $modifyaPost->execute(array(
            'title' => $title,
            'post' => $post,
            'id' => $postId
        ));
    }

    public function removePost($post_id)
    {
        $db = $this->dbConnection();
        $removeaPost = $db->prepare('DELETE FROM posts WHERE id = ?');
        $removePost = $removeaPost->execute(array($post_id));
        return $removePost;
    }
}