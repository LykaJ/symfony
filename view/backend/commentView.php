<?php $title = 'Modifier un commentaire' ?>

<?php ob_start(); ?>
<h1>Mon blog !</h1>
<p><a href="index.php?action=showPost&amp;id=<?= $comment['post_id'] ?>">Retour au billet</a></p>

<div class="container">
    <h2>Modifier un commentaire</h2>

    <form action="index.php?action=updateComment&amp;id=<?= $comment['id'] ?>&amp;postId=<?= $comment['post_id'] ?>" method="post">
        <div>
            <p>Auteur : <?= htmlspecialchars($comment['author'])?></p>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment" class="form-control" rows="3"><?= htmlspecialchars($comment['comment']) ?></textarea>
        </div>
            <input class="btn btn-primary" type="submit"/>
    </form>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
