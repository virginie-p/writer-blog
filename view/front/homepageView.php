<?php ob_start(); ?>

<div class="bd-example">
  <div id="slider" class="carousel slide container" data-ride="carousel">
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
              <button type="button" class="btn btn-outline-light" data-toggle="modal" href="<?= $banner->buttonLink()?>"><?= $banner->buttonTitle() ?></button>
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
</div>

<?php $content = ob_get_clean(); ?>

<?php 
  require_once('menuView.php');
  require_once('templateFront.php'); 
?>
