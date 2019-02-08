<?php
namespace Blog\controllers;


use \Blog\models\PostManager;
use \Blog\models\UserManager;
use \Blog\models\UserRightManager;
use function PHPSTORM_META\elementType;


require_once('vendor/autoload.php');
require_once('vendor/swiftmailer/swiftmailer/lib/swift_required.php');
require_once('controllers/BaseController.php');


class HomeController extends BaseController
{
    public function index()
    {
        $postsManager = new PostManager;
        $posts = $postsManager->getPosts();
        $userRightsManager = new UserRightManager;
        $userManager = new UserManager;
        require_once('view/frontend/listPostsView.php');
    }

    public function contactMail()
    {
        if (isset($_SESSION['current_user']) && !empty($_POST['content']))
        {
            $email = $_SESSION['current_user']['email'];
            $pseudo = $_SESSION['current_user']['pseudo'];
            $content = htmlspecialchars_decode($_POST['content'], ENT_QUOTES);
        } else if (!empty($_POST['email']) && !empty($_POST['content']) && !empty($_POST['pseudo'])) {
            $email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
            $content = htmlspecialchars_decode($_POST['content'], ENT_QUOTES);
            $pseudo = htmlspecialchars_decode($_POST['pseudo'], ENT_QUOTES);
        }
        // Create the Transport
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            ->setUsername('webdesigner.form@gmail.com')
            ->setPassword('OpenClassRooms12');
        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);
        // Create a message
        $message = (new \Swift_Message('Blog - Formulaire Contact'))
            ->setFrom(array($email => $pseudo))
            ->setTo(array("webdesigner.form@gmail.com" => "Jane Doe"))
            ->setBody(
                '<html>' .
                ' <body>' .
                $content .
                ' </body>' .
                '</html>',
                'text/html'
            )
            ->setCharset('utf-8')
            ->setContentType('text/html');
        // Send the message
        //printf("Sent %d messages\n", $numSent);
        if ($mailer->send($message)) {
            \Blog\flash_success('Votre message a été envoyé');
        } else if (!$mailer->send($message, $failures)) {
            \Blog\flash_error('Votre message n\'a pas pu être envoyé');
            print_r($failures);
        }
        header('Location: /Blog/contact');
    }

    public function contactForm()
    {
        require_once('view/frontend/contact.php');
    }
}