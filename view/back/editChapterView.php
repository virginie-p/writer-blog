<?php ob_start(); ?>
<?php if (isset($chapter)) { ?>
<h3 class="mt-2 mb-4 text-center">Edition du chapitre  :<br/>"<?=$chapter->title()?>"</h3>
<?php } ?>

<?php if (!empty($errors)) { 
        if (in_array('upload_problem', $errors)) { ?>
            <div class="alert alert-danger" role="alert">Le chapitre n'a pas pu être modifié en BDD.</div>
    <?php   } 
            if (in_array('missing_fields', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Un ou plusieurs champs ne sont pas renseignés, tous les champs doivent être renseignés afin de modifier le chapitre.</div>
    <?php   } 
            if (in_array('image_or_size_invalid', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Votre image dépasse la taille maximum autorisée par le serveur (2Mo)</div>
    <?php   } 
            if (in_array('no_book_id', $errors)) { ?>    
                <div class="alert alert-danger" role="alert">Aucun numéro de chapitre renseigné pour l'édition.</div>
    <?php   }
        } 
        elseif (isset($chapter_edit_succeed)) { ?>
            <div class="alert alert-success" role="alert">Le chapitre a bien été mise à jour.</div>
<?php   } ?>

<?php if (isset($chapter)) { ?>
<form class="mx-4" action="index.php?action=editChapter&id=<?=$chapter->id()?>" method="post" id="edit-chapter" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col">
            <label for="title">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="<?=$chapter->title()?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col">
            <label for="content">Contenu</label>
            <textarea class="form-text-area form-control" id="content" name="content"><?=$chapter->content()?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="chapter-image">Sélectionnez l'image décorative du chapitre</label>
        <input type="file" class="form-control-file" name="chapter-image" aria-describedby="select-image-help">
        <small id="select-image-help" class="form-text text-muted">Votre image ne doit pas dépasser 2 Mo et doit respecter le ratio 1250*350px.</small>
        <?php   if (!empty($errors)) { 
                    if (in_array('invalid_extension', $errors)) { ?>
                        <div class="alert alert-danger" role="alert">Ce type de fichier n'est pas accepté. Seuls les fichiers .jpeg, .jpg et .png sont acceptés.</div>
            <?php   }
                    if(in_array('file_not_moved', $errors)) { ?>
                        <div class="alert alert-danger" role="alert">Le fichier n'a pas pu être enregistré sur le serveur. Merci de bien vouloir réessayer.</div>
            <?php   } 
                } ?>
    </div>

  <button type="submit" class="btn btn-primary mb-2" form="edit-chapter">Modifier le chapitre</button>
</form>
<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require_once('templateBack.php') ?>