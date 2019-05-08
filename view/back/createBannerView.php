<?php ob_start(); ?>

<h3 class="mt-2 mb-4 text-center">Création d'une nouvelle bannière</h3>

<?php   if (!empty($errors)) { 
        if (in_array('upload_problem', $errors)) { ?>
            <div class="alert alert-danger" role="alert">La bannière n'a pas pu être créée en BDD.</div>
    <?php   } 
            if (in_array('missing_fields', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Un ou plusieurs champs ne sont pas renseignés, tous les champs doivent être renseignés afin de procéder à la création de la bannière.</div>
    <?php   } 
            if (in_array('image_or_size_invalid', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Votre image dépasse la taille maximum autorisée par le serveur (2Mo) ou vous n'avez pas sélectionné d'image.</div>
    <?php   } 
            if (in_array('just_spaces', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Un ou plusieurs champs n'est constitué que d'espaces, merci de bien vouloir renseigner correctement le formulaire.</div>
    <?php   }
        } ?>

<form class="mx-4" action="index.php?action=createBanner" method="post" id="create-banner" enctype="multipart/form-data">
    <div class="form-group">
        <label for="display-order">Ordre d'affichage de la bannière</label>
        <input type="number" class="form-control" id="display-order" aria-describedby="display-order-help" name="display-order" value="<?php if (isset($_POST['display-order'])) { echo $_POST['display-order']; }?>">
        <small id="display-order-help" class="form-text text-muted">Il s'agit de l'ordre d'affichage par rapport aux autres bannières, merci de consulter le numéro indiqué pour ces dernières</small>
    </div>
    <div class="row">
        <div class="form-group col">
            <label for="title">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php if (isset($_POST['title'])) { echo $_POST['title']; }?>">
        </div>
        <div class="form-group col">
            <label for="caption">Légende</label>
            <input type="text" class="form-control" id="caption" name="caption" value="<?php if (isset($_POST['caption'])) { echo $_POST['caption']; }?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col">
            <label for="button-title">Intitulé du bouton</label>
            <input type="text" class="form-control" id="button-title" name="button-title" value="<?php if (isset($_POST['button-title'])) { echo $_POST['button-title']; }?>">
        </div>
        <div class="form-group col">
            <label for="button-link">Lien du bouton</label>
            <input type="text" class="form-control" id="button-link" name="button-link" value="<?php if (isset($_POST['button-link'])) { echo $_POST['button-link']; }?>">
        </div>
    </div>
    <div class="form-group">
        <label for="banner-image">Sélectionnez l'image de la bannière</label>
        <input type="file" class="form-control-file" name="banner-image" aria-describedby="select-image-help">
        <small id="select-image-help" class="form-text text-muted">Votre image ne doit pas dépasser 2 Mo et doit respecter le ratio 1280*650px.</small>
        <?php   if (!empty($errors)) { 
                    if (in_array('invalid_extension', $errors)) { ?>
                        <div class="alert alert-danger" role="alert">Ce type de fichier n'est pas accepté. Seuls les fichiers .jpeg, .jpg et .png sont acceptés.</div>
            <?php   }
                    if(in_array('file_not_moved', $errors)) { ?>
                        <div class="alert alert-danger" role="alert">Le fichier n'a pas pu être enregistré sur le serveur. Merci de bien vouloir réessayer.</div>
            <?php   } 
                } ?>
    </div>

  <button type="submit" class="btn btn-primary mb-2" form="create-banner">Créer la bannière</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require_once('templateBack.php') ?>