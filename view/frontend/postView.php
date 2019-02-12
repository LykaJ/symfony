<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start();?>

<section class="container">

    <div class="row">

        <!-- INDEX BUTTON -->

        <div class="col-md-6 col-xs-12">
            <p class="bt-alert">
                <a role="button" class="btn btn-info" href="/Blog">
                    Retour à la liste des billets
                </a>
            </p>
            <h2 class="rewrite-bt-banner">
                <?= htmlspecialchars($post['title']) ?>
            </h2>
            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?><br/>
                <strong>Auteur :  <?= nl2br(htmlspecialchars($post['author'])) ?></strong>
            </p>
            <p><em>publié le <?php
                    $date = new \DateTime($post['creation_date']);
                    echo $date->format('d/m/Y à H:i');
                    ?> <?php if (isset($post['edition_date'])) {
                        ?>
                        modifié le
                        <?php
                        $date_edition = new \DateTime($post['edition_date']);
                        echo $date_edition->format('d/m/Y à H:i');
                    } ?> </em></p>

            <!-- BUTTON DELETE POST -->
            <?php  if ($userRightsManager->can('edit post') && $userRightsManager->can('delete post')) {
                ?>

                <a role="button" class="btn btn-info" href="/Blog/posts/edit/<?= $post['id']?>"> Modifier</a> <a role="button" class="btn btn-info" href="/Blog/posts/delete/<?= $post['id']?>"> Supprimer</a>

                <?php
            } ?>
        </div>


        <!--COMMENTS-->


        <div class="col-md-6 col-xs-12">

            <h2 class="rewrite-bt-dark">Commentaires</h2>
            <?php
            $error = \Blog\get_flash('error');
            if (!empty($error)) {
                ?>
                <div class="alert alert-danger" role="alert"><?= $error ?></div>
                <?php
            } ?>
            <?php if ($userRightsManager->can('add comment')) {
                ?>
                <form action="/Blog/comments/add/<?= $post['id'] ?>" method="post">
                    <?php
                    $input = new \Blog\models\Input();
                    $session = $input->session('current_user');

                    if (isset($session)) {
                        ?>
                        <div>
                            <label for="author">Auteur : <?= \Blog\e($session['pseudo']); ?></label><br />
                        </div>
                        <?php
                    } ?>
                    <div class="form-group">
                        <label for="comment">Commentaire : </label><br />
                        <textarea class="form-control" rows="3" id="comment" name="comment"></textarea>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-info" type="submit"  />
                        <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
                    </div>
                </form>
                <div class="bt-alert">
                    <p class="alert alert-info" role="alert">Les commentaires doivent être validés par un administrateur avant d'apparaître dans la liste. </p>
                </div>
                <?php
            } ?>



            <!--  VALIDATED COMMENTS-->

            <div class="row">
                <div class="col-md-12">
                    <?php
                    while ($comment = $comments->fetch()) {
                    if ($comment['status'] == 1) {
                    ?>

                    <p><strong><?= \Blog\e($comment['author']) ?></strong> le <?php $dateComment = new \DateTime($comment['comment_date']);
                        echo \Blog\e($dateComment->format('d/m/Y')); ?> <br/>
                        <?= nl2br(\Blog\e($comment['comment'])) ?></p>
                </div>

                <!-- COMMENTS VALIDATION -->

                <div class="col-md-12">
                    <?php if ($userRightsManager->can('validate')) {
                        ?>

                        <p><a role="button" class="btn btn-outline-danger" href="/Blog/comments/delete/<?= $comment['id']?>/<?= $post['id'] ?>"> Supprimer</a></p>

                        <?php
                    }
                    }
                    if ($comment['status'] == null) {
                        if ($userRightsManager->can('validate')) {
                            ?>


                            <p><strong><?= \Blog\e($comment['author']) ?></strong> le <?php \Blog\e($dateComment = new \DateTime($comment['comment_date']));
                                echo \Blog\e($dateComment->format('d/m/Y')); ?> <br/>
                                <?= nl2br(\Blog\e($comment['comment'])) ?></p>

                            <p>
                                <a role="button" class="btn btn-outline-success" href="/Blog/comments/validate/<?= \Blog\e($comment['id'])?>/<?= \Blog\e($post['id']) ?>"> Yes</a>
                                <a role="button" class="btn btn-outline-danger" href="/Blog/comments/delete/<?= \Blog\e($comment['id'])?>/<?= \Blog\e($post['id']) ?>"> No</a>
                            </p>

                            <?php
                        }
                    }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</section>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
