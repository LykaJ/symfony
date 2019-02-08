<?php
namespace Blog\models;

class MailClass
{
    public function sendMail($sendto, $body) // add $targetpath = null if files to be sent
    {
        try {
            $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 'tls', 587);
            $transport->setUsername('webdesigner.form@gmail.com');
            $transport->setPassword('OpenClassRooms12');

            $message = Swift_Message::newInstance();
            $message->setTo($sendto);
            // $message->setSubject($subject);
            $message->setBody($body);
            $message->setFrom("webdesigner.form@gmail.com", "Jane Doe");

            //CONDITION TO SEND FILES

            /*    if(!empty($targetpath))
                {
                    $message->attach(Swift_Attachment::fromPath($targetpath));
                } */

            $mailer = Swift_Mailer::newInstance($transport);
            $result = $mailer->send($message);

            if ($result) {
                echo "Number of emails sent: $result";
            } else {
                echo "Couldn't send email";
            }
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}
