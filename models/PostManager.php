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
    $req = $db->query('SELECT id, title, content FROM posts');

    return $req;
  }

  public function getPost($postId)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, title, content, creation_date FROM posts WHERE id = ?');
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
  }

  public function postPost($author, $title, $content)
  {
    $db = $this->dbConnect();
    $newPosts = $db->prepare('INSERT INTO posts(title, author, content, creation_date, edition_date) VALUES(?, ?, ?, NOW(), NOW())');
    $newPostLines = $newPosts->execute(array($author, $title, $content));

    return $newPostLines;
  }

  public function updatePost($id, $post)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE posts SET author = ?, title = ?, content = ?, edition_date = NOW() WHERE id = ?');
    $updatedPost = $req->execute(array($post, $id));

    return $updatedPost;
  }

  /**
  * @see NewsManager::count()
  */
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


//POST UNIQUE ID VERIFICATION

  public function getUnique($id)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, author, title, content, creation_date, edition_date FROM posts WHERE id = :id');
    $req->bindValue(':id', (int) $id, PDO::PARAM_INT);
    $req->execute();

    $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');

    $news = $req->fetch();

    $news->setDateCreation(new DateTime($news->dateCreation()));
    $news->setDateEdition(new DateTime($news->dateEdition()));

    return $news;
  }
}
