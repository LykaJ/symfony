<?php $title = 'Connexion' ?>

<?php ob_start(); ?>


<h1 class="rewrite-bt-banner">Connexion</h1>

<?php
$error = get_flash('error');
if (!empty($error)) {
    ?>
    <div class="alert alert-danger" role="alert"><?= $error ?></div>
<?php }
$success = get_flash('success');
if (!empty($success)) {
    ?>
    <div class="alert alert-success" role="alert"><?= $success ?></div>
<?php }
$warning = get_flash('warning');
if (!empty($warning)) {
    ?>
    <div class="alert alert-warning" role="alert"><?= $warning ?></div>
<?php } ?>

<div class="container">
    <form method="post" action="/Blog/login">
        <div class="form-group">
            <label for="identifiant">Identifiant*</label>
            <input id="pseudo" type="text" name="pseudo" class="form-control" placeholder="Identifiant">
        </div>
        <div class="form-group">
            <label for="identifiant">Mot de passe*</label>
            <input id="password" type="password" name="password" class="form-control" placeholder="Mot de passe">
        </div>

        <input class="btn btn-info" type="submit" value="Se connecter"/>

        <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
    </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
