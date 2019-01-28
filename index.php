<?php
//ini_set('display_errors', 'on');
//namespace Blog;
session_start();

//require_once('controllers/Autoloader.php');
//\Blog\Autoloader::register();

require_once('core/router/Router.php');
require_once('core/functions/Flash.php');

require_once('vendor/autoload.php');

if (isset($_GET['url'])) {
    $url = $_GET['url'];
} else {
    $url = "";
}

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
