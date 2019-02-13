<?php $title = 'Modifier post'; ?>

<?php ob_start(); ?>


  <div class="container">
    <h1 class="rewrite-bt-banner">Modifier Post</h1>

    <form action="/Blog/posts/update/<?= $post['id']?>" method="post">
        <div class="form-group">

            <p>Auteur : <?= \Blog\esc($post['author'])?></p>
        </div>
        <div class="form-group">
            <label for="title">Titre</label><br />
            <textarea id="title" name="title" class="form-control" rows="3"><?= \Blog\esc($post['title'])?></textarea>
        </div>
        <div class="form-group">
            <label for="content">Contenu</label><br />
            <textarea id="content" name="content" class="form-control" rows="3"><?= \Blog\esc($post['content'])?></textarea>

        </div>
        <div class="bt-alert">
            <input class="btn btn-info" type="submit" />
        </div>
    </form>
  </div>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
