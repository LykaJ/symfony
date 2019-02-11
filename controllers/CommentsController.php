<?php

namespace Blog\controllers;

use \Blog\models\CommentManager;
use \Blog\models\PostManager;
use \Blog\models\UserRightManager;
use \Blog\models\Input;

require_once('controllers/BaseController.php');


//COMMENTS
// AJOUTER UN COMMENTAIRE
class CommentsController extends BaseController
{
    public function add($postId)
    {
        $input = new Input();
        $session = $input->session('current_user');

        if (isset($postId) && $postId > 0) {
            if (!empty($session) && !empty($input->post('comment'))) {

                $author = $session['pseudo'];
                $userId = $session['id'];
                $comment = htmlspecialchars_decode($input->post('comment'), ENT_QUOTES);

                $commentManager = new CommentManager();
                $affectedLines = $commentManager->postComment($postId, $author, $userId, $comment);

                if ($affectedLines === false) {
                    \Blog\flash_error('Impossible d\'ajouter le commentaire !');
                } else {
                    header('Location: /Blog/posts/' . $postId);
                }
            } else {
                \Blog\flash_error('Tous les champs ne sont pas remplis !');
                header('Location: /Blog/posts/' . $postId);
            }
        } else {
            \Blog\flash_error('Aucun identifiant de billet envoyé');
        }
    }


    public function validate($id, $postId)
    {
        $commentManager = new CommentManager();
        $postManager = new PostManager();
        $userRightsManager = new UserRightManager();

        if ($userRightsManager->can('validate')) {
            if (isset($id) && $id > 0) {
                /** @var PostsController $post */
                $postManager->getPost($postId);


               $commentManager->getComment($id);
               $commentManager->updateCommentStatus($id);

            } else {
                \Blog\flash_error("Aucun commentaire à valider");
            }
        } else {
            \Blog\flash_error("Vous n'avez pas les droits");
        }
        header('Location: /Blog/posts/' . $postId);
    }


    public function delete($id, $postId)
    {
        if (isset($id) && $id > 0) {

            $postManager = new CommentManager();
            $userRightsManager = new UserRightManager();

            if ($userRightsManager->can('delete comment')) {
                $deleteComment = $postManager->deleteComment($id);

                if ($deleteComment === false) {
                    \Blog\flash_error('Impossible de supprimer le post');
                }
            } else {
                \Blog\flash_error("Vous n'avez pas les droits");
            }
        }
        header('Location: /Blog/posts/'. $postId);
    }
}
