<?php $title = 'Ajouter post'; ?>

<?php ob_start(); ?>


<!DOCTYPE html>
<html>
<head>
  <title>Administration</title>
  <meta charset="utf-8" />

</style>
</head>

<body>
  <p><a href="../../index.php">Accéder à l'accueil du site</a></p>

  <div class="news">
    <h2>Ajouter Post</h2>

    <form action="index.php?action=addPost&amp;id=<?= $newPost['id'] ?>" method="post">
        <div>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" />
        </div>
        <div>
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="title" />
        </div>
        <div>
            <label for="content">Contenu</label><br />
            <textarea id="content" name="content"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>

    <?php
    while ($newPost = $newPosts->fetch())
    {
    ?>
        <p><strong><?= htmlspecialchars($newPost['author']) ?></strong> titre : <strong><?= htmlspecialchars($newPost['title']) ?></strong><a href="index.php?action=updatePost&amp;id=<?= $post['id']?>"> (modifier)</a></p>
        <p><?= nl2br(htmlspecialchars($newPost['content'])) ?></p>
    <?php
    }
    ?>
  </div>
</body>
</html>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
