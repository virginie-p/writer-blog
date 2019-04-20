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
    
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']->userType() == 1 || $_SESSION['user']->userType() == 2) {
            
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'showBannersManagement') {
                    $controller_back->showBannerSection();
                }
                elseif ($_GET['action'] == 'createBanner') {
                    $controller_back->createBanner();
                }
                elseif ($_GET['action'] == 'editBanner'){
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $controller_back->editBanner($_GET['id']);
                    }
                }
                elseif($_GET['action'] == 'deleteBanner') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $controller_back->deleteBanner($_GET['id']);
                    }
                }
                elseif($_GET['action'] == 'disconnection') {
                    $controller_front->disconnectUser();
                }
            }
            else {
                $controller_back->showHomepageBack();
            }
        }
        
    }
    elseif (isset($_GET['action'])) {
        if ($_GET['action'] == 'connection') {
            $controller_front->connectUser();
        }
    }
    else 
    {
        $controller_front->showHomepageFront();
    }
    
}
catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}