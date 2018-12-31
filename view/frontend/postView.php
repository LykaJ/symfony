<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<div class="container">
    <h2>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date'] ?></em>
        <?php  if($userRightsManager->can('edit post') && $userRightsManager->can('delete post')) { ?>
            <div class="container">
                <a role="button" class="btn btn-outline-primary" href="index.php?action=editPost&amp;id=<?= $post['id']?>"> Modifier</a> <a role="button" class="btn btn-outline-primary" href="index.php?action=deletePost&amp;id=<?= $post['id']?>"> Supprimer</a>
            </div>
        <?php } ?>

    </h2>
    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?><br/>
        <strong>Auteur :  <?= nl2br(htmlspecialchars($post['author'])) ?></strong>
    </p>


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
            <input class="btn btn-primary" type="submit"  />
        </div>
    </form>

    <?php
    while ($comment = $comments->fetch())
    {
        ?>
        <div>
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <p><a role="button" class="btn btn-outline-primary" href="index.php?action=editComment&amp;id=<?= $comment['id']?>&amp;postId=<?= $post['id'] ?>"> Modifier</a></p>
        </div>
        <?php
    }
    ?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
