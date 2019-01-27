<?php $title = 'Ajouter post'; ?>

<?php ob_start(); ?>


<!DOCTYPE html>
<html>
<head>
    <title>Administration</title>
    <meta charset="utf-8" />
</head>

<body>
    <!-- <p><a href="index.php">Accéder à l'accueil du site</a></p> -->

    <section class="container">
        <h1 class="rewrite-bt-banner">Ajouter Post</h1>

        <?php
        $success = get_flash('success');
        if (!empty($success)) {
            ?>
            <div class="alert alert-success" role="alert"><?= $success ?></div>
        <?php } ?>

        <form action="index.php?action=createPost" method="post">
            <?php if(isset($_SESSION['current_user'])) { ?>
                <div class="form-group">
                    <label for="author">Auteur : <strong><?php echo $_SESSION['current_user']['pseudo']; ?></strong> </label><br />
                </div>
            <?php } ?>

            <div class="form-group">
                <label for="title">Titre</label><br />
                <input type="text" name="title" class="form-control" placeholder="Titre"/>
            </div>
            <div class="form-group">
                <label for="content">Contenu</label><br />
                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
            </div>
            <div>
                <input class="btn btn-info" type="submit" />
                <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
            </form>
        </div>
    </section>
</body>
</html>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
