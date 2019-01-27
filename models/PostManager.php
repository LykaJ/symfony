<?php
//namespace Blog;

require_once('models/Manager.php');
/**
*
*/
class PostManager extends Manager
{
    public function getPosts()
    {
<<<<<<< HEAD
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, author, content, creation_date, edition_date, status FROM posts ORDER BY creation_date DESC');
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);

        return $result;

=======
        $req = $this->db->prepare('SELECT * FROM posts ORDER BY creation_date DESC');
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;
>>>>>>> views
    }

    public function getPost($postId)
    {
<<<<<<< HEAD
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, author, content, creation_date, edition_date, status FROM posts WHERE id = ?');
=======
        $req = $this->db->prepare('SELECT id, title, author, content, creation_date, edition_date, status FROM posts WHERE id = ?');
>>>>>>> views
        $req->execute(array($postId));
        $post = $req->fetch();
        return $post;
    }

    public function postPost($title, $author, $content)
    {
<<<<<<< HEAD
        $db = $this->dbConnect();
        $newPost = $db->prepare('INSERT INTO posts(title, author, content, creation_date, edition_date, status) VALUES(?, ?, ?, NOW(), NULL, NULL)');
=======
        $newPost = $this->db->prepare('INSERT INTO posts(title, author, content, creation_date, edition_date, status) VALUES(?, ?, ?, NOW(), NULL, NULL)');
>>>>>>> views
        $newPostLines = $newPost->execute(array($title, $author, $content));
        return $newPostLines;
    }

    public function updatePost($id, $title, $content)
    {
        $req = $this->db->prepare('UPDATE posts SET title = ?, content = ?, edition_date = NOW() WHERE id = ?');
        $updatedPost = $req->execute(array($title, $content, $id));
        return $updatedPost;
    }

<<<<<<< HEAD
    public function updatePostStatus($id, $status)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET status = 1 WHERE id = ?');
        $updatedStatus = $req->execute(array($status, $id));

        return $updatedStatus;
=======
    public function updatePostStatus($id)
    {
        $req = $this->db->prepare('UPDATE posts SET status = 1 WHERE id = ?');
        $newStatus = $req->execute(array($id));

        return $newStatus;
>>>>>>> views
    }

    public function deletePost($id)
    {
        $req = $this->db->prepare('DELETE FROM posts WHERE id = ?');
        $deletedPost = $req->execute(array($id));
        return $deletedPost;
    }
}
