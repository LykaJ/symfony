<?php
//namespace OpenClassrooms\Blog;
// Chargement des classes
require_once('models/PostManager.php');
require_once('models/UserManager.php');
require_once('models/UserRightManager.php');
require_once('models/Manager.php');
require_once('vendor/autoload.php');


/*
use \OpenClassrooms\Blog\Model\PostManager;
use \OpenClassrooms\Blog\Model\CommentManager;
use \OpenClassrooms\Blog\Model\UserRightManager;
use \OpenClassrooms\Blog\Model\PaginationManager;
*/


//CREATION CLASSE
class ControllerHome
{
    private $_postManager;
    private $url;
    //private $_view;

    public function __construct($url)
    {
        $this->url = $url;

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
        require_once('view/frontend/listPostsView.php');
        require_once('view/backend/validationView.php');
    }
}




//Pagination
/*
function paginate()
{
if(isset($_GET['page']) && isset($_GET['per_page']))
{
$page = $_GET['page'] ? (int)$_GET['page'] : 1;
$perPage = $_GET['per_page'] <= 50 ? (int)$_GET['per_page'] : 5;
$pagination = new PaginationManager();
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
$totalPages = $pagination->countArticles($totalPages);
var_dump($totalPages);
if(!empty($page) && !empty($perPage))
{
$totalPosts = $pagination->pageTotal();
$pages = ceil($totalPosts/$perPage);
} */


//CONTACT

function contactMail()
{
    if (!empty($_SESSION['current_user']) && !empty($_POST['email']) && !empty($_POST['message']))
    {
        $author = $_SESSION['current_user']['pseudo'];
        $email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
        $message = htmlspecialchars_decode($_POST['message'], ENT_QUOTES);

        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
        ->setUsername('webdesigner.form@gmail.com')
        ->setPassword('OpenClassRooms12')
        ;

        var_dump($transport);

        if(!empty($transport)) {
            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);
            // Create a message
            $message = (new Swift_Message($message))
            ->setFrom([$email => $author])
            ->setTo(['webdesigner.form@gmail.com', 'other@domain.org' => 'Jane Doe'])
            ->setBody('Here is the message itself')
            ;
            // Send the message
            $result = $mailer->send($message);

            flash_success('Le mail est envoyé');

        } else {
            flash_error('Tous les champs ne sont pas remplis');
        }
    }

}

function contactForm()
{
    require_once('view/frontend/contact.php');
}
