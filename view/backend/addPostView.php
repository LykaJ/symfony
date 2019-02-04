<?php $title = 'Ajouter post'; ?>

<?php ob_start(); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Administration</title>
  <meta charset="utf-8" />
</head>

<body>
 <!-- <p><a href="index.php">Accéder à l'accueil du site</a></p> -->

  <div class="container">
    <h1 class="rewrite-bt-banner">Ajouter Post</h1>

  <?php
    $success = \Blog\get_flash('success');
      if (!empty($success)) {
        ?>
        <div class="alert alert-success" role="alert"><?= $success ?></div>
    <?php }


      $error = \Blog\get_flash('error');
        if (!empty($error)) {
          ?>
          <div class="alert alert-danger" role="alert"><?= $error ?></div>
      <?php } ?>

    <form action="/Blog/posts/create" method="post">
        <?php if(isset($_SESSION['current_user'])) { ?>
        <div>
            <label for="author">Auteur : <strong><?php echo $_SESSION['current_user']['pseudo']; ?></strong> </label><br />
        </div>
        <?php } ?>
        <div>
            <label for="title">Titre</label><br />
            <input type="text" name="title" />
        </div>
        <div>
            <label for="content">Contenu</label><br />
            <textarea id="content" name="content" class="form-control" rows="3"></textarea>
        </div>

        <div class="bt-alert">
            <input class="btn btn-info" type="submit" />
            </div>
    </form>


</div>
</body>
</html>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
