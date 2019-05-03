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
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller_front->showBookChapters($_GET['id']);
            }
        }
        elseif ($_GET['action'] == 'showChapter') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller_front->showChapter($_GET['id']);
            }
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
            if(isset($_SESSION['user']) && $_SESSION['user'] == 3) {
                if (isset($_GET['chapterId']) && $_GET['chapterId'] > 0) {
                    $controller_front->postComment($_GET['chapterId']);
                }
            }
        }
        elseif ($_GET['action'] == 'reportComment') {
            if(isset($_SESSION['user']) && $_SESSION['user'] == 3) {
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
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $controller_back->editBanner($_GET['id']);
                }
            }
        }
        elseif($_GET['action'] == 'deleteBanner') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $controller_back->deleteBanner($_GET['id']);
                }
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
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $controller_back->editBook($_GET['id']);
                }
            }
        }
        elseif ($_GET['action'] == 'showChaptersManagement') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                if (isset($_GET['bookId']) && $_GET['bookId'] > 0) {
                    $controller_back->showChaptersSection($_GET['bookId']);
                }
            }
        }
        elseif ($_GET['action'] == 'createChapter') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                if (isset($_GET['bookId']) && $_GET['bookId'] > 0){
                    $controller_back->createChapter($_GET['bookId']);
                }
            }
        }
        elseif ($_GET['action'] == 'editChapter'){
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $controller_back->editChapter($_GET['id']);
                }
            }
        }
        elseif ($_GET['action'] == 'showUsersManagement') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                $controller_back->showUsersSection();
            }
        }
        elseif ($_GET['action'] == 'displayUser') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $controller_back->displayUser($_GET['id']);
                }
            }
        }
        elseif ($_GET['action'] == 'deleteUser') {
            if (isset($_SESSION['user']) && ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2)) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $controller_back->deleteUser($_GET['id']);
                }
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