<?php

namespace Blog\controllers;

use \Blog\models\UserManager;
use \Blog\models\UserRightManager;

require_once('controllers/BaseController.php');

//users
//INSCRIPTION User

class UsersController extends BaseController
{
    public function create()
    {
        if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email'])) {
            $pseudo = htmlspecialchars_decode($_POST['pseudo'], ENT_QUOTES);
            $password = htmlspecialchars_decode($_POST['password'], ENT_QUOTES);
            $password2 = htmlspecialchars_decode($_POST['password2'], ENT_QUOTES);
            $email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
            $hash = hash('sha256', $password);
            $userManager = new UserManager();


            if ($password !== $password2) {
                \Blog\flash_error('Les mots de passe ne correspondent pas');
                header('Location: index.php?action=signupForm');
            } elseif (!empty($userManager->getUser($pseudo))) {
                \Blog\flash_error('Ce pseudo est déjà utilisé :(');
                header('Location: index.php?action=signupForm');
            } elseif (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) {
                \Blog\flash_error("L'adresse email n'est pas valide");
                header('Location: index.php?action=signupForm');
            } else {
                $newUser = $userManager->addUser($pseudo, $hash, $email);
                \Blog\flash_success('Bienvenue ' . $pseudo . ' !');
                header('Location: index.php');
            }
        } else {
            \Blog\flash_error('Tous les champs ne sont pas remplis');
            header('Location: index.php?action=signupForm');
        }
    }

    public function new()
    {
        require_once('view/frontend/signupView.php');
    }

    public function login()
    {
        if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {

            $pseudo = htmlspecialchars_decode($_POST['pseudo'], ENT_QUOTES);
            $passform = htmlspecialchars_decode($_POST['password'], ENT_QUOTES);
            $passform = hash('sha256', $passform);
            $userManager = new UserManager();
            $user = $userManager->getUser($pseudo);
            $password = $user['password'];

            if ($passform === $password) {
                $_SESSION['current_user'] = $user;
                header('Location: index.php');
            } else {
                \Blog\flash_error('Mauvais identifiants');
            }
        }
    }

    public function loginForm()
    {
        $token = $this->token;
        require_once('view/frontend/connexionView.php');
    }

    //DELETE USER
    public function delete($id)
    {
        if (isset($id) && $id > 0) {

            $userRightsManager = new UserRightManager();
            $userManager = new UserManager;

            if (!$userRightsManager->can('delete user')) {
                \Blog\flash_error('Vous n\'avez pas les droits');
                header('Location: index.php');
                return;
            }

            $deleteUser = $userManager->deleteUser($id);

            if ($deleteUser === false) {
                \Blog\flash_error('Impossible de supprimer ce user');
            }
        }
    }
}
