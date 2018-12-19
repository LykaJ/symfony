<?php

require_once('models/Manager.php');
/**
*
*/
class PostManager extends Manager
{

  public function getPosts()
  {
    $db = $this->dbConnect();
    $req = $db->query('SELECT id, title, author, content FROM posts');

    return $req;
  }

  public function getPost($postId)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, title, author, content, creation_date FROM posts WHERE id = ?');
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
  }

  public function postPost($title, $author, $content)
  {
    $db = $this->dbConnect();
    $newPost = $db->prepare('INSERT INTO posts(title, author, content, creation_date, edition_date) VALUES(?, ?, ?, NOW(), NOW())');
    $newPostLines = $newPost->execute(array($title, $author, $content));

    return $newPostLines;
  }

  public function updatePost($id, $title, $content)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE posts SET title = ?, content = ?, edition_date = NOW() WHERE id = ?');
    $updatedPost = $req->execute(array($title, $content, $id));

    return $updatedPost;
  }

  public function count()
  {
    $db = $this->dbConnect();
    return $db->query('SELECT COUNT(*) FROM posts')->fetchColumn();
  }

  public function deletePost($id)
  {
    $db = $this->dbConnect();
    $db->exec('DELETE FROM posts WHERE id = '.(int) $id);
  }
}
//POST UNIQUE ID VERIFICATION
