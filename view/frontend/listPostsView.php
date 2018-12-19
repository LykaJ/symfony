<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php?action=createPost">Ajouter Post : Admin</a></p>

<p>Derniers billets du blog :</p>

<?php
while ($data = $posts->fetch())
{
  ?>
  <div class="news">
    <h3>
      <?= htmlspecialchars($data['title']) ?>
      <!--  <em>le <?= $data['creation_date'] ?></em> -->

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
