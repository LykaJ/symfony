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
      <em><a href="index.php?action=showPost&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
    </p>
  </div>

  <?php
}
$posts->closeCursor();
?>
    <h2>Ajouter Post</h2>

    <form action="index.php" method="post">
        <div>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" />
        </div>
        <div>
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="title" />
        </div>
        <div>
            <label for="content">Contenu</label><br />
            <textarea id="content" name="content"></textarea>
        </div>
        <div>
            <input type="submit" />
    </form>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
