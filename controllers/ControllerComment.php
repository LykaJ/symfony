<?php

require_once('models/CommentManager.php');
require_once('models/UserManager.php');
require_once('models/UserRightManager.php');


//COMMENTS
// AJOUTER UN COMMENTAIRE
function addComment()
{
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        if (!empty($_SESSION['current_user']) && !empty($_POST['comment'])) {
            $postId = $_GET['id'];
            $author = $_SESSION['current_user']['pseudo'];
            $userId = $_SESSION['current_user']['id'];
            $comment = htmlspecialchars_decode($_POST['comment'], ENT_QUOTES);

            $commentManager = new CommentManager();
            $affectedLines = $commentManager->postComment($postId, $author, $userId, $comment);

            if ($affectedLines === false) {
                throw new Exception('Impossible d\'ajouter le commentaire !');
            }
            else {
                header('Location: index.php?action=showPost&id=' . $postId);
            }
        } else {
            throw new Exception('Tous les champs ne sont pas remplis !');
        }
    } else {
        throw new Exception('Aucun identifiant de billet envoyé');
    }
}

// MODIFIER UN COMMENTAIRE
function updateComment()
{
    $userRightsManager = new UserRightManager();
    if(!$userRightsManager->can('edit comment'))
    {
        flash_error('Vous n\'avez pas les droits');
        header('Location: index.php');
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
                header('Location: index.php?action=editComment&id=' . $id);
            }
        } else {
            flash_error('Tous les champs ne sont pas remplis');
        }
    }
    else {
        throw new Exception('Aucun identifiant de billet envoyé');
    }
}

function validateComment()
{
    $commentManager = new CommentManager();
    $postManager = new PostManager();
    $userRightsManager = new UserRightManager();

    if($userRightsManager->can('validate'))
    {
        if(isset($_GET['id']) && $_GET['id'] > 0)
        {
            $post = $postManager->getPost($id);
            $id = $_GET['id'];

            $comment = $commentManager->getComment($id);
            $newStatus = $commentManager->updateCommentStatus($id);

        } else {

            flash_error("Aucun commentaire à valider");
        }

    } else {
        flash_error("Vous n'avez pas les droits");

    } header('Location: index.php');
}

// RECUPERER INFOS COMMENTAIRE ET POST
function editComment()
{
    if(isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        $comment = $commentManager->getComment($id);
        if(!empty($_SESSION['current_user']) && $comment['user_id'] === $_SESSION['current_user']['id'])
        {
            require('view/backend/commentView.php');
        } else {
            flash_error('Nope');
        }
    }
}
