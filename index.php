<?php
session_start();

use \Blog\Autoloader;
use \Blog\Router;

require_once('core/Autoloader.php');
Autoloader::register();

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
$router->get('', '\Blog\controllers\Home#index');
$router->get('posts', '\Blog\controllers\Posts#index');
$router->get('posts/new', '\Blog\controllers\Posts#new');
$router->get('posts/:id', '\Blog\controllers\Posts#show');
$router->get('admin/validation', '\Blog\controllers\Admin#showUnvalidated');
$router->post('posts/create', '\Blog\controllers\Posts#create');
$router->get('validate/post/:id', '\Blog\controllers\Admin#validatePost');
$router->get('posts/edit/:id', '\Blog\controllers\Posts#edit');
$router->post('posts/update/:id', '\Blog\controllers\Posts#update');
$router->get('posts/delete/:id', '\Blog\controllers\Posts#delete');
$router->get('signup', '\Blog\controllers\Users#new');
$router->post('signup', '\Blog\controllers\Users#create');
$router->get('signin', '\Blog\controllers\Users#loginForm');
$router->post('login', '\Blog\controllers\Users#login');
$router->get('logout', '\Blog\controllers\Session#logout');
$router->get('delete/:id', '\Blog\controllers\Users#delete');
$router->get('validate/user/:id/:profileId', '\Blog\controllers\Admin#validateUser');
$router->post('comments/add/:postId', '\Blog\controllers\Comments#add');
$router->get('comments/validate/:id/:postId', '\Blog\controllers\Comments#validate');
$router->get('comments/edit', '\Blog\controllers\Comments#edit');
$router->post('comments/update', '\Blog\controllers\Comments#update');
$router->get('comments/delete/:id/:postId', '\Blog\controllers\Comments#delete');
$router->get('contact', '\Blog\controllers\Home#contactForm');
$router->post('contact', '\Blog\controllers\Home#contactMail');

$router->run();