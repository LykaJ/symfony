<?php

require_once('controllers/SessionController.php');

class BaseController
{

    protected $token;

    function __construct()
    {
        $sessionManager = new SessionController;

        if ($sessionManager->isSessionExpired())
        {
            $sessionManager->logout();
            flash_error('Session expirée');
            header('Location: /Blog/signin');
            die();
        }

        if(!$sessionManager->checkSessionTicket())
        {
            $sessionManager->resetTicket();
            flash_error('La session n\'est pas reconnue');
            header('Location: /Blog');
            die();
        }

        $bytes = random_bytes(5);
        $this->token = bin2hex($bytes);
        $_SESSION['token'] = $this->token;


    }
}
