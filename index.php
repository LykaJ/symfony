<?php
ini_set('display_errors', 'on');
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
$router->get('', 'Home#index');
$router->get('posts', 'Posts#index');
$router->get('posts/new', 'Posts#new');
$router->get('posts/:id', 'Posts#show');
$router->get('admin/validation', 'Admin#showUnvalidated');

$router->post('posts/create', 'Posts#create');

$router->get('validate/post/:id', 'Admin#validatePost');

$router->get('posts/edit/:id', 'Posts#edit');
$router->post('posts/update/:id', 'Posts#update');
$router->get('posts/delete/:id', 'Posts#delete');

$router->get('signup', 'Users#new');
$router->post('signup', 'Users#create');
$router->get('signin', 'Users#loginForm');
$router->post('login', 'Users#login');
$router->get('logout', 'Session#logout');

$router->get('delete/:id', 'Users#delete');

$router->get('validate/user/:id/:profileId', 'Admin#validateUser');

$router->post('comments/add/:postId', 'Comments#add');
$router->get('comments/validate/:id/:postId', 'Comments#validate');
$router->get('comments/edit', 'Comments#edit');
$router->post('comments/update', 'Comments#update');
$router->get('comments/delete/:id/:postId', 'Comments#delete');

$router->get('contact', 'Home#contactForm');
$router->post('contact/sent', 'Home#contactMail');

$router->run();
