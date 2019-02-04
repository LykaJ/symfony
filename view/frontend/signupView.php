<?php $title = 'Inscription' ?>

<?php ob_start(); ?>

<html>
<h1 class="rewrite-bt-banner">Inscription</h1>

<div class="container">


    <form method="post" action="/Blog/signup">
        <div class="form-group">
            <label for="identifiant">Identifiant*</label>
            <input id="pseudo" type="text" name="pseudo" class="form-control" placeholder="Identifiant">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe*</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe" name="password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirmer mot de passe*</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirmer mot de passe" name="password2">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email*</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Saisir email" name="email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
    <!--    <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1"> By submitting this form, I agree that my data will be processed, used and exploited in order to be contacted considering the business relationship established here.
            </label>
        </div> -->
        <button type="submit" class="btn btn-info">S'inscrire</button>
        <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
    </form>
<br/>

        <p class="alert alert-info" role="alert">Un validateur va vérifier votre profil avant de le valider. Vous serez informé(e) par mail lors de la confirmation de votre demande. </p>


    <?php
    $error = \Blog\get_flash('error');
    if (!empty($error)) {
        ?>
        <div class="alert alert-danger" role="alert"><?= $error ?></div>

    <?php } ?>
</div>
</body>
</html>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
