<?php
require_once('controllers/Rooter.php');
require_once('controllers/ControllerHome.php');

$rooter = new Rooter();
$rooter->rooterReq();

try{
  $action = isset($_GET['action']) ? $_GET['action'] : null;

  switch($action) {
    case 'showPost':
      showPost();
    break;

    case 'newComment':
      newComment();
    break;

    case 'addComment':
      addComment();
    break;

    case 'viewComment':
      viewComment();
    break;

    case 'editComment':
      editComment();
    break;

    case 'updateComment':
      updateComment();
    break;

    case 'addPost':
      addPost();
    break;

    case 'editPost':
      editPost();
    break;

    case 'deletePost':
      deletePost();
    break;

    case 'listPosts':
    default:
    listPosts();

  }
}
catch(Exception $e) {
  echo 'Erreur : ' . $e->getMessage();
}
