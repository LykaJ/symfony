<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start();?>


<section>
    <div class="container">
        <div class="row">
            <div class="col col-md-6">
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
                $date = new DateTime($post['creation_date']);
                echo $date->format('d/m/Y à H:i');
                ?> <?php if(isset($post['edition_date'])) { ?>
                    modifié le
                    <?php
                    $date_edition = new DateTime($post['edition_date']);
                    echo $date_edition->format('d/m/Y à H:i');
                } ?> </em></p>

                <?php  if($userRightsManager->can('edit post') && $userRightsManager->can('delete post')) { ?>

                    <a role="button" class="btn btn-info" href="/Blog/posts/edit/<?= $post['id']?>"> Modifier</a> <a role="button" class="btn btn-info" href="/Blog/posts/delete/<?= $post['id']?>"> Supprimer</a>

                <?php } ?>
            </div>

            <div class="col col-md-6">
                <h2 class="rewrite-bt-dark">Commentaires</h2>
                <?php
                $error = get_flash('error');
                if (!empty($error)) {
                    ?>
                    <div class="alert alert-danger" role="alert"><?= $error ?></div>
                <?php } ?>
                <?php if ($userRightsManager->can('add comment')) { ?>
                    <form action="/Blog/comments/add/<?= $post['id'] ?>" method="post">
                        <?php if(isset($_SESSION['current_user'])) { ?>
                            <div>
                                <label for="author">Auteur : <?php echo ($_SESSION['current_user']['pseudo']); ?></label><br />
                            </div>
                        <?php } ?>
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
                <?php } ?>
                <br/>
                <div class="row">

                    <?php
                    while ($comment = $comments->fetch())
                    {
                        if($comment['status'] == 1) {?>
                            <div class="col col-sm-8">
                                <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?php $dateComment = new DateTime($comment['comment_date']); echo $dateComment->format('d/m/Y');?> <br/>
                                    <?= nl2br(htmlspecialchars($comment['comment'])) ?></p>

                                    <!--   <?php if($userRightsManager->can('edit comment') && $comment['user_id'] === $_SESSION['current_user']['id']) { ?>
                                </div>

                                <div class="col col-sm-4">
                                <p><a role="button" class="btn btn-outline-primary" href="index.php?action=editComment&amp;id=<?= $comment['id']?>&amp;postId=<?= $post['id'] ?>"> Modifier</a></p>
                            <?php }    ?>

                        </div> -->
                    </div>

                    <div class="col col-sm-4">
                        <?php if($userRightsManager->can('validate')) { ?>

                            <p><a role="button" class="btn btn-outline-danger" href="/Blog/comments/delete/<?= $comment['id']?>/<?= $post['id'] ?>"> Supprimer</a></p>

                        <?php } ?>
                    </div>

                    <?php
                }
                ?>

                <?php if($comment['status'] == NULL) {
                    if($userRightsManager->can('validate'))
                    {
                        ?>

                        <div class="col col-sm-8">
                            <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?php $dateComment = new DateTime($comment['comment_date']); echo $dateComment->format('d/m/Y');?> <br/>
                                <?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                            </div>
                            <div class="col col-sm-4">

                                <p><a role="button" class="btn btn-outline-success" href="/Blog/comments/validate/<?= $comment['id']?>/<?= $post['id'] ?>"> Yes</a>
                                    <a role="button" class="btn btn-outline-danger" href="/Blog/comments/delete/<?= $comment['id']?>/<?= $post['id'] ?>"> No</a></p>

                                </div>

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
