<?php if(isset($_SESSION['user'])) { ?>
    <hr>
    <form enctype="multipart/form-data" class="container p-4 mx-auto bg-light" method="post" action="index.php?action=postComment&id=<?=$chapter->id()?>" id="post-comment">
        <h5>Rédiger un nouveau commentaire</h5>
        <div class="messages">
            <?php if(isset($_GET['comment']) && $_GET['comment'] == 'create') { ?> 
                    <div class="alert alert-success" role="alert">Votre commentaire a bien été posté.</div> 
            <?php } 
                  elseif (!empty($errors)) { 
                    if (in_array('upload_problem', $errors)) { ?>
                        <div class="alert alert-danger" role="alert">Le commentaire n'a pas pu être créé en BDD.</div>
                <?php   } 
                    if (in_array('missing_fields', $errors)) { ?>
                        <div class="alert alert-danger" role="alert">Un ou plusieurs champs ne sont pas renseignés, tous les champs doivent être renseignés afin de procéder à la création du commentaire.</div>
                <?php   } 
                    if (in_array('no_chapter_id', $errors)) { ?>
                        <div class="alert alert-danger" role="alert">Aucun numéro de chapitre renseigné pour la création du commentaire.</div>
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

<div class="container comment-zone p-4 mx-auto bg-light">
<h5>Commentaires</h5>
<div id="report-message"></div>
<?php if (empty($comments)) { ?>
    <div class="alert alert-light" role="alert">Aucun commentaire n'a encore été posté sur ce chapitre !</div>
<?php   }
        else {
            foreach($comments as $comment) { ?>
                <div class="media mt-3 p-3 bg-white comment-bubble">
                    <img src="public/images/profile_pictures/<?=$comment->profile_picture?>" class="mr-3 profile-picture align-middle" alt="Photo de profil de <?=htmlspecialchars($comment->username)?>">
                    <div class="media-body">
                        <div class="row">
                            <p class="comment-username mt-0 mx-2"><?=htmlspecialchars($comment->username)?></p>
                            <span class="font-weight-lighter font-italic">le <?=$comment->creationDate()?></span>
                            <?php if (isset($_SESSION['user'])) {?>
                            <a class="comment-report ml-lg-auto mt-n3" 
                            <?php if ($comment->moderationStatus() == 0) {?> href="index.php?action=reportComment&id=<?=$comment->id()?>" <?php } ?> >
                                <img class="report-image <?php if($comment->moderationStatus() == 2){ ?>m-2<?php } if ($comment->moderationStatus() == 1) {?>report-disabled<?php } ?>"
                            src="<?php if($comment->moderationStatus() == 2){ ?> https://img.icons8.com/color/35/000000/ok.png <?php } else { ?> https://img.icons8.com/color/48/000000/error.png <?php } ?>"
                                <?php if ($comment->moderationStatus() == 1) {?> title="Ce commentaire est en cours de modération" <?php } elseif($comment->moderationStatus() == 2){ ?> title="Ce commentaire a été validé par un modérateur" <?php } ?>>
                            
                            </a>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <p class="comment-title p-0 col-12 mt-0 mx-2 mb-1"><?=$comment->title()?></p>
                            <p class="col-12 p-0 mt-0 mx-2 mb-0"><?=$comment->content()?></p>
                        </div>
                    </div>
                </div>
    <?php    }
        } ?>
</div>