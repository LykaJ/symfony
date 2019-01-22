<?php
require_once('models/PostManager.php');
require_once('models/UserManager.php');
require_once('models/UserRightManager.php');

//POST
//AFFICHER LA LISTE DES POSTS

function showPost()
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

function listPosts()
{
    $postManager = new PostManager();
    $userRightsManager = new UserRightManager();
    //$pagination = new PaginationManager();

    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');

}

//VALIDATION VIEW
function showUnvalidated()
{
    $userRightsManager = new UserRightManager();
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $userManager = new UserManager();

    if($userRightsManager->can('validate'))
    {
        $unvalidated_posts = $postManager->getPosts();
        $new_users = $userManager->getNewUsers();

        

        require('view/backend/validationView.php');

    } else {
        flash_error("Vous n'avez pas les droits");
        header('Location: index.php');
    }
}

function validatePost()
{
    $postManager = new PostManager();
    $userRightsManager = new UserRightManager();

    if($userRightsManager->can('validate'))
    {
        if(isset($_GET['id']) && $_GET['id'] > 0)

        {
            $id = $_GET['id'];

            $post = $postManager->getPost($id);
            $newStatus = $postManager->updatePostStatus($id);

        } else {

            flash_error("Aucun post à valider");
        }

    } else {
        flash_error("Vous n'avez pas les droits");

    } header('Location: index.php');
}

//POST


// AJOUTER UN POST
function createPost()
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
            header('Location: index.php');
            flash_warning('Le post doit être validé avant d\'apparaître dans la liste');
        }
    }
}

function newPost()
{
    $userRightsManager = new UserRightManager();
    if(!$userRightsManager->can('add post'))
    {
        flash_error('Vous n\'avez pas les droits');
        header('Location: index.php');
        return;
    }
    require_once('view/backend/addPostView.php');
}


// METTRE A JOUR UN POST
function updatePost()
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

function editPost()
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
        require('view/backend/editPostView.php');
    }
}

// SUPPRIMER Post
function deletePost()
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
