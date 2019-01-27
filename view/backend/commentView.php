<?php $title = 'Modifier un commentaire' ?>

<?php ob_start(); ?>

<div class="container">
    <p><a href="index.php?action=showPost&amp;id=<?= $comment['post_id'] ?>">Retour au billet</a></p>

    <h2 class="rewrite-bt-banner">Modifier un commentaire</h2>

    <form action="index.php?action=updateComment&amp;id=<?= $comment['id'] ?>&amp;postId=<?= $comment['post_id'] ?>" method="post">
        <div class="form-group">
            <p>Auteur : <?= htmlspecialchars($comment['author'])?></p>
            <label for="comment">Commentaire</label><br />
            <textarea class="form-control" id="comment" name="comment"><?= htmlspecialchars($comment['comment']) ?></textarea>
        </div>
            <input class="btn btn-info" type="submit"/>
            <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
    </form>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
