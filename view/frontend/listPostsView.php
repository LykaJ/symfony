<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<section class="container-fluid" id="about-container">
    <div class="row align-items-center">
        <div class="col-md-4 offset-md-8">
            <?php
            $error = \Blog\get_flash('error');
            if (!empty($error)) {
                ?>
                <div class="alert alert-danger" role="alert"><?= $error ?></div>
            <?php
            } ?>
            <?php
            $success = \Blog\get_flash('success');
            if (!empty($success)) {
                ?>
                <div class="alert alert-success" role="alert"><?= $success ?></div>
            <?php
            } ?>
            <?php
            $warning = \Blog\get_flash('warning');
            if (!empty($warning)) {
                ?>
                <div class="alert alert-warning" role="alert"><?= $warning ?></div>
            <?php
            } ?>



                    <?php if ($userRightsManager->can('add post')) {
                ?>
                        <a role="button" class="btn btn-warning" href="/Blog/posts/new">Ajouter un post</a>
                    <?php
            } if (isset($_SESSION['current_user'])) {
                ?>
                        <a role="button" class="btn btn-warning" href="/Blog/logout">Déconnexion</a>
                    <?php
            } else {
                ?>
                        <a role="button" class="btn btn-warning" href="/Blog/signup">Inscription</a>
                        <a role="button" class="btn btn-warning" href="/Blog/signin">Connexion</a>
                    <?php
            } ?>

        </div>
        <div class="col">
            <h1 class="rewrite-bt-light">Bienvenue !</h1>
            <div class="">
                <img src="public/img/id-real.png" alt="ID-image" class="rounded-circle" width="150">
            </div>
            <!-- <p>Bienvenue sur mon blog.</p>
            <p>Suivant une formation OpenClassrooms, j'ai créé ce blog pour suivre l'un des projets demandés. Je le mettrai à jour une fois que la formation sera validée.</p> -->

        </div>

    </div>
</section>

<br/>
<section>
    <div class="container">

                <h2 class="rewrite-bt-dark">Derniers billets du blog :</h2>


                <?php foreach ($posts as $post):
                    if ($post['status'] == 1) {
                        ?>
                        <h3 class="rewrite-bt-banner">
                            <?= htmlspecialchars($post['title']); ?>
                        </h3>
                        <?= nl2br(htmlspecialchars($post['content'])) ?>
                        <br />
                        <strong>Auteur :  <?= nl2br(htmlspecialchars($post['author'])) ?></strong>
                        <br/>
                        <p><em>Publié le <?php
                        $date = new DateTime($post['creation_date']);
                        echo $date->format('d/m/Y à H:i'); ?>
                        <?php if (isset($post['edition_date'])) {
                            ?>
                            modifié le
                            <?php
                            $date_edition = new DateTime($post['edition_date']);
                            echo $date_edition->format('d/m/Y à H:i');
                        } ?>
                    </em></p>
                    <p><a role="button" class="btn btn-info" href="/Blog/posts/<?= $post['id'] ?>">En lire plus...</a></p>
                <?php
                    } ?>
            <?php endforeach;?>

</div>
</section>

<!--<div class="container">
<div class="row justify-content-center">
<div class="col">
<?php
for ($x = 1; $x <= $pages; $x++): ?>
<nav aria-label="Page navigation example">
<ul class="pagination justify-content-center">
<li class="page-item disabled">
<a class="page-link" href="#" tabindex="-1">Previous</a>
</li>
<li class="page-item"><a class="page-link" href="?page=<?php echo $x; ?>&amp;perPage=<?php echo $perPage; ?>"<?php if ($page === $x) {
                        echo "class:'selected'";
                    } ?>> <?php echo $x; ?></a></li>
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
</div> -->



<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
