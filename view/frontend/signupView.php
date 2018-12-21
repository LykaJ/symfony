<?php $title = 'Inscription' ?>

<?php ob_start(); ?>

<html>
<h1>Inscription</h1>

    <form method="get" action="index.php?action=newUser&amp;id=<?= $data['id'] ?>">
        <fieldset><legend>Login* : </legend><input type="text" name="pseudo"/></fieldset>
        <fieldset><legend>Mot de passe* : </legend><input type="password" name="password"/></fieldset>
        <fieldset><legend>Confirmer mot de passe* : </legend><input type="password" name="password2"/></fieldset>
        <fieldset><legend>Email* : </legend><input type="email" name="email"/></fieldset>

        <input type="submit" name="submit" value="Valider"/>
    </form>

</body>
</html>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
