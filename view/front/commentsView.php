<?php if(isset($_SESSION['user'])) { ?>
    <hr>
    <form enctype="multipart/form-data" class="container p-4 bg-light" method="post" action="index.php?action=postComment&chapterId=<?=$chapter->id()?>" id="post-comment">
        <h5>Rédiger un nouveau commentaire</h5>
        <div class="messages">
            <?php if(isset($_GET['comment']) && $_GET['comment'] == 'create') { ?> 
                    <div class="alert alert-success" role="alert">Votre commentaire a bien été posté.</div> 
            <?php } 
                  elseif (!empty($errors)) { 
                    if (in_array('upload_problem', $errors)) { ?>
                        <div class="alert alert-danger" role="alert">La bannière n'a pas pu être créée en BDD.</div>
                <?php   } 
                        if (in_array('missing_fields', $errors)) { ?>
                            <div class="alert alert-danger" role="alert">Un ou plusieurs champs ne sont pas renseignés, tous les champs doivent être renseignés afin de procéder à la création de la bannière.</div>
                <?php   } 
                  } ?>
        </div>
        <div class="form-group">
            <label for="comment-title">Titre</label>
            <input type="text" class="form-control" id="comment-title" name="comment-title" placeholder="Renseignez un court titre pour votre commentaire">
        </div>
        <div class="form-group">
            <label for="comment">Commentaire</label>
            <textarea class="form-control" id="comment" name="comment"></textarea>
        </div>
        <button type="submit" class="btn btn-info" form="post-comment" id="post-comment-button">Poster le commentaire</button>
    </form>
<?php } ?>

<div class="container comment-zone p-4 bg-light">
<h5>Commentaires</h5>
 <?php if (empty($comments)) { ?>
    <div class="alert alert-light" role="alert">Aucun commentaire n'a encore été posté sur ce chapitre !</div>
<?php   }
        else {
            foreach($comments as $comment) { ?>
                <div class="media mt-3 p-3 bg-white comment-bubble">
                    <img src="public/images/profile_pictures/<?=$comment->profile_picture?>" class="mr-3 profile-picture align-middle" alt="Photo de profil de <?=$comment->username?>">
                    <div class="media-body">
                        <div class="row">
                            <p class="comment-username mt-0 mx-2"><?=$comment->username?></p>
                            <span class="font-weight-lighter font-italic">le <?=$comment->creationDate()?></span>
                        </div>
                        <p class="comment-title mb-1"><?=$comment->title()?></p>
                        <p class="mb-0"><?=$comment->content()?></p>
                    </div>
                </div>
    <?php    }
        } ?>
</div>