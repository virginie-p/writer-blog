<?php ob_start(); ?>

<?php if (isset($errors))  { 
          if (in_array('no_comment_id', $errors)) { ?>
            <div class="alert alert-danger" role="alert">Aucun numéro de commentaire renseigné.</div>
    <?php }
          if (in_array('wrong_comment_id', $errors)) { ?>
            <div class="alert alert-danger" role="alert">Mauvais numéro de commentaire renseigné.</div>
    <?php }
        } ?>

<?php if ($comment != false) { ?>
<h3 class="mt-2 mb-4 text-center">Commentaire n° <?=$comment->id()?></h3>
<div class="comment-validation-messages"></div>
<div class="container comment-info">
    <div class="row d-flex justify-content-center mx-auto">
        <div class="col-lg-4 col-md-12 mb-4">
        <h5>Titre du commentaire : </h5><p><?=$comment->title()?></p>
        </div>
        <div class="col-lg-4 col-md-12 mb-4">
        <h5>Contenu : </h5><p><?=$comment->content()?></p>
        </div>
    </div>
    <div class="row d-flex justify-content-center mx-auto">
        <div class="col-lg-8 col-md-12 mb-4">
        <h5>Posté par : </h5><p><?=$comment->username?></p>
        </div>
    </div>
    <div class="row d-flex justify-content-center mx-auto">
        <div class="col-lg-8 col-md-12 mb-4">
        <h5>Date d'ajout du commentaire: </h5><p><?=$comment->creationDate()?></p>
        </div>
    </div>

    <div class="text-center mx-auto mb-2">
        <a data-toggle="modal" id="comment-<?=$comment->id()?>" data-action="delete" href="#deleteModal" role="button" class=" btn btn-danger">
            Supprimer le commentaire
        </a>
        <?php if($comment->moderationStatus() == 1) { ?>
            <a href="index.php?action=validateComment&amp;id=<?= $comment->id() ?>" role="button" class="validate-comment m-1 btn btn-success">
                Valider le commentaire
            </a>
        <?php } ?>
    </div>
</div>

<?php require('deleteModalView.php'); ?>

<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php
require_once('templateBack.php');
?>