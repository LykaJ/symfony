<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>

<?php
  $error = get_flash('error');

  if (!empty($error)) {
      ?>
      <p><?= $error ?></p>

  <?php } ?>

<?php if ($userRightsManager->can('add post')) { ?>
<p><a href="index.php?action=newPost">Ajouter un post</a></p>
<?php } if (isset($_SESSION['current_user'])) { ?>
<p> <a href="index.php?action=logout">Déconnexion</a></p>
<?php } else { ?>
<p> <a href="index.php?action=signupForm">Inscription</a></p>
<p> <a href="index.php?action=loginForm">Connexion</a></p>
<?php } ?>

<p>Derniers billets du blog :</p>

<?php
while ($data = $posts->fetch())
{
  ?>
  <div class="news">
    <h3>
      <?= htmlspecialchars($data['title']) ?>
     <em>le <?php
     $date = new DateTime($data['creation_date']);
     echo $date->format('d/m/Y H:i');
     ?></em>

    </h3>

    <p>
      <?= nl2br(htmlspecialchars($data['content'])) ?>
      <br />
      <strong>Auteur :  <?= nl2br(htmlspecialchars($data['author'])) ?></strong>
      <br/>
      <em><a href="index.php?action=showPost&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
    </p>
  </div>

  <?php
}
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
