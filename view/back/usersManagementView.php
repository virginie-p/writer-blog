<?php ob_start(); ?>
<h3 class="mt-2 mb-4 text-center">Gestion des Membres</h3>

<?php if (isset($_GET['user'])) {
        if ($_GET['user'] == 'delete') { ?>
        <div class="alert alert-success" role="alert">L'utilisateur a bien été supprimé.</div>
  <?php }
      } ?>
<?php if (isset($errors))  { 
          if (in_array('no_user_id', $errors)) { ?>
            <div class="alert alert-danger" role="alert">Aucun numéro d'utilisateur renseigné pour la suppression.</div>
    <?php }
          if (in_array('wrong_user_id', $errors)) { ?>
            <div class="alert alert-danger" role="alert">Mauvais numéro d'utilisateur renseigné pour la suppression.</div>
    <?php }
        } ?>

<div class="table-responsive m-2">
<table class="table table-bordered table-hover table-sm text-center">
  <thead class="thead-dark">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Pseudo</th>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Email</th>
        <th scope="col">Date d'inscription</th>
        <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users as $user) { ?>
    <tr class="justify-content-center">
        <th scope="row"><?= $user->id() ?></th>
        <td><?= $user->username() ?></td>
        <td><?= $user->lastname() ?></td>
        <td><?= $user->firstname()?></td>
        <td><?= $user->email() ?></td>
        <td><?= $user->creationDate() ?></td>
        <td>
            <a href="index.php?action=displayUser&amp;id=<?= $user->id() ?>">
                <img src="https://img.icons8.com/plasticine/100/000000/search-more.png">
            </a>
            <a data-toggle="modal" id="user-<?=$user->id()?>" data-action="delete" href="#deleteModal">
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