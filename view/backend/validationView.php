<?php $title = 'Validation'; ?>

<?php ob_start(); ?>

<aside>
    <div class="container">
        <div class="row align-items-center">
            <div class="col">

                <h1 class="rewrite-bt-banner">Page de validation</h1>

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
                <?php
                $success = get_flash('success');
                if (!empty($success)) {
                    ?>
                    <div class="alert alert-success" role="alert"><?= $success ?></div>
                <?php } ?>

                <?php
                $warning = get_flash('warning');
                if (!empty($warning)) {
                    ?>
                    <div class="alert alert-warning" role="alert"><?= $warning ?></div>
                <?php } ?>

            </div>
        </div>
    </div>
</aside>

<br/>
<section>
    <div class="container">
        <div class="row">
            <div class="col col-md-4 col-sm-12">
                <h2>Derniers billets non validés :</h2>
            </div>

            <div class="col col-md-6 col-sm-12">
                <?php foreach($unvalidated_posts as $unvalidated_post):

                    if($unvalidated_post['status'] === NULL) { ?>


                        <h3>
                            <?= htmlspecialchars($unvalidated_post['title']) ?>
                        </h3>
                        <?= nl2br(htmlspecialchars($unvalidated_post['content'])) ?>
                        <br />
                        <strong>Auteur :  <?= nl2br(htmlspecialchars($unvalidated_post['author'])) ?></strong>
                        <br/>
                        <p><em>Publié le <?php
                        $date = new DateTime($unvalidated_post['creation_date']);
                        echo $date->format('d/m/Y à H:i');
                        ?>
                        <?php if(isset($unvalidated_post['edition_date'])) { ?>
                            modifié le
                            <?php
                            $date_edition = new DateTime($unvalidated_post['edition_date']);
                            echo $date_edition->format('d/m/Y à H:i');

                        } ?>

                    </em></p>
                    <p>
                        <a role="button" class="btn btn-outline-success" href="/Blog/validate/post-<?= $unvalidated_post['id']; ?>">Valider</a>
                        <a role="button" class="btn btn-outline-danger" href="/Blog/posts/delete-<?= $unvalidated_post['id']; ?>">Supprimer</a>
                    </p>

                <?php } ?>
            <?php endforeach;?>
        </div>
    </div>
</div>
</section>

<section class="container">
        <h2>Nouveaux comptes créés :</h2>
        <?php foreach($new_users as $new_user):
            if(!empty($new_user)) { ?>

                <div class="table-responsive-md">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Identifiant</th>
                                <th scope="col">Email</th>
                                <th scope="col">Date inscription</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $new_user['pseudo']; ?></td>
                                <td><?= $new_user['email']; ?></td>
                                <td><?= $new_user['signup_date']; ?></td>
                                <td>

                                    <div class="btn-group">
                                            <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Valider
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="/Blog/validate/user/<?= $new_user['id']; ?>/<?= $new_user['profile_id'] = 1 ?>">Membre</a>
                                                <a class="dropdown-item" href="/Blog/validate/user/<?= $new_user['id']; ?>/<?= $new_user['profile_id'] = 2 ?>">Collaborateur</a>
                                                <a class="dropdown-item" href="/Blog/validate/user/<?= $new_user['id']; ?>/<?= $new_user['profile_id'] = 3 ?>"> Administrateur</a>
                                            </div>
                                        </div>

                                        <a role="button" class="btn btn-outline-danger" href="/Blog/delete/user/<?= $new_user['id']; ?>">Supprimer</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            <?php } ?>
        <?php endforeach; ?>
    </div>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
