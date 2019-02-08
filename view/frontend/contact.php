<?php $title = 'Contact' ?>

<?php ob_start(); ?>

<div class="container">
    <h1 class="rewrite-bt-banner">Contact</h1>

    <p>Vous avez une question ? Envoyez moi un message :)</p>

    <form method="post" action="/Blog/contact">
        <div class="form-group">
            <?php if (isset($_SESSION['current_user'])) {
    ?>
                <label for="identifiant">Votre Identifiant : <?php echo $_SESSION['current_user']['pseudo']; ?></label>
            <?php
} else {
        ?>
                <label for="identifiant">Votre Identifiant*</label>
                <input id="pseudo" type="text" name="pseudo" class="form-control" placeholder="Identifiant">
            <?php
    } ?>
        </div>
        <div class="form-group">
            <?php if (isset($_SESSION['current_user'])) {
        ?>
                <label for="email">Votre Email : <?php echo $_SESSION['current_user']['email']; ?></label>
            <?php
    } else {
        ?>
                <label for="email">Votre Email*</label>
                <input type="email" class="form-control" id="email" placeholder="Saisir email" name="email">
            <?php
    } ?>
        </div>
        <div class="form-group">
            <label for="content">Votre Message*</label>
            <textarea class="form-control" id="content" rows="3" name="content"></textarea>
        </div>

        <button type="submit" class="btn btn-info">Envoyer</button>
    </form>
    <div class="bt-alert">
        <?php
        $error = \Blog\get_flash('error');
        if (!empty($error)) {
            ?>
            <div class="alert alert-danger" role="alert"><?= $error ?></div>

            <?php
        }
        $success = \Blog\get_flash('success');
        if (!empty($success)) {
            ?>
            <div class="alert alert-success" role="alert"><?= $success ?></div>

            <?php
        } ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
