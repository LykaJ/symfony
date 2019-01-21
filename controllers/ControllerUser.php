<?php
require_once('models/UserManager.php');
require_once('models/UserRightManager.php');
//users
//INSCRIPTION User
function newUser()
{
    if(!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email']))
    {
        $pseudo = htmlspecialchars_decode($_POST['pseudo'], ENT_QUOTES);
        $password = htmlspecialchars_decode($_POST['password'], ENT_QUOTES);
        $password2 = htmlspecialchars_decode($_POST['password2'], ENT_QUOTES);
        $email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
        $hash = hash('sha256', $password);
        $userManager = new UserManager();
        if($password !== $password2)
        {
            flash_error('Les mots de passe ne correspondent pas');
            header('Location: index.php?action=signupForm');
        }
        else if(!empty($userManager->getUser($pseudo)))
        {
            flash_error('Ce pseudo est déjà utilisé :(');
            header('Location: index.php?action=signupForm');
        }
        else
        {
            $newUser = $userManager->addUser($pseudo, $hash, $email);
            flash_success('Bienvenue ' . $pseudo . ' !');
            header('Location: index.php');
        }
    }
    else
    {
        flash_error('Tous les champs ne sont pas remplis');
        header('Location: index.php?action=signupForm');
    }
}

function signupForm()
{
    require_once('view/frontend/signupView.php');
}

function login()
{
    if(!empty($_POST['pseudo']) && !empty($_POST['password']))
    {
        sleep(1);
        $pseudo = htmlspecialchars_decode($_POST['pseudo'], ENT_QUOTES);
        $passform = htmlspecialchars_decode($_POST['password'], ENT_QUOTES);
        $passform = hash('sha256', $passform);
        $userManager = new UserManager();
        $user = $userManager->getUser($pseudo);
        $password = $user['password'];

        if($passform === $password)
        {
            $_SESSION['current_user'] = $user;
            header('Location: index.php');
        }
        else
        {
            flash_error('Mauvais identifiants');
            header('Location: index.php?action=loginForm');
        }
    }
}

function loginForm()
{
    require_once('view/frontend/connexionView.php');
}

function logout()
{
    unset($_SESSION['current_user']);
    unset($_SESSION['expires_at']);
    header('Location: index.php');
}

function validateUser()
{
    $userManager = new UserManager();

    if(isset($_GET['id']) && $_GET['id'] > 0)
    {
        $id = $_GET['id'];
    }


        /*    $id = $_GET['id'];
            $userManager = new UserManager();

            $newProfile = $userManager->profileUser($id);
            var_dump($newProfile);

            if(isset($_GET['url']) && $_GET['url'] > 0)
            {
                $url = $_GET['url'];

                if($url === 1)
                {
                    $profileId = 1;
                    var_dump($profileId);
                    $newProfile = $userManager->profileUser($id, $profileId);

                } else {
                    flash_error('Impossible de valider cet utilisateur');
                }
            }

            if($newProfile === false)
            {
                flash_error('Impossible de modifier le profil');

            } else {
                flash_success('Cet utilisateur est maintenant ' . $newProfile['profile_id']);
                header('Location: index.php?action=newMemberForm');
            } */

    }



//Profile User
function newMemberForm()
{
    require('view/backend/validationView.php');
}


function isSessionExpired()
{
    if (!isset($_SESSION['current_user']))
    {
        return false;
    }
    if(!isset($_SESSION['expires_at']))
    {
        $_SESSION['expires_at'] = time() + 1800;
        return false;
    }
    if($_SESSION['expires_at'] < time())
    {
        return true;
    }
    return false;
}

function sessionTicket()
{
    if (isset($_COOKIE['ct-s']) === isset($_SESSION['ct-s']))
    {
        // C'est reparti pour un tour
        $ticket = session_id().microtime().rand(0,9999999999);
        $ticket = hash('sha512', $ticket);
        $_COOKIE['ct-s'] = $ticket;
        $_SESSION['ct-s'] = $ticket;
    }
    else
    {
        // On détruit la session
        $_SESSION = [];
        unset($_SESSION);
        header('location:index.php');
    }
}

//DELETE USER
function deleteUser()
{
    if(isset($_GET['id']) && $_GET['id'] > 0)
    {
        $id = $_GET['id'];

        $userRightsManager = new UserRightManager();
        $userManager = new UserManager;

        if(!$userRightsManager->can('delete user'))
        {
            flash_error('Vous n\'avez pas les droits');
            header('Location: index.php');
            return;
        }

        $deleteUser = $userManager->deleteUser($id);

        if($deleteUser === false)
        {
            flash_error('Impossible de supprimer ce user');
        } else {
            header('Location: index.php');
        }
    }
}
