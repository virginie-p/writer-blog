<?php ob_start(); ?>
<div style="background-image: url('public/images/chapters_images/<?=$chapter->image()?>'); background-size: 100%;">
    <div class="jumbotron jumbotron-fluid">
        <div class="container chapter-title">
            <h1 class="display-4"><?=$book->title()?></h1>
            <h3 class="lead"><?=$chapter->title()?></h3>
        </div>
    </div>
</div>
<div>
    <?=$chapter->content()?>
</div>


<?php $content = ob_get_clean(); ?>

<?php 
    require_once('menuView.php');
    require_once('templateFront.php'); 
?>