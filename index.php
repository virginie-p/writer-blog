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

    $action = $_GET['action'];
    
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2) {
        
            
            if (isset($action)) {
                if ($action == 'showBannersManagement') {
                    $controller_back->showBannersSection();
                }
                elseif ($action == 'createBanner') {
                    $controller_back->createBanner();
                }
                elseif ($action == 'editBanner'){
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $controller_back->editBanner($_GET['id']);
                    }
                }
                elseif($action == 'deleteBanner') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $controller_back->deleteBanner($_GET['id']);
                    }
                }
                elseif ($action == "showBooksManagement") {
                    $controller_back->showBooksSection();
                }
                elseif($action == 'disconnection') {
                    $controller_front->disconnectUser();
                }
                elseif ($action == 'createBook') {
                    $controller_back->createBook();
                }
                elseif ($action == 'editBook'){
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $controller_back->editBook($_GET['id']);
                    }
                }
                elseif ($action == 'showChaptersManagement') {
                    if (isset($_GET['bookId']) && $_GET['bookId'] > 0) {
                        $controller_back->showChaptersSection($_GET['bookId']);
                    }
                }
                elseif ($action == 'createChapter') {
                    if (isset($_GET['bookId']) && $_GET['bookId'] > 0){
                        $controller_back->createChapter($_GET['bookId']);
                    }
                }
                elseif ($action == 'editChapter'){
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $controller_back->editChapter($_GET['id']);
                    }
                }
            }
            else {
                $controller_back->showHomepageBack();
            }
        }
        
    }
    elseif (isset($action)) {
        if ($action == 'connection') {
            $controller_front->connectUser();
        }
    }
    else 
    {
        $controller_front->showHomepageFront();
    }
    
}
catch (Exception $e) {
    throw new Exception($e->getMessage());
}