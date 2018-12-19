<?php $title = 'Modifier post'; ?>

<?php ob_start(); ?>


<!DOCTYPE html>
<html>
<head>
  <title>Administration</title>
  <meta charset="utf-8" />

</style>
</head>

<body>
  <p><a href="index.php">Accéder à l'accueil du site</a></p>

  <div class="news">
    <h2>Modifier Post</h2>

    <form action="index.php?action=updatePost&amp;id=<?= $post['id']?>" method="post">
        <div>
            <p>Auteur : <?= htmlspecialchars($post['author'])?></p>
        </div>
        <div>
            <label for="title">Titre</label><br />
            <textarea id="title" name="title" rows="2" cols="80"><?= htmlspecialchars($post['title'])?></textarea>
        </div>
        <div>
            <label for="content">Contenu</label><br />
            <textarea id="content" name="content" rows="8" cols="80"><?= htmlspecialchars($post['content'])?></textarea>
        </div>
        <div>
            <input type="submit" />
    </form>
  </div>
</body>
</html>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
