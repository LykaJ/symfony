
<?php $title = 'Connexion' ?>

<?php ob_start(); ?>

<html>
<h1>Connexion</h1>

    <form method="post" action="index.php?action=login">
        <fieldset><legend>Identifiant : </legend><input id="pseudo" type="text" name="pseudo"/></fieldset>
        <fieldset><legend>Mot de passe : </legend><input id="password" type="password" name="password"/></fieldset>
        <input class="btn btn-primary" type="submit" value="Se connecter"/>
    </form>

</body>
</html>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
