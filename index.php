<?php
require_once('Autoloader.php');

use App\Autoloader;
use App\controller\FrontEndController;
use App\controller\BackEndController;

Autoloader::register();

session_start();

try {
    $controller_front = new FrontEndController();
    $controller_back = new BackEndController();

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'connection') {
            $controller_front->connectUser();
        } 
        elseif ($_GET['action'] == 'showBooksList') {
            $controller_front->showBooksList();
        }
        elseif ($_GET['action'] == 'showBookChapters') {
            $controller_front->showBookChapters();
        }
        elseif ($_GET['action'] == 'showChapter') {
            $controller_front->showChapter();
        }
        elseif ($_GET['action'] == 'subscribe') {
            $controller_front->createUser();
        }
        elseif($_GET['action'] == 'disconnection') {
            if(isset($_SESSION['user'])) {
            $controller_front->disconnectUser();
            }
        }
        elseif ($_GET['action'] == 'postComment') {
            if(isset($_SESSION['user']) && $_SESSION['user']->userType() == 3) {
                $controller_front->postComment();
            }
        }
        elseif ($_GET['action'] == 'reportComment') {
            if(isset($_SESSION['user']) && $_SESSION['user']->userType() == 3) {
                $controller_front->reportComment();
            }
        }
        elseif ($_GET['action'] == 'showBannersManagement') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->showBannersSection();
            }
        }
        elseif ($_GET['action'] == 'createBanner') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->createBanner();
            }
        }
        elseif ($_GET['action'] == 'editBanner'){
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->editBanner();
            }
        }
        elseif($_GET['action'] == 'deleteBanner') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->deleteBanner();
            }
        }
        elseif ($_GET['action'] == "showBooksManagement") {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->showBooksSection();
            }
        }
        elseif ($_GET['action'] == 'createBook') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
            $controller_back->createBook();
            }
        }
        elseif ($_GET['action'] == 'editBook'){
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->editBook();
            }
        }
        elseif($_GET['action'] == 'deleteBook') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->deleteBook();
            }
        }
        elseif ($_GET['action'] == 'showChaptersManagement') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                    $controller_back->showChaptersSection();
            }
        }
        elseif ($_GET['action'] == 'createChapter') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->createChapter();
            }
        }
        elseif ($_GET['action'] == 'editChapter'){
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->editChapter();
            }
        }
        elseif ($_GET['action'] == 'showUsersManagement') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->showUsersSection();
            }
        }
        elseif ($_GET['action'] == 'displayUser') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->displayUser();
            }
        }
        elseif ($_GET['action'] == 'deleteUser') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->deleteUser();
            }
        }
        elseif ($_GET['action'] == 'showCommentsManagement') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->showComments();
            }
        }
        elseif ($_GET['action'] == 'displayComment') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->displayComment();
            }
        }
        elseif ($_GET['action'] == 'deleteComment') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->deleteComment();
            }
        }
        elseif ($_GET['action'] == 'validateComment') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->validateComment();
            }
        }
        else {
            $controller_front->showError404();
        }
    }
    elseif (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
        $controller_back->showHomepageBack();
    }
    else 
    {
        $controller_front->showHomepageFront();
    }
     
}
catch (Exception $e) {
    throw new Exception($e->getMessage());
}