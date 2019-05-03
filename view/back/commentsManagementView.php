<?php ob_start(); ?>
<h3 class="mt-2 mb-4 text-center">Gestion des Commentaires</h3>

<?php   if (isset($_GET['comment'])) {
          if ($_GET['comment'] == 'delete') { ?>
            <div class="alert alert-success" role="alert">Le commentaire a bien été supprimé.</div>
    <?php }
          elseif ($_GET['comment'] == 'delete-error') { ?>
            <div class="alert alert-danger" role="alert">Aucun numéro de commentaire renseigné pour la suppression.</div>
    <?php } 
        }
        elseif (isset($error) && $error == 'no_chapter_id') { ?>
            <div class="alert alert-danger" role="alert">Aucun numéro de chapitre renseigné.</div>
<?php   } ?>
<div class="comment-validation-messages"></div>
<div class="table-responsive m-2">
<table class="table table-bordered table-hover table-sm text-center">
  <thead class="thead-dark">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Utilisateur</th>
        <th scope="col">Titre du commentaire</th>
        <th scope="col">Date de création</th>
        <th scope="col">À modérer</th>
        <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($comments as $comment) { ?>
    <tr class="<?php if ($comment->moderationStatus() == 1) {?> table-warning <?php }?>">
        <th scope="row"><?=$comment->id()?></th>
        <td><?=$comment->username?></td>
        <td><?=$comment->title()?></td>
        <td><?= $comment->creationDate() ?></td>
        <td class="moderation-status"><?php if ($comment->moderationStatus() == 1) { echo '<strong>Oui</strong>';} elseif($comment->moderationStatus() == 2) {echo 'Validé';} else {echo 'Non';} ?></td>
        <td>
        <?php if($comment->moderationStatus() == 1) { ?>
          <a href="index.php?action=validateComment&amp;id=<?= $comment->id() ?>" class="validate-comment m-1">
            <img src="https://img.icons8.com/plasticine/100/000000/checked.png">
          </a>
        <?php } ?>
          <a href="index.php?action=displayComment&amp;id=<?= $comment->id() ?>" class="m-1">
            <img src="https://img.icons8.com/plasticine/100/000000/search-more.png">
          </a>
          <a data-toggle="modal" id="comment-<?=$comment->id()?>" data-action="delete" href="#deleteModal" class="m-1">
            <img src="https://img.icons8.com/plasticine/100/000000/delete.png">
          </a>
        </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>

<?php require('deleteModalView.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php
require_once('templateBack.php');
?>