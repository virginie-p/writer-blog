<?php ob_start(); ?>

<h3 class="mt-2 mb-4 text-center">Fiche utilisateur de : "<?=$user->username()?>"</h3>
<div class="container user-info">
    <div class="row d-flex justify-content-center mx-auto">
        <div class="col-4 mb-4">
        <h5>Nom : </h5><p><?=$user->lastname()?></p>
        </div>
        <div class="col-4 mb-4">
        <h5>Prénom : </h5><p><?=$user->firstname()?></p>
        </div>
    </div>
    <div class="row d-flex justify-content-center mx-auto">
        <div class="col-8 mb-4">
        <h5>Email : </h5><p><?=$user->email()?></p>
        </div>
    </div>
    <div class="row d-flex justify-content-center mx-auto">
        <div class="col-8 mb-4">
        <h5>Date d'inscription : </h5><p><?=$user->creationDate()?></p>
        </div>
    </div>
    <div class="row d-flex justify-content-center mx-auto">
        <div class="col-8 mb-4">
        <h5>Photo de profil : </h5><img src="public/images/profile_pictures/<?=$user->profilePicture()?>" alt="Photo de profil">
        </div>
    </div>

    <div class="row d-flex justify-content-center mx-auto">
        <a data-toggle="modal" id="user-<?=$user->id()?>" data-action="delete" href="#deleteModal" role="button" class="btn btn-danger">
            Supprimer l'utilisateur
        </a>
    </div>
</div>

<?php require('deleteModalView.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php
require_once('templateBack.php');
?>