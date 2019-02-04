<?php

namespace Blog\controllers;

use \Blog\models\PostManager;
use \Blog\models\UserManager;
use \Blog\models\UserRightManager;
use \Blog\models\Manager;
use \Blog\models\MailClass;

// Chargement des classes

require_once('vendor/autoload.php');
require_once('vendor/swiftmailer/swiftmailer/lib/swift_required.php');
require_once('controllers/BaseController.php');

class HomeController extends BaseController
{
    //private $_view;

    public function index()
    {
        $postsManager = new PostManager;
        $posts = $postsManager->getPosts();
        $userRightsManager = new UserRightManager;
        $userManager = new UserManager;
        require_once('view/frontend/listPostsView.php');

    }

    function contactMail()
    {
        if(isset($_POST['submit']))
        {
        //    $subject = $_POST['subject'];
            $sendto = $_POST['email'];
            $body = $_POST['message'];
        /*    $file = $_FILES["file"];
            $file_name = $file["name"];
            $file_tmp = $file["tmp_name"];
            $file_ext = explode(".", $file_name);
            $file_ext = strtolower(end($file_ext));
            $allowed = array("txt", "pdf", "jpg" , "png" , "xlsx" , "docx");
            $target_dir = null;
        */

            if (!empty($_SESSION['current_user']) && !empty($_POST['email']) && !empty($_POST['message']))
            {
                $author = $_SESSION['current_user']['pseudo'];
                $email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
                $message = htmlspecialchars_decode($_POST['message'], ENT_QUOTES);

    //IF FILE ALLOWED

            /*    if(in_array($file_ext, $allowed))
                {
                    $target_dir = "attachement/" . $file_name;
                    move_uploaded_file($file_tmp,$target_dir);
                } */

                $mailClient = new MailClass();
                $swiftmail = $mailClient->sendMail($sendto, $body); // add $target_dir if file sent

                flash_success('Votre email a été envoyé');
            } else {
                flash_error('Votre email n\'a pas pu être envoyé');
            }

        } header('Location: /Blog');
    }

    function contactForm()
    {
        require_once('view/frontend/contact.php');
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

/*
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
->setTo(['webdesigner.form@gmail.com', 'raulet.alicia@gmail.com' => 'Jane Doe'])
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
*/
