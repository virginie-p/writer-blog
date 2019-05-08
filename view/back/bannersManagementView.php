
<?php ob_start(); ?>
<h3 class="mt-2 mb-4 text-center">Gestion des Bannières</h3>
 

<div class="m-2 text-right">
  <a class="add-action" href="index.php?action=createBanner">
    <img src="https://img.icons8.com/plasticine/100/000000/plus.png">
    Ajouter une nouvelle bannière
  </a>
</div>

<?php  if (isset($_GET['banner'])) {
          if ($_GET['banner'] == 'delete') { ?>
            <div class="alert alert-success" role="alert">La bannière a bien été supprimée.</div>
    <?php } 
          elseif ($_GET['banner'] == 'creation') { ?>
            <div class="alert alert-success" role="alert">La nouvelle bannière a bien été ajoutée.</div>
    <?php } 
        } 
        elseif (isset($errors))  { 
          if (in_array('no_banner_id', $errors)) { ?>
            <div class="alert alert-danger" role="alert">Aucun numéro de bannière renseigné pour la suppression.</div>
    <?php } 
        } ?>

<div class="table-responsive m-2">
<table class="table table-bordered table-hover table-sm text-center">
  <thead class="thead-dark">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Ordre d'affichage</th>
        <th scope="col">Titre</th>
        <th scope="col">Date de création</th>
        <th scope="col">Dernière modification</th>
        <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php if (empty($banners)) { ?>
    <tr>
    <td scope="row" colspan="6">Aucun commentaire n'a encore été posté sur ce chapitre.</th>
    </tr>
    <?php }
          else {
            foreach($banners as $banner) { ?>
    <tr>
        <th scope="row"><?= $banner->id() ?></th>
        <td><?= $banner->displayOrder() ?></td>
        <td><?= $banner->title() ?></td>
        <td><?= $banner->creationDate() ?></td>
        <td><?= $banner->modificationDate() ?></td>
        <td>
          <a href="index.php?action=editBanner&amp;id=<?= $banner->id() ?>" class="m-1">
            <img src="https://img.icons8.com/plasticine/100/000000/edit.png">
          </a>
          <a data-toggle="modal" id="banner-<?=$banner->id()?>" data-action="delete" href="#deleteModal" class="m-1">
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