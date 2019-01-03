<?php

// Chargement des classes
require_once('models/PostManager.php');
require_once('models/CommentManager.php');
require_once('models/UserManager.php');
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
        $posts = $this->_postManager->getPosts();

        require_once('view/frontend/listPosts.php');
    }
}

//POST
//AFFICHER LA LISTE DES POSTS

function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $userRightsManager = new UserRightManager();
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}


function showPost()
{
    if (isset($_GET['id']) && $_GET['id'] > 0) {

        $id = $_GET['id'];
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        $userRightsManager = new UserRightManager();

        $post = $postManager->getPost($id);
        $comments = $commentManager->getComments($id);

        require('view/frontend/postView.php');
    } else {
        throw new Exception('Aucun identifiant de billet envoyé');
    }
}

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

    if (!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['content']))
    {
        $author = htmlspecialchars($_POST['author']);
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $postManager = new PostManager();

        $newPostLines = $postManager->postPost($author, $title, $content);

        if ($newPostLines === false) {
            throw new Exception('Impossible d\'ajouter le post !');
        } else {
            //    flash_sucess('Le post a bien été ajouté');
            header('Location: index.php');
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
    require_once('view/frontend/addPostView.php');
}

// METTRE A JOUR UN POST

function updatePost()
{
    if(isset($_GET['id']) && $_GET['id'] > 0)
    {
        if (!empty($_POST['title']) && !empty($_POST['content']))
        {
            $id = $_GET['id'];

            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
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
        require('view/frontend/editPostView.php');
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
        throw new Exception('Impossible de supprimer le post');
    } else {
        header('Location: index.php');
    }
}

//Pagination

function pagination()
{
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $perPage = isset($_GET['perPage']) && $_GET['perPage'] <= 50 ? (int) $_GET['perPage'] : 5;

    $paginationManager = new PaginationManager;

    $paginationManager->countPosts($posts);
    $paginationManager->totalPages($total);

    $pages = ceil($total / $perPage);
}

//COMMENTS
// AJOUTER UN COMMENTAIRE
function addComment()
{
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        if (!empty($_POST['author']) && !empty($_POST['comment'])) {

            $postId = $_GET['id'];
            $author = htmlspecialchars($_POST['author']);
            $comment = $_POST['comment'];
            $commentManager = new CommentManager();

            $affectedLines = $commentManager->postComment($postId, $author, $comment);

            if ($affectedLines === false) {
                throw new Exception('Impossible d\'ajouter le commentaire !');
            }
            else {
                header('Location: index.php?action=showPost&id=' . $postId);
            }
        } else {
            throw new Exception('Tous les champs ne sont pas remplis !');
        }
    } else {
        throw new Exception('Aucun identifiant de billet envoyé');
    }
}

// MODIFIER UN COMMENTAIRE
function updateComment()
{
    $userRightsManager = new UserRightManager();

    if(!$userRightsManager->can('edit comment'))
    {
        flash_error('Vous n\'avez pas les droits');
        header('Location: index.php');
        return;
    }

    if (isset($_GET['id']) && $_GET['id'] > 0) {
        if (!empty($_POST['comment'])) {

            $id = $_GET['id'];
            $comment = htmlspecialchars($_POST['comment']);

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



// RECUPERER INFOS COMMENTAIRE ET POST
function editComment()
{
    if(isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];

        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $comment = $commentManager->getComment($id);

        require('view/frontend/commentView.php');
    }
}


//users
//INSCRIPTION User
function newUser()
{
    if(!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email']))
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);
        $email = htmlspecialchars($_POST['email']);
        $hash = hash('sha256', $password);

        $userManager = new UserManager();

        if($password !== $password2)
        {
            flash_error('Les mots de passe ne correspondent pas');
            header('Location: index.php?action=signupForm');
        }
        else if(!empty($userManager->getUser($pseudo)))
        {
            flash_error('Ce pseudo est déjà utilisé :(');
            header('Location: index.php?action=signupForm');
        }
        else
        {
            $newUser = $userManager->addUser($pseudo, $hash, $email);
            flash_sucess('Bienvenue ' . $pseudo . ' !');
            header('Location: index.php');
        }
    }
    else
    {
        flash_error('Tous les champs ne sont pas remplis');
        header('Location: index.php?action=signupForm');
    }
}

function signupForm()
{
    require_once('view/frontend/signupView.php');
}

function login()
{
    if(!empty($_POST['pseudo']) && !empty($_POST['password']))
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $passform = htmlspecialchars($_POST['password']);

        $passform = hash('sha256', $passform);

        $userManager = new UserManager();

        $user = $userManager->getUser($pseudo);
        $password = $user['password'];

        if($passform === $password)
        {
            $_SESSION['current_user'] = $user;
            header('Location: index.php');
        }
        else
        {
            throw new Exception('Mauvais identifiants');
            header('Location: index.php?action=loginForm');
        }
    }
}

function loginForm()
{
    require_once('view/frontend/connexionView.php');
}

function logout()
{
    unset($_SESSION['current_user']);
    header('Location: index.php');
}

/*
function deleteUser()
{
    $userRightsManager = new UserRightManager();

    if(!$userRightsManager->can('delete user'))
    {
        flash_error('Vous n\'avez pas les droits');
        header('Location: index.php');
        return;
    }
} */
