<?php ob_start(); ?>
<h2 class="row justify-content-center mx-0 mt-4 mb-1"><?=$book->title()?></h2>
<h3 class="book-chapter-category row justify-content-center mx-0 mb-5">Chapitres</h3>
<ul class="list-unstyled">
 <?php foreach($chapters as $chapter) { ?>
  <li class="media mb-3 row bg-light">
    <img src="public/images/chapters_images/<?=$chapter->image()?>" class="chapters-images mr-3" alt="Image du chapitre intitulé <?=$chapter->title()?>">
    <div class="media-body">
      <h5 class="mt-1 mb-1"><?=$chapter->title()?></h5>
      <p class="mb-2"><?=strip_tags(substr($chapter->content(), 0, 200)); ?></p>
      <a href="index.php?action=showChapter&id=<?=$chapter->id()?>" class="btn btn-info btn-sm">Lire la suite</a>
    </div>
  </li>
 <?php } ?>
</ul>

<?php $content = ob_get_clean(); ?>

<?php 
    require_once('menuView.php');
    require_once('templateFront.php'); 
?>