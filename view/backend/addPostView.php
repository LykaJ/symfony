<?php $title = 'Ajouter post'; ?>

<?php ob_start(); ?>


  <div class="container">
    <h1 class="rewrite-bt-banner">Ajouter Post</h1>

  <?php
    $success = \Blog\get_flash('success');
      if (!empty($success)) {
          ?>
        <div class="alert alert-success" role="alert"><?= $success ?></div>
    <?php
      }
      $error = \Blog\get_flash('error');
        if (!empty($error)) {
            ?>
          <div class="alert alert-danger" role="alert"><?= $error ?></div>
      <?php
        } ?>

    <form action="/Blog/posts/create" method="post">
        <?php

        $input = new \Blog\models\Input();
        $session = $input->session('current_user');

        if (isset($session)) {
            ?>
        <div class="form-group">

            <label for="author">Auteur : <strong><?= \Blog\esc($session['pseudo']); ?></strong> </label><br />

        </div>
        <?php
        } ?>
        <div class="form-group">
            <label for="title">Titre</label><br />
            <input type="text" name="title" />
        </div>
        <div class="form-group">
            <label for="content">Contenu</label><br />
            <textarea id="content" name="content" class="form-control" rows="3"></textarea>
        </div>

        <div class="bt-alert">
            <input class="btn btn-info" type="submit" />
            </div>
    </form>


</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
