<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- Custom stylesheet -->
        <link rel="stylesheet" href="/Blog/public/css/master.css">


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">

                        <a class="nav-link" href="/Blog">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Blog/contact">Contact</a>
                    </li>
                    <!--    <?php # if($userRightsManager->can('add post')) { ?> -->
                    <li class="nav-item">
                        <a class="nav-link" href="/Blog/posts/new">Ajouter Post</a>
                    </li>
                    <!--    <?php # } ?> -->
                    <!--    <?php # if($userRightsManager->can('validate')) { ?> -->
                    <li class="nav-item">
                        <a class="nav-link" href="/Blog/admin/validation">Validation</a>
                    </li>
                    <!--    <?php # } ?> -->

                </ul>
            </div>
        </nav>



        <?= $content ?>

        <footer class="text-center">
            <div class="footer-above">
                <div class="container">
                    <div class="row">
                        <div class="footer-col col-md-4">

                            <h3 class="rewrite-bt-light-font">CV</h3>

                            <a href="https://drive.google.com/file/d/1zLCE0MCBIa-iqdN127FFKBYyuW7LMJsG/view?usp=sharing" target="_blank">Consulter mon CV</a>

                        </div>
                        <div class="footer-col col-md-4">
                            <h3 class="rewrite-bt-light-font">Around the Web</h3>

                            <!--    <ul class="list-inline">
                            <li>
                            <a href="https://github.com/LykaJ" class="btn-social btn-outline"><i class="fa fa-github"></i></a>
                        </li>
                        <li>
                        <a href="https://www.linkedin.com/in/alicia-raulet-771397b2/" class="btn-social btn-outline"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul> -->

                <a href="https://github.com/LykaJ" target="_blank">GitHub</a>
                <a href="https://www.linkedin.com/in/alicia-raulet-771397b2/" target="_blank">LinkedIn</a>
            </div>
            <div class="footer-col col-md-4">
                <h3 class="rewrite-bt-light-font">About this blog</h3>
                <p class="rewrite-bt-light-font">This blog is the fith project of the OpenClassrooms training <a href="https://openclassrooms.com/fr/paths/59-developpeur-dapplication-php-symfony" target="_blank">Website Developpement using PHP/Symfony</a> .</p>

            </div>
        </div>
    </div>
</div>
<div class="footer-below">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="rewrite-bt-light-font">Copyright &copy; <?php $date = new DateTime();
                echo $date->format('Y'); ?></p>

            </div>
        </div>
    </div>
</div>
</footer>

</body>

</html>
