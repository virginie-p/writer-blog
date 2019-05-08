<?php ob_start(); ?>

<?php if(isset($book)) { ?>
<h3 class="mt-2 mb-4 text-center">Modification du livre intitulé <?=$book->title()?></h3>
<?php } ?>

<?php   if (!empty($errors)) { 
        if (in_array('upload_problem', $errors)) { ?>
            <div class="alert alert-danger" role="alert">Le livre n'a pas pu être créé en BDD.</div>
    <?php   } 
            if (in_array('missing_fields', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Un ou plusieurs champs ne sont pas renseignés, tous les champs textuels doivent être renseignés afin de procéder à la modification du livre.</div>
    <?php   } 
            if (in_array('image_or_size_invalid', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Votre image dépasse la taille maximum autorisée par le serveur (2Mo) ou vous n'avez pas sélectionné d'image</div>
    <?php   }
            if (in_array('no_book_id', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Aucun numéro de livre renseigné pour l'édition.</div>
    <?php   } 
            if (in_array('just_spaces', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Un ou plusieurs champs n'est constitué que d'espaces, merci de bien vouloir renseigner correctement le formulaire.</div>
    <?php   }
        } 
        elseif (isset($book_edit_succeed)) { ?>
            <div class="alert alert-success" role="alert">Le livre a bien été mise à jour.</div>
<?php   } ?>

<?php if(isset($book)) { ?>
<form class="mx-4" action="index.php?action=editBook&amp;id=<?=$book->id()?>" method="post" id="edit-book" enctype="multipart/form-data">
    <div class="form-group">
        <label for="author">Auteur</label>
        <select name="author" id="author" class="form-control form-control-sm">
        <?php foreach($authors as $author) {?>
            <option <?php if ($author->id() == $book->authorId()) {?> selected="selected" <?php } ?> value="<?=$author->id()?>"><?=$author->firstname().' '.$author->lastname()?></option>
        <?php } ?>
        </select>
    </div>
    <div class="row">
        <div class="form-group col">
            <label for="title">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $book->title() ?>">
        </div>
        <div class="form-group col">
            <label for="subtitle">Sous-titre</label>
            <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?= $book->subtitle() ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="book-cover-image">Sélectionnez l'image de couverture du livre</label>
        <input type="file" class="form-control-file" name="book-cover-image" aria-describedby="select-image-help">
        <small id="select-image-help" class="form-text text-muted">Votre image ne doit pas dépasser 2 Mo et doit respecter le ratio 595*842px.</small>
        <?php   if (!empty($errors)) { 
                    if (in_array('invalid_extension', $errors)) { ?>
                        <div class="alert alert-danger" role="alert">Ce type de fichier n'est pas accepté. Seuls les fichiers .jpeg, .jpg et .png sont acceptés.</div>
            <?php   }
                    if(in_array('file_not_moved', $errors)) { ?>
                        <div class="alert alert-danger" role="alert">Le fichier n'a pas pu être enregistré sur le serveur. Merci de bien vouloir réessayer.</div>
            <?php   } 
                } ?>
    </div>

  <button type="submit" class="btn btn-primary mb-2" form="edit-book">Modifier le livre</button>
</form>
<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require_once('templateBack.php') ?>