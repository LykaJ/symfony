<?php $title = 'Connexion' ?>

<?php ob_start(); ?>

<html>
<h1>Connexion</h1>

    <form method="get" action="index.php">
        <fieldset><legend>Login : </legend><input type="text" name="login"/></fieldset>
        <fieldset><legend>Mot de passe : </legend><input type="password" name="password"/></fieldset>
        <input type="submit" name="submit" value="Se connecter"/>
    </form>

</body>
</html>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
