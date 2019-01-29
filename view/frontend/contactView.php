<?php $title = 'Contact' ?>

<?php ob_start(); ?>

<html>
<h1>Contact</h1>

<div class="container">
    <form method="post" action="/Blog/signup">
        <div class="form-group">
            <label for="name">Nom</label>
            <input id="name" type="text" name="name" class="form-control" placeholder="Votre nom">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email*</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Saisir email" name="email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
    <label for="exampleFormControlTextarea1">Message</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
        <!--    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1"> By submitting this form, I agree that my data will be processed, used and exploited in order to be contacted considering the business relationship established here.
    </label>
</div> -->
<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>

<?php $content = ob_get_clean(); ?>

<?php require('../template.php'); ?>
