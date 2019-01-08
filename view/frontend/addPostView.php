<?php $title = 'Ajouter post'; ?>

<?php ob_start(); ?>


<!DOCTYPE html>
<html>
<head>
  <title>Administration</title>
  <meta charset="utf-8" />
</head>

<body>
  <p><a href="index.php">Accéder à l'accueil du site</a></p>

  <div class="container">
    <h2>Ajouter Post</h2>

<!--    <?php
    $success = get_flash('success');
      if (!empty($success)) {
        ?>
        <div class="alert alert-success" role="alert"><?= $success ?></div>
    <?php } ?> -->

    <form action="index.php?action=createPost" method="post">
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
            <textarea id="content" name="content" rows="8" cols="80"></textarea>
        </div>
        <div>
            <input class="btn btn-primary" type="submit" />
    </form>
  </div>
</body>
</html>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
