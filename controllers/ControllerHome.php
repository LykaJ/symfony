<?php

// Chargement des classes
require_once('models/PostManager.php');
require_once('models/CommentManager.php');
require_once('models/Manager.php');


//CREATION CLASSE
class ControllerHome
{
  private $_postManager;
  private $_view;

  public function __construct($url)
  {
    if(isset($url) && count($url) > 1)
    {
      throw new Exception('Page introuvable');
    }
    else {
      $this->posts();
    }
  }

  private function posts()
  {
    $this->_postManager = new PostManager;
    $posts = $this->_postManager->getPost();

    require_once('view/frontend/listPosts.php');
  }
}



//POSTS

function listPosts()
{
  $postManager = new PostManager(); // Création d'un objet
  $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

  require('view/frontend/listPostsView.php');
}

function showPost()
{
  if (isset($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($id);
    $comments = $commentManager->getComments($id);

    require('view/frontend/postView.php');
  } else {
    throw new Exception('Aucun identifiant de billet envoyé');
  }
}

function createPost()
{
  require_once('view/frontend/addPostView.php');

  if (!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['content']))
  {
    $author = $_POST['author'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $postManager = new PostManager();

    $newPostLines = $postManager->postPost($author, $title, $content);

    if ($newPostLines === false) {
      throw new Exception('Impossible d\'ajouter le post !');
    }
  }
}

//COMMENTS
function addComment()
{
  if (isset($_GET['id']) && $_GET['id'] > 0) {
    if (!empty($_POST['author']) && !empty($_POST['comment'])) {

      $postId = $_GET['id'];
      $author = $_POST['author'];
      $comment = $_POST['comment'];
      $commentManager = new CommentManager();

      $affectedLines = $commentManager->postComment($postId, $author, $comment);

      if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
      }
      else {
        header('Location: index.php?action=post&id=' . $postId);
      }
    } else {
      throw new Exception('Tous les champs ne sont pas remplis !');
    }
  } else {
    throw new Exception('Aucun identifiant de billet envoyé');
  }
}

function updateComment()
{
  if (isset($_GET['id']) && $_GET['id'] > 0) {
    if (!empty($_POST['comment'])) {

      $id = $_GET['id'];
      $comment = $_POST['comment'];

      $commentManager = new CommentManager();

      $newComment = $commentManager->updateComment($id, $comment);

      if ($newComment == false) {
        throw new Exception("Impossible d\'editer le commentaire !");
      }
      else {
        echo "commentaire :" . $_POST['comment'];
        header('Location: index.php?action=editComment&id=' . $id);
      }
    } else {
      throw new Exception('Tous les champs ne sont pas remplis !');
    }
  } else {
    throw new Exception('Aucun identifiant de billet envoyé');
  }
}

function editComment()
{
  if(isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];

    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($id);
    $comment = $commentManager->getComment($id);

    require('view/frontend/commentView.php');
  }
}


// RECUPERER INFOS POST






//MODIFIER POST ET SUPPRIMER POST
