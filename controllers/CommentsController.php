<?php

//namespace Blog;

require_once('models/CommentManager.php');
require_once('models/UserManager.php');
require_once('models/UserRightManager.php');
require_once('controllers/BaseController.php');


//COMMENTS
// AJOUTER UN COMMENTAIRE
class CommentsController extends BaseController
{
    function add($postId)
    {
        if (isset($postId) && $postId > 0) {
            if (!empty($_SESSION['current_user']) && !empty($_POST['comment'])) {

                //$postId = $_GET['id'];
                $author = $_SESSION['current_user']['pseudo'];
                $userId = $_SESSION['current_user']['id'];
                $comment = htmlspecialchars_decode($_POST['comment'], ENT_QUOTES);

                $commentManager = new CommentManager();
                $affectedLines = $commentManager->postComment($postId, $author, $userId, $comment);

                if ($affectedLines === false) {
                    throw new Exception('Impossible d\'ajouter le commentaire !');
                }
                else {
                    header('Location: /Blog/posts/' . $postId);
                }
            } else {
                flash_error('Tous les champs ne sont pas remplis !');
                header('Location: /Blog/posts/' . $postId);
            }
        } else {
            flash_error('Aucun identifiant de billet envoyé');
        }
    }

    // MODIFIER UN COMMENTAIRE
    function update()
    {
        $userRightsManager = new UserRightManager();
        if(!$userRightsManager->can('edit comment'))
        {
            flash_error('Vous n\'avez pas les droits');
            header('Location: /Blog');
            return;
        }
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['comment'])) {
                $id = $_GET['id'];
                $comment = htmlspecialchars_decode($_POST['comment'], ENT_QUOTES);
                $commentManager = new CommentManager();
                $newComment = $commentManager->updateComment($id, $comment);
                if ($newComment == false) {
                    throw new Exception("Impossible d\'editer le commentaire !");
                }
                else {
                    $this->token = $token;
                    header('Location: index.php?action=editComment&id=' . $id);
                }
            } else {
                flash_error('Tous les champs ne sont pas remplis');
            }
        }
        else {
            flash_error('Aucun identifiant de billet envoyé');
        }
    }

    function validate($id, $postId)
    {
        $commentManager = new CommentManager();
        $postManager = new PostManager();
        $userRightsManager = new UserRightManager();

        if($userRightsManager->can('validate'))
        {
            if(isset($id) && $id > 0)
            {
                $post = $postManager->getPost($id);

                $comment = $commentManager->getComment($id);
                $newStatus = $commentManager->updateCommentStatus($id);


            } else {

                flash_error("Aucun commentaire à valider");
            }

        } else {
            flash_error("Vous n'avez pas les droits");

        } header('Location: /Blog/posts/' . $postId);
    }

    // RECUPERER INFOS COMMENTAIRE ET POST
    function edit()
    {
        if(isset($_GET['id']) && $_GET['id'] > 0) {

            $id = $_GET['id'];
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $comment = $commentManager->getComment($id);
            if(!empty($_SESSION['current_user']) && $comment['user_id'] === $_SESSION['current_user']['id'])
            {
                $token = $this->token;
                require('view/backend/commentView.php');

            } else {
                flash_error('Nope');
            }
        }
    }

    function delete($id, $postId)
    {
        if(isset($id) && $id > 0) {

            //$id = $_GET['id'];
            $postManager = new CommentManager();
            $userRightsManager = new UserRightManager();

            if($userRightsManager->can('delete comment'))
            {
                $deleteComment = $postManager->deleteComment($id);

                if($deleteComment === false)
                {
                    flash_error('Impossible de supprimer le post');
                }
            } else {
                flash_error("Vous n'avez pas les droits");

            }
        } header('Location: /Blog/posts/'. $postId);

    }
}
