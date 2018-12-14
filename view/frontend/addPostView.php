<?php $title = 'Mes posts'; ?>

<?php ob_start(); ?>


<!DOCTYPE html>
<html>
<head>
  <title>Administration</title>
  <meta charset="utf-8" />

  <style type="text/css">
  table, td {
    border: 1px solid black;
  }

  table {
    margin:auto;
    text-align: center;
    border-collapse: collapse;
  }

  td {
    padding: 3px;
  }
  </style>
</head>

<body>
  <p><a href="../../index.php">Accéder à l'accueil du site</a></p>

  <form action="index.php?action=editPost&amp;id=<?= $post['id'] ?> " method="post"> <!-- revoir liens-->
    <p style="text-align: center">
      <?php if (isset($errors) && in_array(Post::AUTEUT_INVALIDE, $errors)) echo 'L\'author est invalide.<br />'; ?>
        Author : <input type="text" name="author" value="<?php if (isset($post)) echo $post->author(); ?>" /><br />

        <?php if (isset($errors) && in_array(Post::TITRE_INVALIDE, $errors)) echo 'Le title est invalide.<br />'; ?>
          Title : <input type="text" name="title" value="<?php if (isset($post)) echo $post->title(); ?>" /><br />

          <?php if (isset($errors) && in_array(Post::CONTENT_INVALIDE, $errors)) echo 'Le content est invalide.<br />'; ?>
            Content :<br /><textarea rows="8" cols="60" name="content"><?php if (isset($post)) echo $post->content(); ?></textarea><br />
            <?php
            if(isset($post) && !$post->isNew())
            {
              ?>
              <input type="hidden" name="id" value="<?= $post->id() ?>" />
              <input type="submit" value="Modifier" name="modifier" />
              <?php
            }
            else
            {
              ?>
              <input type="submit" value="Ajouter" />
              <?php
            }
            ?>

          </p>
        </form>


      </body>
      </html>
      <?php $content = ob_get_clean(); ?>

      <?php require('template.php'); ?>
