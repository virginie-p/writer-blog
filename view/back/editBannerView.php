<?php ob_start(); ?>

<?php if(isset($banner)) { ?>
<h3 class="mt-2 mb-4 text-center">Modification de la bannière n°<?= $banner->id() ?></h3>
<?php } ?>

<?php  if (!empty($errors)) { 
            if (in_array('missing_fields', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Un des champs textuel n'est pas renseigné, tous les champs doivent être renseignés afin de procéder à la modification de la bannière.</div>
    <?php   } 
            elseif (in_array('image_or_size_invalid', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Votre image dépasse la taille maximum autorisée par le serveur (2Mo).</div>
    <?php   } 
            elseif (in_array('no_banner_id', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Aucun numéro de bannière renseigné pour la modification de la bannière.</div>
    <?php   }
            elseif (in_array('image_or_size_invalid', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Un problème est survenu lors de la modification de la bannière en BDD. Merci de bien vouloir réessayer.</div>
    <?php   } 
            elseif (in_array('just_spaces', $errors)) { ?>
                <div class="alert alert-danger" role="alert">Un ou plusieurs champs n'est constitué que d'espaces, merci de bien vouloir renseigner correctement le formulaire.</div>
    <?php   }
        }
        elseif (isset($banner_edit_succeed)) { ?>
            <div class="alert alert-success" role="alert">La bannière a bien été mise à jour.</div>
<?php   } ?>

<?php if(isset($banner)) { ?>
<form class="mx-4" action="index.php?action=editBanner&amp;id=<?=$banner->id()?>" method="post" id="edit-banner" enctype="multipart/form-data">
    <div class="form-group">
        <label for="displayOrder">Ordre d'affichage de la bannière</label>
        <input type="number" class="form-control" id="displayOrder" aria-describedby="displayOrderHelp" name="display-order" value="<?=$banner->displayOrder()?>">
        <small id="displayOrderHelp" class="form-text text-muted">Il s'agit de l'ordre d'affichage par rapport aux autres bannières, merci de consulter le numéro indiqué pour ces dernières</small>
    </div>
    <div class="row">
        <div class="form-group col">
            <label for="title">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $banner->title() ?>">
        </div>
        <div class="form-group col">
            <label for="caption">Légende</label>
            <input type="text" class="form-control" id="caption" name="caption" value="<?= $banner->caption() ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col">
            <label for="button-title">Intitulé du bouton</label>
            <input type="text" class="form-control" id="button-title" name="button-title" value="<?= $banner->buttonTitle() ?>">
        </div>
        <div class="form-group col">
            <label for="button-link">Lien du bouton</label>
            <input type="text" class="form-control" id="button-link" name="button-link" value="<?= $banner->buttonLink() ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="banner-image">Sélectionnez l'image de la bannière</label>
        <input type="file" class="form-control-file" name="banner-image" aria-describedby="selectImageHelp">
        <small id="selectImageHelp" class="form-text text-muted">Votre image ne doit pas dépasser 2 Mo et doit respecter le ratio 1280*650px.</small>
        <?php   if (!empty($upload_errors)) { 
                    if (in_array('invalid_extension', $upload_errors)) { ?>
                    <div class="alert alert-danger" role="alert">Ce type de fichier n'est pas accepté. Seuls les fichiers .jpeg, .jpg et .png sont acceptés.</div>

        <?php       } 
                    elseif (in_array('invalid_name', $upload_errors)) { ?>
                    <div class="alert alert-danger" role="alert">Merci de renommer votre fichier, un fichier portant le même nom existe déjà en base.</div>
            <?php   }
                }    ?>
    </div>

  <button type="submit" class="btn btn-primary" form="edit-banner">Modifier la bannière</button>
</form>

<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require_once('templateBack.php') ?>