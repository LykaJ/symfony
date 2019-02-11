<?php
namespace Blog\controllers;

use \Blog\models\Input;

require_once('controllers/SessionController.php');


class BaseController
{
    protected $token;

    public function __construct()
    {
        $sessionManager = new SessionController;
        $input = new Input;
        $session = $input->session('token');

        if ($sessionManager->isSessionExpired()) {
            $sessionManager->logout();
            \Blog\flash_error('Session expirée');
            header('Location: /Blog/signin');
            die();
        }

        if (!$sessionManager->checkSessionTicket()) {
            $sessionManager->resetTicket();
            \Blog\flash_error('La session n\'est pas reconnue');
            header('Location: /Blog');
            die();
        }

        $bytes = random_bytes(5);
        $this->token = bin2hex($bytes);
        $session = $this->token;
    }
}
