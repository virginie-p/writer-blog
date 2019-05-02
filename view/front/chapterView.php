<?php ob_start(); ?>
<div id="chapter-id" hidden><?=$chapter->id()?></div>
<div style="background-image: url('public/images/chapters_images/<?=$chapter->image()?>'); background-size: cover;">
    <div class="jumbotron jumbotron-fluid">
        <div class="container chapter-title">
            <h1 class="display-4"><?=$book->title()?></h1>
            <h3 class="lead"><?=$chapter->title()?></h3>
        </div>
    </div>
</div>
<div class="container">
    <?=$chapter->content()?>
</div>

<?php require_once('commentsView.php') ?>


<?php $content = ob_get_clean(); ?>

<?php 
    require_once('menuView.php');
    require_once('templateFront.php'); 
?>