<?php
namespace Blog\controllers;

use \Blog\models\Input;

class SessionController
{
    public function isSessionExpired()
    {
        $input = new Input();

        $session = $input->session('current_user');
        $sessionExpires = $input->session('expires_at');

        if (!isset($session)) {
            return false;
        }
        if (!isset($sessionExpires)) {
            $_SESSION['expires_at'] = time() + 1800;
            return false;
        }
        if ($sessionExpires < time()) {
            return true;
        }
        return false;
    }

    public function checkSessionTicket()
    {
        $input = new Input();
        $cookie = $input->cookie('ct-s');
        $sessionCTS = $input->session('ct-s');

        if (!isset($cookie)) {
            $this->createTicket();
            return true;
        }

        return $cookie === $sessionCTS;
    }

    public function logout()
    {
        unset($_SESSION['current_user']);
        unset($_SESSION['expires_at']);

        header('Location: /Blog');
    }

    public function resetTicket()
    {
        unset($_SESSION['ct-s']);
        unset($_COOKIE['ct-s']);
        setcookie('ct-s', null, time() - 3600);
        $this->createTicket();
    }

    private function createTicket()
    {
        $ticket = session_id().microtime().rand(0, 9999999999);
        $ticket = hash('sha512', $ticket);

        setcookie('ct-s', $ticket, time() + 1800); // Expire au bout de 30 min
        $_SESSION['ct-s'] = $ticket;
    }
}
