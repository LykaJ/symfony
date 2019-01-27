<?php

//namespace Blog;

require_once('models/PostManager.php');
require_once('models/UserManager.php');
require_once('models/UserRightManager.php');
require_once('controllers/BaseController.php');

//POST
//AFFICHER LA LISTE DES POSTS

class PostsController extends BaseController {

    function show()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {

            $id = $_GET['id'];
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $userRightsManager = new UserRightManager();

            $post = $postManager->getPost($id);
            $comments = $commentManager->getComments($id);
            $postStatus = $post['status'];

            if(isset($postStatus) && $postStatus != NULL) {

                    require('view/frontend/postView.php');

                } else {
                    header('Location: index.php');
                    flash_error('Ce post n\'est pas validé !');
                }
        }
        else {
            flash_error('Aucun identifiant de billet envoyé');
        }
    }

    function index()
    {
        $postManager = new PostManager();
        $userRightsManager = new UserRightManager();
        //$pagination = new PaginationManager();

        $posts = $postManager->getPosts();

        require('view/frontend/listPostsView.php');

    }



    //POST


    // AJOUTER UN POST
    function create()
    {
        $userRightsManager = new UserRightManager();

        if(!$userRightsManager->can('add post'))
        {
            flash_error('Vous n\'avez pas les droits');
            header('Location: index.php');
            return;
        }
        if (!empty($_SESSION['current_user']) && !empty($_POST['title']) && !empty($_POST['content']))
        {
            $author = $_SESSION['current_user']['pseudo'];
            $title = htmlspecialchars_decode($_POST['title'], ENT_QUOTES);
            $content = htmlspecialchars_decode($_POST['content'], ENT_QUOTES);
            $postManager = new PostManager();
            $newPostLines = $postManager->postPost($title, $author, $content);
            if ($newPostLines === false) {
                falsh_error('Impossible d\'ajouter le post !');
            } else {

                flash_warning('Le post doit être validé avant d\'apparaître dans la liste');
                header('Location: index.php');
            }
        }
    }

    function new()
    {
        $userRightsManager = new UserRightManager();
        if(!$userRightsManager->can('add post'))
        {
            flash_error('Vous n\'avez pas les droits');
            header('Location: index.php');
            return;
        }
        $token = $this->token;
        require_once('view/backend/addPostView.php');
    }


    // METTRE A JOUR UN POST
    function update()
    {
        if(isset($_GET['id']) && $_GET['id'] > 0)
        {
            if (!empty($_POST['title']) && !empty($_POST['content']))
            {
                $id = $_GET['id'];
                $title = htmlspecialchars_decode($_POST['title'], ENT_QUOTES);
                $content = htmlspecialchars_decode($_POST['content'], ENT_QUOTES);
                $postManager = new PostManager();
                $userRightsManager = new UserRightManager();

                if($userRightsManager->can('edit post'))
                {
                    $updatedPost = $postManager->updatePost($id, $title, $content);
                    if($updatedPost === false)
                    {
                        flash_error('Impossible de modifier le post');
                    }
                } else {
                    flash_error('Vous n\'avez pas les droits');
                }
            }
            else
            {
                flash_error('Tous les champs ne sont pas remplis');
            }
        }
        else
        {
            flash_error('Aucun post sélectionné');
        }
        header('Location: index.php');
    }

    function edit()
    {
        if(isset($_GET['id']) && $_GET['id'] > 0) {
            $id = $_GET['id'];
            $postManager = new PostManager();
            $post = $postManager->getPost($id);
        }
        if ($post === false)
        {
            throw new Exception('Impossible d\'afficher le post');
        }
        else {
            $token = $this->token;
            require('view/backend/editPostView.php');
        }
    }

    // SUPPRIMER Post
    function delete()
    {
        if(isset($_GET['id']) && $_GET['id'] > 0) {

            $id = $_GET['id'];
            $postManager = new PostManager();
            $userRightsManager = new UserRightManager();

            $deletePost = $postManager->deletePost($id);
        }
        if($deletePost === false)
        {
            flash_error('Impossible de supprimer le post');
        } header('Location: index.php');
    }
}
