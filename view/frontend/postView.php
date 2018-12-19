<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date'] ?></em>
        <p><a href="index.php?action=editPost&amp;id=<?= $post['id']?>"> (modifier)</a> <a href="index.php?action=deletePost&amp;id=<?= $post['id']?>"> (supprimer)</a></p>
    </h3>

    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?><br/>
        <strong>Auteur :  <?= nl2br(htmlspecialchars($post['author'])) ?></strong>
    </p>
</div>

<h2>Commentaires</h2>

<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date'] ?><a href="index.php?action=editComment&amp;id=<?= $comment['id']?>&amp;postId=<?= $post['id'] ?>"> (modifier)</a></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
