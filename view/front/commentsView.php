<?php if(isset($_SESSION['user'])) { ?>
    <hr>
    <form class="container p-4 bg-light" method="post" action="index.php?action=postComment" id="post-comment">
        <h5>Rédiger un nouveau commentaire</h5>
        <div class="form-group">
            <label for="comment-title">Titre</label>
            <input type="text" class="form-control" id="comment-title" name="comment-title" placeholder="Renseignez un court titre pour votre commentaire">
        </div>
        <div class="form-group">
        <label for="comment">Commentaire</label>
            <textarea class="form-text-area form-control" id="comment" name="comment"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" form="post-comment">Poster le commentaire</button>
    </form>
<?php } ?>

<div class="container p-4 bg-light">
<h5>Commentaires</h5>
 <?php  if (!isset($comments)) { ?>
    <div class="alert alert-light" role="alert">Aucun commentaire n'a encore été posté sur ce chapitre !</div>
<?php   }
        else {
            foreach($comments as $comment) {

            }
        } ?>
</div>