<?php
session_start();

require_once('controllers/Router.php');
require_once('controllers/ControllerHome.php');
//require_once('controllers/ControllerPost.php');
//require_once('controllers/ControllerComment.php');
//require_once('controllers/ControllerUser.php');
require_once('functions/Flash.php');

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

$router = new Router();
$router->routerReq();

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

        case 'newUser':
        newUser();
        break;

        case 'signupForm':
        signupForm();
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
