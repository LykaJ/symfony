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

  <div class="container">
    <h1 class="rewrite-bt-banner">Modifier Post</h1>

    <form action="/Blog/posts/update/<?= $post['id']?>" method="post">
        <div>
            <p>Auteur : <?= htmlspecialchars($post['author'])?></p>
        </div>
        <div>
            <label for="title">Titre</label><br />
            <textarea id="title" name="title" class="form-control" rows="3"><?= htmlspecialchars($post['title'])?></textarea>
        </div>
        <div>
            <label for="content">Contenu</label><br />
            <textarea id="content" name="content" class="form-control" rows="3"><?= htmlspecialchars($post['content'])?></textarea>
        </div>
        <div>
            <input class="btn btn-info" type="submit" />
        </div>
    </form>
  </div>

</body>
</html>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
