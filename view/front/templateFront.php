<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="public\css\main.css">
    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=d5vv90gjbxrlkogbd4bmlpy6bbsfy9ml7c7dd5pjujl5ska4"></script>
    <script>
        tinymce.init({
            selector: '.form-text-area',
            menubar : false,
            toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright | forecolor'
        });
    </script>
</head>
<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <img src="public\images\logo.png" class="d-inline-block align-center text-white">
                Evasion littéraire
            </a>

            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=showBooksList">Livres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <div>
                    <?php 
                        if(isset($_SESSION['user']) && ($_SESSION['user']->userType() == 3)){
                            echo $connected_menu;
                        }
                        else {
                            echo $disconnected_menu;
                        }
                    ?>
                </div>

            </div>

        </nav>
    </header>

    <section id="content" class="mx-auto"><?= $content ?></section>
    
    <footer class="footer mt-auto py-3 bg-dark">
        <div class="container">
            <div class="row align-items-center">
                <a class="col-md-2 text-white"href="#">Mentions Légales</a>
                <p class="copyright text-muted col-md-6">Virginie PEREIRA, Ile-de-France | 2019 © Tous droits réservés </p>
                <div class="social-media col-md-4">
                    <div class="row justify-content-center">
                        <div class="social-link">
                            <a href="#">
                                <img src="public\images\029-instagram.png" alt="Lien vers le compte Instagram">
                            </a>
                        </div>
                        <div class="social-link">
                            <a href="#">
                                <img src="public\images\036-facebook.png" alt="Lien vers le compte Facebook">
                            </a>
                        </div>
                        <div class="social-link">
                            <a href="#">
                                <img src="public\images\008-twitter.png"  alt="Lien vers le compte Twitter">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="public/js/SubscribeForm.js"></script>
    <script src="public/js/ConnectionForm.js"></script>
    <script src="public/js/CommentReport.js"></script>
</body>
</html>