<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- Custom stylesheet -->
        <link rel="stylesheet" href="/Blog/public/css/master.css">

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</head>

    <body>

    <div id="container">

        <!-- NAVIGATION -->

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="header">

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
                    <!--    <?php # if($userRightsManager->can('add post')) {?> -->
                    <li class="nav-item">
                        <a class="nav-link" href="/Blog/posts/new">Ajouter Post</a>
                    </li>
                    <!--    <?php # }?> -->
                    <!--    <?php # if($userRightsManager->can('validate')) {?> -->
                    <li class="nav-item">
                        <a class="nav-link" href="/Blog/admin/validation">Validation</a>
                    </li>
                    <!--    <?php # }?> -->

                </ul>
            </div>
        </nav>

        <!-- PAGE CONTENT-->

        <div id="body">
            <?= $content ?>
        </div>

        <!-- FOOTER-->

        <footer class="text-center" id="footer">
            <div class="footer-above">
                <div class="container-fluid">
                    <div class="row">
                        <div class="footer-col col-md-4">

                            <h3 class="rewrite-bt-light-font">Infos pratiques</h3>

                            <p><a class="rewrite-bt-footer" href="https://drive.google.com/file/d/1zLCE0MCBIa-iqdN127FFKBYyuW7LMJsG/view?usp=sharing" target="_blank"> Consulter mon CV</a></p>
                            <p><a class="rewrite-bt-footer" href="/Blog/admin/validation" >Administration</a> </p>

                        </div>
                        <div class="footer-col col-md-4">
                            <h3 class="rewrite-bt-light-font">Réseaux sociaux</h3>
                            <a class="icon" href="https://github.com/LykaJ" target="_blank"><i class="fa fa-github fa-2x"></i></a>
                            <a class="icon" href="https://www.linkedin.com/in/alicia-raulet-771397b2/" target="_blank"><i class="fa fa-linkedin fa-2x"></i></a>

                        </div>
                        <div class="footer-col col-md-4">
                            <h3 class="rewrite-bt-light-font">A propos</h3>
                            <p class="rewrite-bt-light-font">Ce blog est le projet 5 de la formation OpenClassrooms <a href="https://openclassrooms.com/fr/paths/59-developpeur-dapplication-php-symfony" target="_blank">Développement Web avec PHP/Symfony</a>.</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-below">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="rewrite-bt-light-font">Copyright &copy; <?php $date = new \DateTime();
                                echo $date->format('Y'); ?></p>

                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>



</body>

</html>
