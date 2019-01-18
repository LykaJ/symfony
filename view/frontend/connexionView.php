<?php $title = 'Connexion' ?>

<?php ob_start(); ?>

<html>
<h1>Connexion</h1>

<div class="container">
    <form method="post" action="index.php?action=login">
        <div class="form-group">
            <label for="identifiant">Identifiant*</label>
            <input id="pseudo" type="text" name="pseudo" class="form-control" placeholder="Identifiant">
        </div>
        <div class="form-group">
            <label for="identifiant">Mot de passe*</label>
            <input id="password" type="password" name="password" class="form-control" placeholder="Mot de passe">
        </div>
        <input class="btn btn-primary" type="submit" value="Se connecter"/>
        <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
    </form>
</div>

</body>
</html>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
