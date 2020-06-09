<?php namespace App\Models;
require_once('Manager.php');

class PostManager extends Manager{

    public function getPostsIndex()
    {
        $db = $this->dbConnection();
        $req = $db->query('SELECT id, title, post, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM posts ORDER BY post_date DESC LIMIT 0, 3');
        $postsIndex = $req->fetchAll();
        return $postsIndex;
    }

    public function getPosts($firstMessage,$messagePerPage)
    {
        $db = $this->dbConnection();
        $req = $db->prepare('SELECT id, title, post, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM posts ORDER BY post_date DESC LIMIT :firstMessage, :messagePerPage ');
        $req->bindParam(":firstMessage",$firstMessage,\PDO::PARAM_INT);
        $req->bindParam(":messagePerPage",$messagePerPage,\PDO::PARAM_INT);
        $req->execute();
        $posts = $req->fetchAll();
        return $posts;
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

    public function paginationPost()
    {
        $db = $this->dbConnection();
        $page = $db->query('SELECT COUNT(*) AS total FROM posts');
        $pagiPost = $page->fetch();
        return $pagiPost;
    }

}