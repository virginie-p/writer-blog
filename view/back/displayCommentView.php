<?php ob_start(); ?>

<h3 class="mt-2 mb-4 text-center">Commentaire n° <?=$comment->id()?></h3>
<div class="container comment-info">
    <div class="row d-flex justify-content-center mx-auto">
        <div class="col-4 mb-4">
        <h5>Titre du commentaire : </h5><p><?=$comment->title()?></p>
        </div>
        <div class="col-4 mb-4">
        <h5>Contenu : </h5><p><?=$comment->content()?></p>
        </div>
    </div>
    <div class="row d-flex justify-content-center mx-auto">
        <div class="col-8 mb-4">
        <h5>Posté par : </h5><p><?=$comment->username?></p>
        </div>
    </div>
    <div class="row d-flex justify-content-center mx-auto">
        <div class="col-8 mb-4">
        <h5>Date d'ajout du commentaire: </h5><p><?=$comment->creationDate()?></p>
        </div>
    </div>

    <div class="row d-flex justify-content-center mx-auto">
        <a data-toggle="modal" id="comment-<?=$comment->id()?>" data-action="delete" href="#deleteModal" role="button" class="btn btn-danger">
            Supprimer le commentaire
        </a>
    </div>
</div>

<?php require('deleteModalView.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php
require_once('templateBack.php');
?>