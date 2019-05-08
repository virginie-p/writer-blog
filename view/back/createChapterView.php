<?php ob_start(); ?>
<?php if (isset($book)) { ?>
<h3 class="mt-2 mb-4 text-center">Création d'un nouveau chapitre pour le livre :<br/>"<?=$book->title()?>"</h3>
<?php } ?>

<?php if (!empty($errors)) { 
        if (in_array('upload_problem', $errors)) { ?>
            <div class="alert alert-danger" role="alert">Le chapitre n'a pas pu être créé en BDD.</div>
    <?php   } 
            if (in_array('missing_fields', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Un ou plusieurs champs ne sont pas renseignés, tous les champs doivent être renseignés afin de procéder à la création du chapitre.</div>
    <?php   } 
            if (in_array('image_or_size_invalid', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Votre image dépasse la taille maximum autorisée par le serveur (2Mo)</div>
    <?php   } 
            if (in_array('no_book_id', $errors)) { ?>    
                <div class="alert alert-danger" role="alert">Aucun numéro de livre renseigné pour la création du chapitre</div>
    <?php   } 
            if (in_array('just_spaces', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Un ou plusieurs champs n'est constitué que d'espaces, merci de bien vouloir renseigner correctement le formulaire.</div>
    <?php   }
        } ?>

<?php if (isset($book)) { ?>
<form class="mx-4" action="index.php?action=createChapter&bookId=<?=$book->id()?>" method="post" id="create-chapter" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col">
            <label for="title">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php if (isset($_POST['title'])) { echo $_POST['title']; }?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col">
            <label for="content">Contenu</label>
            <textarea class="form-text-area form-control" id="content" name="content"><?php if (isset($_POST['content'])) { echo $_POST['content']; }?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="chapter-image">Sélectionnez l'image décorative du chapitre</label>
        <input type="file" class="form-control-file" name="chapter-image" aria-describedby="select-image-help">
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

  <button type="submit" class="btn btn-primary mb-2" form="create-chapter">Créer le chapitre</button>
</form>
<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require_once('templateBack.php') ?>