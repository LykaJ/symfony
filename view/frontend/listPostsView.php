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

                <?php
            }
            $posts->closeCursor();
            ?>
        </p>
    </div>
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
