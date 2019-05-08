<?php ob_start(); ?>
<h3 class="mt-2 mb-4 text-center">Gestion des Livres</h3>
 

<div class="m-2 text-right">
  <a class="add-action" href="index.php?action=createBook">
    <img src="https://img.icons8.com/plasticine/100/000000/plus.png">
    Ajouter un nouveau livre
  </a>
</div>

<?php  if (isset($_GET['book'])) {
          if ($_GET['book'] == 'delete') { ?>
            <div class="alert alert-success" role="alert">Le livre a bien été supprimé.</div>
    <?php } 
          elseif ($_GET['book'] == 'creation') { ?>
            <div class="alert alert-success" role="alert">Le nouveau livre a bien été ajouté.</div>
    <?php } 
        } 
        elseif (isset($errors))  { 
          if (in_array('no_book_id', $errors)) { ?>
            <div class="alert alert-danger" role="alert">Aucun numéro de livre renseigné pour la suppression.</div>
    <?php } 
          elseif (in_array('wrong_book_id', $errors)) { ?>
            <div class="alert alert-danger" role="alert">Le livre n'a pu être supprimé dans la BDD. Merci de réessayer.</div>
    <?php }
        } ?>

<div class="table-responsive m-2">
<table class="table table-bordered table-hover table-sm text-center">
  <thead class="thead-dark">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Auteur</th>
        <th scope="col">Titre</th>
        <th scope="col">Chapitres</th>
        <th scope="col">Date de création</th>
        <th scope="col">Dernière modification</th>
        <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php if (empty($books)) { ?>
    <tr>
    <td scope="row" colspan="7">Aucun livre n'a encore été posté.</th>
    </tr>
    <?php }
          else {
            foreach($books as $book) { ?>
    <tr class="justify-content-center">
        <th scope="row"><?= $book->id() ?></th>
        <td><?= $book->firstname . ' ' . $book->lastname ?></td>
        <td><?= $book->title() ?></td>
        <td>
          <a href="index.php?action=showChaptersManagement&amp;bookId=<?=$book->id()?>">
            <img src="https://img.icons8.com/plasticine/100/000000/document.png">
          </a>
        </td>
        <td><?= $book->creationDate() ?></td>
        <td><?= $book->modificationDate() ?></td>
        <td>
          <a href="index.php?action=editBook&amp;id=<?= $book->id() ?>" class="m-1">
            <img src="https://img.icons8.com/plasticine/100/000000/edit.png">
          </a>
          <a data-toggle="modal" id="book-<?=$book->id()?>" data-action="delete" href="#deleteModal" class="m-1">
            <img src="https://img.icons8.com/plasticine/100/000000/delete.png">
          </a>
        </td>
    </tr>
    <?php   }
          } ?>
  </tbody>
</table>
</div>

<?php require('deleteModalView.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php
require_once('templateBack.php');
?>