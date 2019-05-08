<?php
namespace App\controller;

use App\model\BannerManager;
use App\model\UserManager;
use App\model\BookManager;
use App\model\ChapterManager;
use App\model\CommentManager;
use App\entity\User;
use App\entity\Banner;
use App\entity\Book;
use App\entity\Chapter;
use App\entity\Comment;

require_once(__DIR__.'/../configuration.php');

class FrontEndController extends Controller {
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
                echo json_encode([
                    'status' => 'error'
                ]);
            }
            else {
                $_SESSION['user'] = $user;
                echo json_encode([
                    'status' => 'success'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error'
            ]);
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

    public function showBookChapters() {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $book_manager = new BookManager();
            $book = $book_manager->getBook($_GET['id']);

            $chapter_manager = new ChapterManager();
            $chapters = $chapter_manager->getChapters($_GET['id']);

            if(!$book){
                $error = 'wrong_book_id';
            }
        }
        else {
            $error = "no_book_id";
        }
        require(__DIR__.'/../view/front/chaptersView.php');
    }

    public function showChapter($errors = NULL) {

        if (isset($_GET['id']) && $_GET['id'] > 0) {

            $chapter_manager = new ChapterManager();
            $chapter = $chapter_manager->getChapter($_GET['id']);

            $comment_manager = new CommentManager();
            $comments = $comment_manager->getComments($_GET['id']);

            if (!$chapter) {
                $error = 'wrong_chapter_id';
            }
        }
        else {
            $error = "no_chapter_id";
        }

        require(__DIR__.'/../view/front/chapterView.php');
    }

    public function createUser() {
        $user_data = [];
        $errors = [];

        if (!empty($_POST['subscribe-username']) && !empty($_POST['subscribe-password']) && !empty($_POST['password-confirmation']) 
            && !empty($_POST['email']) && !empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_FILES['profile-picture']['name'])) {
            $user_manager = new UserManager();
            $users = $user_manager->getMembers();

            foreach($users as $user) {
                if ($user->username() == $_POST['subscribe-username']) {
                    $errors[] = 'username_already_used';
                }
            }

            if (!preg_match('#[0-9A-Za-z.-]{6,}#', $_POST['subscribe-username'])){
                $errors[] = 'username_not_matching_regex' ;
            }

            if ($_POST['subscribe-password'] != $_POST['password-confirmation']) {
                $errors[] = 'passwords_not_identical' ;
            }

            if (!preg_match('#^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{7,})\S$#', $_POST['subscribe-password'])) {
                $errors[] = 'password_not_matching_regex';
            }

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'email_invalid';
            }

            if(preg_match('#^[[:blank:]\n]+$#', $_POST['lastname']) || preg_match('#^[[:blank:]\n]+$#', $_POST['firstname'])) {
                $errors[] = 'just_spaces';
            }

            $user_data = array(
                'user_type' => 3,
                'username' => $_POST['subscribe-username'],
                'password' => password_hash($_POST['subscribe-password'], PASSWORD_DEFAULT),
                'email' => $_POST['email'],
                'lastname' => htmlspecialchars($_POST['lastname']),
                'firstname' => htmlspecialchars($_POST['firstname'])
            );

            $image_input_name = 'profile-picture';
                        
            if($_FILES[$image_input_name]['error'] != 0) {
                $errors[] = 'image_or_size_invalid';
            }

            if (empty($errors)) { 
                $upload_data = $this->createImageInFolder($image_input_name, profile_picture_width, profile_picture_height, profile_picture_folder);

                $upload_errors = $upload_data[0];

                if (!empty($upload_data[1])) {
                
                    $image_name = $upload_data[1];

                    $user_data['profile_picture'] = $image_name;

                    $new_user = new User($user_data);
                    $affected_lines = $user_manager->createUser($new_user);

                    if (!$affected_lines) {
                        $errors[] = 'upload_problem';
                    } else {
                        $headers  = 'From: "Virginie PEREIRA" <contact@virginie-pereira.fr>' . "\r\n" .
                                    'Reply-To: "Virginie PEREIRA" <contact@virginie-pereira.fr>' . "\r\n" .
                                    'MIME-Version: 1.0' . "\r\n" .
                                    'Content-type: text/html;  charset=utf-8'. "\r\n" .
                                    'X-Mailer: PHP/' . phpversion();

                        $message =  '<html><body>'. "\r\n" .
                                    '<img src="https://virginie-pereira.fr/projet-4/public/images/logo.png" style="width:80px;height:80px"><span style="font-weight:bold">Evasion Littéraire</span>'. "\r\n" .
                                    '<p> Bonjour ' . $new_user->firstname() . ' !</p>'."\r\n" .
                                    '<p> Vous êtes bien inscrit sur Evasion Littéraire ! </p>'."\r\n" .
                                    '<p> N\'hésitez pas à vous connecter très souvent sur le site pour'."\r\n" .
                                    ' pouvoir profiter des nouveaux chapitres mis en ligne ! :) </p>'."\r\n" .
                                    '<p> A très bientôt ! </p>' ."\r\n" .
                                    '</body></html>';

                        mail($new_user->email(), 'Votre inscription à Evasion littéraire', $message, $headers);
                        echo json_encode([
                            'status' => 'success'
                        ]);
                    }
                }
            }
        }
        else {
            $errors[] = 'missing_fields';
        }

        if (!empty($errors)) {
            $data['status'] = 'error';
            $data['errors'] = $errors;
            echo json_encode($data);
        }
        
    }
    public function postComment() {
        $comment_data = [];
        $errors = [];

        if (isset($_GET['id']) && $_GET['id'] > 0) {

            if (!empty($_POST['comment-title']) && !empty($_POST['comment'])){
            
                $comment_data = array(
                    'title' => htmlspecialchars($_POST['comment-title']),
                    'content' => htmlspecialchars($_POST['comment']),
                    'chapter_id' => $_GET['id'],
                    'user_id' => $_SESSION['user']->id()
                );

                if (empty($errors)) {
                    $comment_manager = new CommentManager();
                    $comment = new Comment($comment_data);
                    $affected_lines = $comment_manager->createComment($comment);
        
                    if (!$affected_lines) {
                        $errors[] = 'upload_problem';
                    } else {
                        header('Location: index.php?action=showChapter&id='. $_GET['id'] . '&comment=create');
                        exit;
                    }
                }         
            }
            else {
                $errors[] = 'missing_fields';
            }
        }
        else {
            $errors[] = "no_chapter_id";
        }

        $this->showChapter($errors);
    }

    public function reportComment() {
       $comment_manager = new CommentManager();
    
        if(isset($_GET['id']) && $_GET['id']>0) {
            $affected_line = $comment_manager->changeModerationStatus(1, $_GET['id']);

            if(!$affected_line) {
                echo json_encode([
                    'status' => 'error',
                    'error' => 'report_did_not_work'
                ]);
            }
            else {
                echo json_encode([
                    'status' => 'success'
                ]);
            }
        }
        else {
            echo json_encode([
                'status' => 'error',
                'error' => 'id_does_not_exist'
            ]);
        }
    }

    public function showError404() {
        require(__DIR__.'/../view/front/error404View.php');
    }

}