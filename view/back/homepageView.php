<?php ob_start(); ?>
   
        <div class=" categories row justify-content-around mt-3 ">
            <a href="index.php?action=showBannersManagement" class="banners col-md-3 border text-center">
                <img src="https://img.icons8.com/clouds/100/000000/picture.png">
                <h2>Bannières</h2>                        
            </a>
            <a href="index.php?action=showBooksManagement" class="books col-md-3 border text-center">
                <img src="https://img.icons8.com/clouds/100/000000/literature.png">
                <h2>Livres</h2>
            </a>
            <a href="index.php?action=showUsersManagement" class="users col-md-3 border text-center">
                <img src="https://img.icons8.com/clouds/100/000000/groups.png">
                <h2>Utilisateurs</h2>
            </a>
        </div>

<?php $content = ob_get_clean(); ?>

<?php 
  require_once('templateBack.php'); 
?>
