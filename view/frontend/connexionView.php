<?php $title = 'Connexion' ?>

<?php ob_start(); ?>

<html>
<h1>Inscription</h1>

<?php
    if(isset($_POST['password']))
    {
        $passform = htmlspecialchars($_POST['password']);

        $correctPass = password_verify($passform, $userPassword['password']);
        var_dump($correctPass);

        if (!$userPassword)
        {
            echo 'Wrong credentials';
        }
        if ($correctPass){
            echo 'Welcome ' . htmlspecialchars($_POST['pseudo']);
        }
        else {
            echo "Wrong credentials";
        }
    }

    ?>
    <form class="" action="index.php?action=" method="post">
        <label for="pseudo">Nom d'utilisateur</label>
        <input type="text" name="pseudo" value=""> <br/>
        <label for="password">Mot de passe</label>
        <input type="text" name="password" value=""> <br/>
        <label for="email">Email</label>
        <input type="text" name="email" value=""> <br/>

        <input type="submit" value="Valider">
    </form>

</body>
</html>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
