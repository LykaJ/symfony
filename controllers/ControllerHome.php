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
        $posts = $this->_postManager->getPosts();

        require_once('view/frontend/listPosts.php');
    }
}

//POST
//AFFICHER LA LISTE DES POSTS

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

// AJOUTER UN POST

function createPost()
{
    require_once('view/frontend/addPostView.php');

    if (!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['content']))
    {
        $author = htmlspecialchars($_POST['author']);
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $postManager = new PostManager();

        $newPostLines = $postManager->postPost($author, $title, $content);

        if ($newPostLines === false) {
            throw new Exception('Impossible d\'ajouter le post !');
        }
    }
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

            $updatedPost = $postManager->updatePost($id, $title, $content);

            if($updatedPost === false)
            {
                throw new Exception('Impossible de modifier le post');
            } else {
                header('Location: index.php?action=editPost&id=' . $id);
            }
        } else {
            throw new Exception('Tous les champs ne sont pas remplis');
        }
    } else {
        throw new Exception('Aucun post sélectionné');
    }
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

        $deletePost = $postManager->deletePost($id);
    }
    if($deletePost === false)
    {
        throw new Exception('Impossible de supprimer le post');
    } else {
        header('Location: index.php');
    }
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

        $post = $postManager->getPost($id);
        $comment = $commentManager->getComment($id);

        require('view/frontend/commentView.php');
    }


//users
//INSCRIPTION User
    function newUser()
    {
        if(!empty($_POST['pseudo']) || !empty($_POST['password']) || !empty($_POST['password2'])) {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = htmlspecialchars($_POST['password']);
            $password2 = htmlspecialchars($_POST['password2']);

            $password = hash('sha256', $password);
            $password2 = hash('sha256', $password2);

            $userManager = new UserManager();

            $user = $userManager->addUser($pseudo, $password);

            if(!empty($password === $password2))
            {
                echo 'Vous êtes connecté(e)';
            } else {
                echo 'Les mots de passe ne correspondent pas';
            }

        } else {
            throw new Exception('Tous les champs ne sont pas remplis');
        }
    }

    function login()
    {
        require_once('view/frontend/connexionView.php');
        
        if(!empty($_POST['pseudo'] || !empty($_POST['password'])))
        {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = htmlspecialchars($_POST['password']);

            $password = hash('sha256', $password);

            $userManager = new UserManager();

            $userLogin = $userManager->getUser($pseudo, $password);
        }
    }

    function deleteUser()
    {

    }

    function verifyPass()
    {
        if(!empty($_POST['password']))
        {
            $passform = htmlspecialchars($_POST['password']);
            $passform = hash('sha256', $passform);

            $userManager = new UserManager();

            $userManager->getUser($password);
        }
        if($passform != $password)
        {
            throw new Exception('Wrong credentials');
        }
        else {
            echo 'New connexion';
        }
    }

}
