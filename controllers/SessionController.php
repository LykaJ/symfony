<?php
namespace Blog\controllers;

class SessionController
{
    public function isSessionExpired()
    {
        if (!isset($_SESSION['current_user'])) {
            return false;
        }
        if (!isset($_SESSION['expires_at'])) {
            $_SESSION['expires_at'] = time() + 1800;
            return false;
        }
        if ($_SESSION['expires_at'] < time()) {
            return true;
        }
        return false;
    }

    public function checkSessionTicket()
    {
        if (!isset($_COOKIE['ct-s'])) {
            $this->createTicket();
            return true;
        }

        return $_COOKIE['ct-s'] === $_SESSION['ct-s'];
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
