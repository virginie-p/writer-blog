<?php
namespace App\controller;

use App\model\BannerManager;
use App\model\UserManager;

class FrontEndController {
    public function showHomepageFront() {
        $banner_manager = new BannerManager();
        $banners = $banner_manager->getBanners();

        require(__DIR__.'/../view/front/homepageView.php');
    }

    public function connectUser() {
        $user_manager = new UserManager();
        $user = $user_manager->getUser($_POST['username']);

        if ($user != false) {
            if (!password_verify($_POST['password'], $user->password())){
                throw new \Exception('Aucun couple utilisateur/mot de passe connu sur le serveur');
            }
            else {
                $_SESSION['user'] = $user;
                header('Location: index.php');
                exit;
            }
        } else {
            throw new \Exception('Aucun couple utilisateur/mot de passe connu sur le serveur');
        }

    }

    public function disconnectUser() {
        $_SESSION = [];
        session_destroy();
        header('Location: index.php');
        exit;
    }
}