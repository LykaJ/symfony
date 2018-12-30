<?php
session_start();

require_once('controllers/Router.php');
require_once('controllers/ControllerHome.php');
require_once('functions/Flash.php');

$rooter = new Router();
$rooter->routerReq();

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

        case 'listPosts':
        default:
        listPosts();

    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
