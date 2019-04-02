<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="public\css\main.css">
</head>
<body class="container-fluid">
    <header class="row">
        <nav class="navbar navbar-dark bg-dark col-12">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="public\images\logo.png" class="d-inline-block align-center text-white">
                Evasion littéraire
            </a>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Livres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                </ul>
            </div>

            <div>
                <?= $menu ?>
            </div>
        </nav>
    </header>

    

    <footer class="row align-items-center bg-dark">
        <a class="col-md-2 text-white"href="#">Mentions Légales</a>
        <p class="copyright text-muted col-md-6">Virginie PEREIRA, Ile-de-France | 2019 © Tous droits réservés </p>
        <div class="social-media col-md-4 row">
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
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>