<?php
/*
namespace Blog\models;

require_once('vendor/swiftmailer/swiftmailer/lib/swift_required.php');

class MailClass
{

    public function sendMail() // add $targetpath = null if files to be sent
    {
        $sendto = $_POST('email');
        $body = $_POST('message');

        try {
            $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 'ssl', 587);
            $transport->setUsername('webdesigner.form@gmail.com');
            $transport->setPassword('OpenClassRooms12');

            $message = \Swift_Message::newInstance();
            $message->setTo($sendto);
            $message->setSubject('Fomulaire de contact');
            $message->setBody($body);
            $message->setFrom(array("webdesigner.form@gmail.com" => "Jane Doe"));

            $message->setCharset('utf-8');
            $message->setContentType('text/html');
            $message->setBody($this->renderView('view/frontend/contact.php'));

            /*  if (!empty($_SESSION['current_user']) && !empty($_POST['email']) && !empty($_POST['content']))
           {
               $author = $_SESSION['current_user']['pseudo'];
               $email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
               $content = htmlspecialchars_decode($_POST['content'], ENT_QUOTES);

               //IF FILE ALLOWED

                if(in_array($file_ext, $allowed))
                   {
                       $target_dir = "attachement/" . $file_name;
                       move_uploaded_file($file_tmp,$target_dir);
                   } */

                $mailer = \Swift_Mailer::newInstance($transport);
                $result = $mailer->send($message);

                if ($result) {
                    \Blog\flash_success('Votre email a été envoyé');
                } else {
                    \Blog\flash_error('Votre email n\'a pas pu être envoyé');
                }
           /* } */

        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();

        }
    }
}
*/