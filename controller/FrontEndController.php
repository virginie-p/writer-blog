<?php
namespace App\controller;

use App\model\BannerManager;
use App\model\BookManager;
use App\model\ChapterManager;
use App\model\UserManager;

class FrontEndController {
    public function showHomepageFront() {
        $banner_manager = new BannerManager();
        $banners = $banner_manager->getBanners();

        $chapter_manager = new ChapterManager();
        $latest_chapters = $chapter_manager->getLatestChapters();

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

    public function showBooksList() {
        $books_manager = new BookManager();
        $books = $books_manager->getBooks();

        require(__DIR__.'/../view/front/booksView.php');
    }

    public function showBookChapters($book_id) {
        $books_manager = new BookManager();
        $book = $books_manager->getBook($book_id);

        $chapter_manager = new ChapterManager();
        $chapters = $chapter_manager->getChapters($book_id);

        require(__DIR__.'/../view/front/chaptersView.php');
    }

    public function showChapter($id) {
        $chapter_manager = new ChapterManager();
        $chapter = $chapter_manager->getChapter($id);

        $book_manager = new BookManager();
        $book = $book_manager->getBook($chapter->bookId());

        require(__DIR__.'/../view/front/chapterView.php');
    }

    public function createUser() {
        $user_manager = new UserManager(); 
        
        if (isset($_POST) && !empty($_POST)){
            $errors = [];

            if (isset(
                $_POST['subscribe-username'],
                $_POST['subscribe-password'],
                $_POST['password-confirmation'],
                $_POST['email'],
                $_POST['lastname'],
                $_POST['firstname'],
                $_FILES['profile-picture']
            )) {
                if (!empty($_POST['subscribe-username']) 
                && !empty($_POST['subscribe-password']) 
                && !empty($_POST['password-confirmation']) 
                && !empty($_POST['email']) 
                && !empty($_POST['lastname']) 
                && !empty($_POST['firstname']) 
                && !empty($_FILES['profile-picture']['name'])) {
                    
                }
            }
        }

    }

}