<?php ob_start(); ?>
<h3 class="mt-2 mb-4 text-center">Gestion des Chapitres</h3>

<div class="m-2 text-right">
  <a class="add-action" href="index.php?action=createChapter&bookId=<?=$book->id()?>">
    <img src="https://img.icons8.com/plasticine/100/000000/plus.png">
    Ajouter un nouveau chapitre
  </a>
</div>

<?php  if (isset($_GET['chapter'])) {
          if ($_GET['chapter'] == 'delete') { ?>Le chapitre a bien été supprimé.</div>
    <?php } 
          elseif ($_GET['chapter'] == 'creation') { ?>
            <div class="alert alert-success" role="alert">Le nouveau chapitre a bien été ajouté.</div>
    <?php } 
        } ?>

<div class="table-responsive m-2">
<table class="table table-bordered table-hover table-sm text-center">
  <thead class="thead-dark">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Livre</th>
        <th scope="col">Titre du chapitre</th>
        <th scope="col">Commentaires</th>
        <th scope="col">Date de création</th>
        <th scope="col">Dernière modification</th>
        <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($chapters as $chapter) { ?>
    <tr class="justify-content-center">
        <th scope="row"><?=$chapter->id()?></th>
        <td><?=$book->title()?></td>
        <td><?=$chapter->title()?></td>
        <td>
          <a href="index.php?action=showCommentsManagement&amp;id=<?=$chapter->id()?>">
            <img src="https://img.icons8.com/plasticine/100/000000/chat.png">          </a>
        </td>
        <td><?= $chapter->creationDate() ?></td>
        <td><?= $chapter->modificationDate() ?></td>
        <td>
          <a href="index.php?action=editChapter&amp;id=<?= $chapter->id() ?>" class="m-1">
            <img src="https://img.icons8.com/plasticine/100/000000/edit.png">
          </a>
          <a data-toggle="modal" id="chapter-<?=$chapter->id()?>" data-action="delete" href="#deleteModal" class="m-1">
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