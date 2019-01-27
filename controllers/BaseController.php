<?php

require_once('models/SessionManager.php');

class BaseController
{

    protected $token;

    function __construct()
    {
        $sessionManager = new SessionManager;

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

        $this->token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        $_SESSION['token'] = $this->token;


    }
}
