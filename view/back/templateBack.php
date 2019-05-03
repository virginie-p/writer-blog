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
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" >
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="index.php" class="navbar-brand" href="#">
                <img src="public\images\logo.png" class="d-inline-block align-center">
                Evasion littéraire
            </a>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0 align-items-center">
                    <li class="nav-item m-2">
                        <a href="index.php?action=disconnection">Me déconnecter</a>
                    </li>
                    <li class="nav-item m-2">
                        <p> Bonjour <?= $_SESSION['user']->firstname() ?> !<p>
                    </li>
                    <li class="nav-item">
                        <img class="profile-picture border" src="public\images\profile_pictures\<?= $_SESSION['user']->profilePicture(); ?>" alt="">
                    </li>
                </ul>

            </div>

        </nav>
    </header>

    <main role="main" class="container-fluid content-block">
        <div class="row h-100">
            <section class="container-fluid menu col-md-2 bg-light border-right">
                <nav class="row align-content-around text-center">
                    <a class="col-12" href="index.php?action=showBannersManagement">Bannières</a><br/>
                    <a class="col-12" href="index.php?action=showBooksManagement">Livres</a><br/>
                    <a class="col-12" href="index.php?action=showUsersManagement">Utilisateurs</a><br/>
                </nav>
            </section>
            <section class="content col-md-10 container-fluid">
                <?= $content ?>
            </section>
        </div>
    </main>
    
    
    <footer class="footer py-3 bg-light border-top">
        <div class="container">
            <div class="row text-center">
                <p class="copyright text-muted col-md-12">Virginie PEREIRA, Ile-de-France | 2019 © Tous droits réservés </p>
            </div>
        </div>
    </footer>

    
    <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="public/js/Modal.js"></script>
    <script src="public/js/CommentValidation.js"></script>
</body>
</html>