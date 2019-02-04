<?php

namespace Blog\controllers;

use \Blog\models\PostManager;
use \Blog\models\UserManager;
use \Blog\models\UserRightManager;

require_once('controllers/BaseController.php');

class AdminController extends BaseController
{
    //VALIDATION VIEW
    function showUnvalidated()
    {
        $userRightsManager = new UserRightManager();
        $postManager = new PostManager();
        $userManager = new UserManager();

        if($userRightsManager->can('validate'))
        {
            $unvalidated_posts = $postManager->getPosts();
            $new_users = $userManager->getNewUsers();

            require('view/backend/validationView.php');

        } else {

            \Blog\flash_error("Vous n'avez pas les droits");

            header('Location: /Blog');
        }
    }

    function validatePost($id)
    {
        $postManager = new PostManager();
        $userRightsManager = new UserRightManager();

        if($userRightsManager->can('validate'))
        {
            if(isset($id) && $id > 0)

            {
                $post = $postManager->getPost($id);
                $newStatus = $postManager->updatePostStatus($id);

            } else {

                \Blog\flash_error("Aucun post à valider");
            }

        } else {

            \Blog\flash_error("Vous n'avez pas les droits");

        } header('Location: /Blog');
    }

    function validateUser($id, $profileId)
    {
        $userManager = new UserManager();
        $userRightsManager = new UserRightManager();

        if(isset($id) && $id > 0)
        {
            //$id = $_GET['id'];

            if ($userRightsManager->can('validate')) {

                if(!empty($profileId))
                {
                    //$profileId = $_GET['profileId'];
                    $newUser = $userManager->profileUser($id, $profileId);

                    \Blog\flash_success("Le profil de l'utilisateur a bien été modifié");

                } else {

                    \Blog\flash_error('Impossible de changer le profile de cet utilisateur');
                }
            } else {
                \Blog\flash_error("Vous n'avez pas les droits");
            }
        } header('Location: /Blog/admin/validation');
    }
}