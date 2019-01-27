<?php
//ini_set('display_errors', 'on');
//namespace Blog;
session_start();

<<<<<<< HEAD
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
=======
//require_once('controllers/Autoloader.php');
//\Blog\Autoloader::register();

require_once('core/router/Router.php');
require_once('core/functions/Flash.php');
>>>>>>> views

require_once('vendor/autoload.php');

<<<<<<< HEAD
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

        case 'listUnvalidatedPosts':
        listUnvalidatedPosts();
        break;

        case 'validatePost':
        validatePost();
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
=======
if (isset($_GET['url'])) {
    $url = $_GET['url'];
} else {
    $url = "";
}
>>>>>>> views

$router = new Router($url);

//$router->get('/', 'Home');
$router->get('', 'HomeController#index');
$router->get('posts/:id', 'PostsController#show');
$router->get('posts', 'PostsController#list');
$router->get('posts', 'PostsController#new');
$router->get('admin/validation', 'AdminController#showUnvalidated');

$router->post('posts/create', 'PostsController#create');
$router->post('posts/validate', 'PostsController#validate');
$router->post('posts/edit', 'PostsController#update');
$router->post('posts/delete', 'PostsController#delete');

$router->get('signup', 'UsersController#new');
$router->post('signup', 'UsersController#create');
$router->get('signin', 'UsersController#loginForm');
$router->post('login', 'UsersController#login');
$router->get('logout', 'SessionManager#logout');

$router->run();
