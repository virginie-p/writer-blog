<?php ob_start(); ?>
    <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#subscribeForm">S'inscrire</button>
    <button type="button" class="btn btn-outline-light"  data-toggle="modal" data-target="#connexionForm">Se connecter</button>

    <!-- Modal Subscription-->
    <div class="modal fade" id="subscribeForm" tabindex="-1" role="dialog" aria-labelledby="subscribeFormTitle">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subscribeFormTitle">Formulaire d'inscription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <div class="messages"></div>
                <form action="index.php?action=subscribe" method="post" id="subscribe-form">
                    <div class="form-group">
                        <label for="username">Pseudo</label>
                        <input type="text" class="form-control" name="subscribe-username" value="<?php if (isset($_POST['subscribe-username'])) { echo $_POST['subscribe-username']; }?>">
                    </div>
                    <div class="form-group">
                        <label for="subscribe-password">Mot de passe</label>
                        <input type="password" class="form-control" name="subscribe-password" aria-describedby="passwordHelp" >
                        <small id="passwordHelp" class="form-text text-muted">Votre mot de passe doit être composé de 8 caractères dont à minima un chiffre et une lettre majuscule.</small>
                    </div>
                    <div class="form-group">
                        <label for="password-confirmation">Confirmer votre mot de passe</label>
                        <input type="password" class="form-control" name="password-confirmation">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Nom</label>
                        <input type="text" class="form-control" name="lastname" value="<?php if (isset($_POST['lastname'])) { echo $_POST['lastname']; } ?>">
                    </div>
                    <div class="form-group">
                        <label for="firstname">Prénom</label>
                        <input type="text" class="form-control" name="firstname" value="<?php if (isset($_POST['firstname'])) { echo $_POST['firstname']; } ?>">
                    </div>
                    <div class="form-group">
                        <label for="profile-picture">Sélectionner votre photo de profil</label>
                        <input type="file" class="form-control-file" name="profile-picture">
                    </div>
                </form>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" id="subscribe-button" class="btn btn-primary" form="subscribe-form">S'inscrire</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Connexion-->
    <div class="modal fade" id="connexionForm" tabindex="-1" role="dialog" aria-labelledby="connexionFormTitle">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="connexionFormTitle">Formulaire de connexion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <form action="index.php?action=connection" method="post" id="connexion-form">
                    <div class="form-group">
                        <label for="username">Pseudo</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </form>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" form="connexion-form">Se connecter</button>
                </div>
            </div>
        </div>
    </div>
<?php $disconnected_menu = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="collapse navbar-collapse" id="">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0 align-items-center">
        <li class="nav-item m-2 ">
            <a class="nav-link" href="index.php?action=disconnection">Me déconnecter</a>
        </li>
        <li class="nav-item m-2">
            <p class="navbar-text">Bonjour <?php if(isset($_SESSION['user'])){ echo $_SESSION['user']->firstname(); } ?> !<p>
        </li>
        <li class="nav-item">
            <img class="profile-picture border" src="public\images\profile_pictures\<?php if(isset($_SESSION['user'])){ echo $_SESSION['user']->profilePicture(); } ?>" alt="">
        </li>
    </ul>
</div>
<?php $connected_menu = ob_get_clean(); ?>