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

    <section class="container">
        <h2>Modifier Post</h2>

        <form action="index.php?action=updatePost&amp;id=<?= $post['id']?>" method="post">
            <div>
                <p>Auteur : <?= htmlspecialchars($post['author'])?></p>
            </div>
            <div class="form-group">
                <label for="title">Titre</label><br />
                <input class="form-control" id="title" name="title" value="<?= htmlspecialchars($post['title'])?>"/>
            </div>
            <div class="form-group">
                <label for="content">Contenu</label><br />
                <textarea class="form-control" id="content" name="content" rows="8"><?= htmlspecialchars($post['content'])?></textarea>
            </div>
            <div>
                <input class="btn btn-primary" type="submit" />
            </form>
        </div>
    </section>
</body>
</html>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
