<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<aside class="col col-md-6">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1>Mon super blog !</h1>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col">
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
            </div>
        </div>
    </div>
</div>
</aside>
<br/>
<section>
    <div class="container">
        <div class="row">
            <div class="col col-md-4">
                <h2>Derniers billets du blog :</h2>
            </div>
            <div class="col col-md-6">
                <?php foreach($posts as $post): ?>
                    <div class="article">
                        <h3>
                            <?= htmlspecialchars($post['title']) ?>
                        </h3>
                        <?= nl2br(htmlspecialchars($post['content'])) ?>
                        <br />
                        <strong>Auteur :  <?= nl2br(htmlspecialchars($post['author'])) ?></strong>
                        <br/>
                        <p><em>Publié le <?php
                        $date = new DateTime($post['creation_date']);
                        echo $date->format('d/m/Y H:i');
                        ?> modifié le <?php
                        $date_edition = new DateTime($post['edition_date']);
                        echo $date_edition->format('d/m/Y H:i');
                        ?>
                    </em></p>
                    <p><a href="index.php?action=showPost&amp;id=<?= $post['id'] ?>">Commentaires du post</a></p>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
</section>

<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <?php
            for($x = 1; $x <= $pages; $x++): ?>
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
            <?php endfor; ?>

            <?php var_dump($x);?> <br/>
            <?php var_dump($pages);?> <br/>
        </div>
    </div>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
