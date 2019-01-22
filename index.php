<?php
session_start();

require_once('controllers/Router.php');
require_once('controllers/ControllerHome.php');
require_once('controllers/ControllerPost.php');
require_once('controllers/ControllerComment.php');
require_once('controllers/ControllerUser.php');
require_once('functions/Flash.php');
require_once('vendor/autoload.php');

if (isSessionExpired())
{
    flash_error('Session expirée');
    logout();
    die();
}
if(sessionTicket())
{
    unset($_SESSION);
    header('location:index.php');
    flash_error('La session n\'est pas reconnue');
    die();
}

$route = new Router;
$route->add('', 'ControllerHome');
$route->add('', 'ControllerPost');
$route->add('', 'ControllerComment');
$route->add('', 'ControllerUser');

$route->submit();

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

        case 'createPost':
        createPost();
        break;

        case 'newPost':
        newPost();
        break;

        case 'editPost':
        editPost();
        break;

        case 'updatePost':
        updatePost();
        break;

        case 'deletePost':
        deletePost();
        break;

        case 'showUnvalidated':
        showUnvalidated();
        break;

        case 'validatePost':
        validatePost();
        break;

        case 'validateComment':
        validateComment();
        break;

        case 'deleteComment':
        deleteComment();
        break;

        case 'newUser':
        newUser();
        break;

        case 'deleteUser':
        deleteUser();
        break;

        case 'newMemberForm':
        newMemberForm();
        break;

        case 'signupForm':
        signupForm();
        break;

        case 'validateUser':
        validateUser();
        break;

        case 'login':
        login();
        break;

        case 'loginForm':
        loginForm();
        break;

        case 'logout':
        logout();
        break;

        case 'contactForm':
        contactForm();
        break;

        case 'countArticles':
        countArticles();
        break;

        case 'pageTotal':
        pageTotal();
        break;

        case 'listPosts':
        default:
        listPosts();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
