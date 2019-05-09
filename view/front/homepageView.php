<?php ob_start(); ?>
<div id="slider" class="carousel slide container p-0" data-ride="carousel">
  <ol class="carousel-indicators">
    <?php 
      for($i=0; count($banners) > $i; $i++) 
      {
        echo '<li data-target="#slider" data-slide-to="' . $i . '"</li>';
      } 
    ?>
  </ol>
  <div class="carousel-inner">
    <?php foreach($banners as $banner) : ?>
      <div class="carousel-item <?php if ($banner->displayOrder() == 1) { echo 'active'; }?>">
        <img src="public\images\banners\<?= $banner->image(); ?>" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5><?= $banner->title() ?></h5>
          <p><?= $banner->caption()?> </p>
          <?php if(!empty($banner->buttonTitle())) : ?>
            <a class="btn btn-outline-light" href="<?= $banner->buttonLink()?>"><?=$banner->buttonTitle()?></a>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div id="latest-chapters" class="container">
  <h2 class="row justify-content-center text-center mt-4">Les derniers chapitres postés</h2>
  <div class="row justify-content-center">
    <?php foreach($latest_chapters as $latest_chapter) { ?>
      <div class="card m-3" style="width: 20.5rem; height:20.5rem">
        <img src="public/images/chapters_images/<?=$latest_chapter->image()?>" class="card-img-top" alt="Image du chapitre intitulé <?=$latest_chapter->title()?>">
        <div class="card-body">
          <h4><?=$latest_chapter->book_title?></h4>
          <h5 class="card-title"><?=$latest_chapter->title()?></h5>
          <p class="card-text"><?=strip_tags(substr($latest_chapter->content(), 0, 200)); ?></p>
          <a href="index.php?action=showChapter&id=<?=$latest_chapter->id()?>" class="btn btn-primary">Lire la suite</a>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php 
  require_once('menuView.php');
  require_once('templateFront.php'); 
?>
