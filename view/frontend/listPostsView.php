<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<div class="container">
    <h1>Mon super blog !</h1>
    <?php
    $error = get_flash('error');
    if (!empty($error)) {
        ?>
        <div class="alert alert-danger" role="alert"><?= $error ?></div>
    <?php } ?>

        <?php if ($userRightsManager->can('add post')) { ?>
            <a role="button" class="btn btn-outline-primary" href="index.php?action=newPost">Ajouter un post</a>
        <?php } if (isset($_SESSION['current_user'])) { ?>
            <a role="button" class="btn btn-outline-primary" href="index.php?action=logout">Déconnexion</a>
        <?php } else { ?>
            <a role="button" class="btn btn-outline-primary" href="index.php?action=signupForm">Inscription</a>
            <a role="button" class="btn btn-outline-primary" href="index.php?action=loginForm">Connexion</a>
        <?php } ?>

    <div class="container">
        <h2>Derniers billets du blog :</h2>

        <?php

        while ($data = $posts->fetch())
        {
 ?>
    <h3>
        <?= htmlspecialchars($data['title']) ?>
    </h3>

    <p>
        <?= nl2br(htmlspecialchars($data['content'])) ?>
        <br />
        <strong>Auteur :  <?= nl2br(htmlspecialchars($data['author'])) ?></strong>
        <br/>
        <p><em>Publié le <?php
        $date = new DateTime($data['creation_date']);
        echo $date->format('d/m/Y H:i');
        ?> modifié le <?php
        $date_edition = new DateTime($data['edition_date']);
        echo $date_edition->format('d/m/Y H:i');
         ?>
        </em></p>
        <p><a href="index.php?action=showPost&amp;id=<?= $data['id'] ?>">Commentaires du post</a></p>

                <?php

            }
            $posts->closeCursor();
            ?>
        </p>
    </div>
</div>

<?php foreach($articles as $article): ?>
    <div class="article">
        <p><?php echo $article['title']; ?></p>
    </div>
<?php endforeach; ?>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="?page=<?php echo $x; ?>&amp;perPage=<?php echo $perPage; ?>"<?php if($page === $x) {echo "class:'selected'";} ?>> <?php echo $x; ?></a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
