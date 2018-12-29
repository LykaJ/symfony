<?php $title = 'Inscription' ?>

<?php ob_start(); ?>

<html>
<h1>Inscription</h1>

    <form method="post" action="index.php?action=newUser">
        <fieldset><legend>Identifiant* : </legend><input id="pseudo" type="text" name="pseudo"/></fieldset>
        <fieldset><legend>Mot de passe* : </legend><input id="password" type="password" name="password"/></fieldset>
        <fieldset><legend>Confirmer mot de passe* : </legend><input id="password2" type="password" name="password2"/></fieldset>
        <fieldset><legend>Email* : </legend><input id="email" type="email" name="email"/></fieldset>

        <input type="submit" name="submit" value="Valider"/>
    </form>

</body>
</html>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
