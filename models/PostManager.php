<?php

require_once('models/Manager.php');
require_once('models/Post.php');
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
    $req = $db->prepare('SELECT id, title, content FROM posts WHERE id = ?');
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
  }

  public function addPost($postId, $author, $title, $content)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('INSERT INTO posts(author, title, content, creation_date) VALUES(:author, :title, :content, NOW()) ');
    $affectedLines = $req->execute(array($postId, $author, $title, $content));

    return $affectedLines;
  }

  public function editPost($id, $content)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE posts SET author = :author, title = :title, content = :content, edition_date = NOW() WHERE id = :id');
    $newPost = $req->execute(array($content, $id));

    return $newPost;
  }

  public function deletePost($id)
  {
    $this->$db->exec('DELETE FROM posts WHERE id = '.(int) $id);
  }

/*
  public function count()
  {
    return $this->db->query('SELECT COUNT(*) FROM posts')->fetchColumn();
  }


  public function getList($start = -1, $limit = -1)
  {
    $sql = 'SELECT id, author, title, content, creation_date,  FROM posts ORDER BY id DESC';

    // On vérifie l'intégrité des paramètres fournis.
    if ($start != -1 || $limit != -1)
    {
      $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
    }

    $req = $this->db->query($sql);
    $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'post');

    $listPosts = $req->fetchAll();

    // On parcourt notre liste de post pour pouvoir placer des instances de DateTime en guise de dates d'ajout et de modification.
    foreach ($listPosts as $post)
    {
      $post->setCreationDate(new DateTime($post->creationDate()));
      $post->setEditionDate(new DateTime($post->editionDate()));
      //comment peut-on faire appel à une classe qui n'existe pas ?
    }

    $req->closeCursor();

    return $listPosts;
  }
*/

  public function getUnique($id)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, author, title, content, creation_date, edition_date FROM posts WHERE id = :id');
    $req->bindValue(':id', (int) $id, PDO::PARAM_INT);
    $req->execute();

    $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'post');

    $post = $req->fetch();

    //$post->setCreationDate(new DateTime($post->creationDate()));
  //  $post->setEditionDate(new DateTime($post->editionDate()));

    return $post;
  }


  public function save(Post $post)
  {
    if ($post->isValid())
    {
      $post->isNew() ? $this->add($post) : $this->update($post);
    }
    else
    {
      throw new RuntimeException('La post doit être valide pour être enregistrée');
    }
  }
}
