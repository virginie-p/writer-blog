<?php ob_start(); ?>

<div id="books-list container-fluid">
    <h2 class="row justify-content-center mx-0 mt-4 mb-5">Les livres disponibles</h2>
    <div class="row mx-0 justify-content-center">
    <?php foreach($books as $book) { ?>
        <div class="col-3 text-center">
            <a href="index.php?action=showBookChapters&id=<?=$book->id()?>">
                <img class="books-covers mb-2" src="public/images/books_covers/<?=$book->bookCoverImage()?>" class="mr-3" alt="Couverture du livre <?=$book->title()?>">
                <div>
                    <h5 class="mt-0"><?=$book->title()?></h5>
                    <?=$book->subtitle()?>
                </div>
            </a>
        </div>
    <?php } ?>
    </div>
</div>



<?php $content = ob_get_clean(); ?>

<?php 
    require_once('menuView.php');
    require_once('templateFront.php'); 
?>