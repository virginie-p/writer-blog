<?php
namespace App\controller;

use App\model\BannerManager;
use App\model\UserManager;
use App\model\BookManager;
use App\model\ChapterManager;
use App\model\CommentManager;
use App\entity\Banner;
use App\entity\Book;
use App\entity\Chapter;
use App\entity\Comment;

require_once(__DIR__.'/../configuration.php');

class BackEndController extends Controller {

    public function showHomepageBack() {
        require(__DIR__.'/../view/back/homepageView.php');
    }

    public function showBannersSection($errors = NULL) {
        $banner_manager = new BannerManager();
        $banners = $banner_manager->getBanners();

        require(__DIR__.'/../view/back/bannersManagementView.php');
    }

    public function createBanner() {
        $banner_manager = new BannerManager();
        
        $banner_data = [];

        if (isset($_POST) && !empty($_POST)) {
            $errors = [];

            if (isset($_POST['display-order'], $_POST['title'], $_POST['caption'], $_POST['button-title'], $_POST['button-link'], $_FILES['banner-image'])) {
                if (!empty($_POST['display-order']) && !empty($_POST['title']) && !empty($_POST['caption']) && !empty($_POST['button-title']) && !empty($_POST['button-link']) && !empty($_FILES['banner-image']['name'])) {
                    $banner_data = array(
                        'display_order' => $_POST['display-order'],
                        'title' => htmlspecialchars($_POST['title']),
                        'caption' => htmlspecialchars($_POST['caption']),
                        'button_title' => htmlspecialchars($_POST['button-title']),
                        'button_link' => htmlspecialchars($_POST['button-link'])
                    );

                    $image_input_name = 'banner-image';
                              
                    if($_FILES[$image_input_name]['error'] == 0) {
                        $upload_data = $this->createImageInFolder($image_input_name, $banner_with, $banner_height, $banner_folder);

                        $upload_errors = $upload_data[0];

                        if (!empty($upload_data[1])) {
                        
                            $image_name = $upload_data[1];

                            $banner_data['image'] = htmlspecialchars($image_name);

                            $new_banner = new Banner($banner_data);

                            $affected_lines = $banner_manager->createBanner($new_banner);

                            if (!$affected_lines) {
                                $errors[] = 'upload_problem';
                            } else {
                                header('Location:index.php?action=showBannersManagement&banner=creation');
                            }
                        }
                    } else {
                        $errors[]='image_or_size_invalid';
                    }
                }
                else  {
                    $errors[] = 'missing_fields';
                }
            }
        }

        require(__DIR__.'/../view/back/createBannerView.php');
    }

    public function editBanner() {
        $errors = [];

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $image_input_name = 'banner-image';
            $banner_manager = new BannerManager();
            $modified_data = [];

            if (isset($_POST['display-order'], $_POST['title'], $_POST['caption'], $_POST['button-title'], $_POST['button-link'], $_FILES[$image_input_name])) {
                if (!empty($_POST['display-order']) && !empty($_POST['title']) && !empty($_POST['caption']) && !empty($_POST['button-title']) && !empty($_POST['button-link'])) {
                    $modified_data = array(
                        'id' => $_GET['id'],
                        'display_order' => $_POST['display-order'],
                        'title' => htmlspecialchars($_POST['title']),
                        'caption' => htmlspecialchars($_POST['caption']),
                        'button_title' => htmlspecialchars($_POST['button-title']),
                        'button_link' => htmlspecialchars($_POST['button-link'])
                    );
                }
                else {
                    $errors[]= 'missing_fields';
                }
            
                if (!empty($_FILES[$image_input_name]['name'])) {       
                    if($_FILES[$image_input_name]['error'] == 0) {
                        $upload_data = $this->createImageInFolder($image_input_name, $banner_with, $banner_height, $banner_folder);

                        $upload_errors = $upload_data[0];
                        $image_name = $upload_data[1];
                        
                        $modified_data['image'] = htmlspecialchars($image_name);

                    } else {
                        $errors[]='image_or_size_invalid';
                    }
                } 

                if (empty($errors)) {
                    $edited_banner = new Banner($modified_data);

                    $affected_line = $banner_manager->editBanner($edited_banner);

                    if(!$affected_line) {
                        $errors[]= 'upload_problem';
                    }
                    else {
                        $banner_edit_succeed = 1;
                    }
                }
            }

            $banner = $banner_manager->getBanner($_GET['id']);
        }
        else {
            $errors[] = "no_banner_id";
        }
            
        require(__DIR__.'/../view/back/editBannerView.php');
    }

    public function deleteBanner() {
        $errors = [];

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $banner_manager = new BannerManager();
            $banner_manager->deleteBanner($_GET['id']);

            header('Location:index.php?action=showBannersManagement&banner=delete');
            exit;
        } 
        else {
            $errors[]= "no_banner_id";
            $this->showBannersSection($errors);
        }
    }

    public function showBooksSection($errors = NULL) {
        $book_manager = new BookManager(); 
        $books = $book_manager->getBooks();

        require(__DIR__.'/../view/back/booksManagementView.php');
    }

    public function createBook() {
        $book_manager =  new BookManager();
        $user_manager = new UserManager();
        $authors= $user_manager->getAdmins();

        $book_data = [];

        if (isset($_POST) && !empty($_POST)) {
            $errors = [];

            if (isset($_POST['author'], $_POST['title'], $_POST['subtitle'], $_FILES['book-cover-image'])) {
                if (!($_POST['author']>0) && !empty($_POST['title']) && !empty($_POST['subtitle']) && !empty($_FILES['book-cover-image']['name'])) {
                    $book_data = array(
                        'author_id' => $_POST['author'],
                        'title' => htmlspecialchars($_POST['title']),
                        'subtitle' => htmlspecialchars($_POST['subtitle'])
                    );

                    $image_input_name = 'book-cover-image';
                              
                    if($_FILES[$image_input_name]['error'] == 0) {
                        $upload_data = $this->createImageInFolder($image_input_name, $book_cover_width, $book_cover_height, $book_cover_folder);

                        $upload_errors = $upload_data[0];

                        if (!empty($upload_data[1])) {
                        
                            $image_name = $upload_data[1];

                            $book_data['book_cover_image'] = $image_name;

                            $new_book = new Book($book_data);

                            $affected_lines = $book_manager->createBook($new_book);

                            if (!$affected_lines) {
                                $errors[] = 'upload_problem';
                            } else {
                                header('Location:index.php?action=showBooksManagement&book=creation');
                                exit;
                            }
                        }
                    } else {
                        $errors[]='image_or_size_invalid';
                    }
                }
                else  {
                    $errors[] = 'missing_fields';
                }
            }
        }

        require(__DIR__.'/../view/back/createBookView.php');
    }

    public function editBook() {
        $book_manager = new BookManager();
        $user_manager = new UserManager();
        $authors= $user_manager->getAdmins();
        
        $modified_data = [];
        $errors = [];

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (isset($_POST) && !empty($_POST)) {
                if (isset($_POST['author'], $_POST['title'], $_POST['subtitle'], $_FILES['book-cover-image'])) {
                    if (!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['subtitle'])) {
                        $modified_data = array(
                            'id' => $_GET['id'],
                            'author_id' => htmlspecialchars($_POST['author']),
                            'title' => htmlspecialchars($_POST['title']),
                            'subtitle' => htmlspecialchars($_POST['subtitle'])
                        );
                    }
                    else {
                        $errors[]= 'missing_fields';
                    }
                }

                $image_input_name = 'book-cover-image';

                if (!empty($_FILES[$image_input_name]['name'])) {
                                    
                    if($_FILES[$image_input_name]['error'] == 0) {
                        $upload_data = $this->createImageInFolder($image_input_name, $book_cover_width, $book_cover_height, $book_cover_folder);

                        $upload_errors = $upload_data[0];
                        $image_name = $upload_data[1];
                        
                        $modified_data['book_cover_image'] = htmlspecialchars($image_name);

                        $edited_book = new Book($modified_data);

                        $affected_lines = $book_manager->editBook($edited_book);

                        if (!$affected_lines) {
                            $errors[] = 'upload_problem';
                        } else {
                            $book_edit_succeed = 1;
                        }

                    } else {
                        $errors[]='image_or_size_invalid';
                    }
                    
                } else {
                    $edited_book = new Book($modified_data);

                    $affected_lines = $book_manager->editBook($edited_book);

                    if (!$affected_lines) {
                        $errors[] = 'upload_problem';
                    } else {
                        $book_edit_succeed = 1;
                    }
                }
            }
            
            $book = $book_manager->getBook($_GET['id']);
        } 
        else {
            $errors[] = 'no_book_id';
        }

        require(__DIR__.'/../view/back/editBookView.php');
 
    }

    public function deleteBook() {
        $errors = [];

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $book_manager = new BookManager();
            $affected_line = $book_manager->deleteBook($_GET['id']);

            if (!$affected_line) {
                $errors[] = 'wrong_book_id';
            }
            else {
                header('Location:index.php?action=showBooksManagement&book=delete');
                exit;
            }
        } 
        else {
            $errors[]= "no_book_id";
            $this->showBooksSection($errors);
        }
    }

    public function showChaptersSection() {
        $errors = [];

        if (isset($_GET['bookId']) && $_GET['bookId'] > 0){
            $chapter_manager = new ChapterManager();
            $chapters = $chapter_manager->getChapters($_GET['bookId']);
            $book_manager = new BookManager();
            $book = $book_manager->getBook($_GET['bookId']);
        }
        else {
            $errors[] = 'no_book_id';
        }

        require(__DIR__.'/../view/back/chaptersManagementView.php');
    }

    public function createChapter() {
        $errors = [];

        if (isset($_GET['bookId']) && $_GET['bookId'] > 0){
            $chapter_manager = new ChapterManager();
            $book_manager = new BookManager();
            $book = $book_manager->getBook($_GET['bookId']);

            $chapter_data = [];
            
            if (isset($_POST['title'], $_POST['content'], $_FILES['chapter-image'])) {
                if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_FILES['chapter-image']['name'])) {
                    $chapter_data = array(
                        'book_id' => $_GET['bookId'],
                        'title' => htmlspecialchars($_POST['title']),
                        'content' => $_POST['content']
                    );

                    $image_input_name = 'chapter-image';
                                
                    if($_FILES[$image_input_name]['error'] == 0) {
                        $upload_data = $this->createImageInFolder($image_input_name, $chapter_image_width, $chapter_image_height, $chapter_image_folder);

                        $upload_errors = $upload_data[0];

                        if (!empty($upload_data[1])) {
                        
                            $image_name = $upload_data[1];

                            $chapter_data['image'] = htmlspecialchars($image_name);

                            $new_chapter = new Chapter($chapter_data);

                            $affected_lines = $chapter_manager->createChapter($new_chapter);

                            if (!$affected_lines) {
                                $errors[] = 'upload_problem';
                            } else {
                                header('Location:index.php?action=showChaptersManagement&bookId='.$book_id.'&chapter=creation');
                                exit;
                            }
                        }
                    } else {
                        $errors[]='image_or_size_invalid';
                    }
                }
                else  {
                    $errors[] = 'missing_fields';
                }
            }
        }
        else {
            $errors[] = 'no_book_id';
        }
        
        require(__DIR__.'/../view/back/createChapterView.php');

    }
    
    public function editChapter(){
        $errors = [];

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $chapter_manager = new ChapterManager();
            $modified_data = [];

            if (isset($_POST['title'], $_POST['content'], $_FILES['chapter-image'])) {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    $modified_data = array(
                        'id' => $_GET['id'],
                        'title' => htmlspecialchars($_POST['title']),
                        'content' => $_POST['content']
                    );
                }
                else {
                    $errors[]= 'missing_fields';
                }
            
                $image_input_name = 'chapter-image';

                if (!empty($_FILES[$image_input_name]['name'])) {
                    if($_FILES[$image_input_name]['error'] == 0) {
                        $upload_data = $this->createImageInFolder($image_input_name, 595, 842, 'chapters_images');

                        $upload_errors = $upload_data[0];
                        $image_name = $upload_data[1];
                        
                        $modified_data['image'] = htmlspecialchars($image_name);

                    } else {
                        $errors[]='image_or_size_invalid';
                    } 
                } 

                if (empty($errors)) {
                    $edited_chapter = new Chapter($modified_data);

                    $affected_lines = $chapter_manager->editChapter($edited_chapter);

                    if (!$affected_lines) {
                        $errors[] = 'upload_problem';
                    } else {
                        $chapter_edit_succeed = 1;
                    }
                }
            }

            $chapter = $chapter_manager->getChapter($_GET['id']);
        } 
        else {
            $errors[] = 'no_chapter_id';
        }    

        require(__DIR__.'/../view/back/editChapterView.php');
    }

    public function showUsersSection($errors = NULL) {
        $user_manager = new UserManager();
        $users = $user_manager->getMembers();

        require(__DIR__.'/../view/back/usersManagementView.php');
    }

    public function displayUser() {

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $user_manager = new UserManager();
            $user = $user_manager->getMember($_GET['id']);

            if (!$user) {
                $errors[] = 'wrong_user_id';
            }
        }
        else {
            $errors[] = 'no_user_id';
        }

        require(__DIR__.'/../view/back/displayUserView.php');
    }

    public function deleteUser() {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $user_manager = new UserManager();
            $affected_line = $user_manager->deleteUser($_GET['id']);

            if (empty($affected_line)){
                header('Location:index.php?action=showUsersManagement&user=delete');
                exit;
            }
            else {
                $errors[] = 'wrong_user_id';
            }
        }
        else {
            $errors[] = 'no_user_id';
            $this->showUsersSection($errors);
        }
    }

    public function showComments($errors= NULL) {
        $comment_manager = new CommentManager();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $comments = $comment_manager->getComments($_GET['id']);
        }
        else {
            $comments = [];
            $error = 'no_chapter_id';
        }

        require(__DIR__.'/../view/back/commentsManagementView.php');

    }

    public function displayComment() {
        $comment_manager = new CommentManager();
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $comment = $comment_manager->getComment($_GET['id']);
        }
        else {
            $comment = [];
            $error = 'no_comment_id';
        }

        require(__DIR__.'/../view/back/displayCommentView.php');
    }

    public function deleteComment() {
        $comment_manager = new CommentManager();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $affected_lines = $comment_manager->deleteComment($_GET['id']);
            
            if ($affected_lines == true){
                header('Location:index.php?action=showCommentsManagement&comment=delete');
                exit;
            }
        }
        else {
            header('Location:index.php?action=showCommentsManagement&comment=delete-error');
            exit;
        }

    }

    public function validateComment() {
        $comment_manager = new CommentManager();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $comment = $comment_manager->getComment($_GET['id']);

            if ($comment->moderationStatus() == 1) {
                $affected_line = $comment_manager->changeModerationStatus(2, $_GET['id']);

                if(!$affected_line) {
                    echo json_encode([
                        'status' => 'error',
                        'error' => 'validation_did_not_work'
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
                    'error' => 'comment_not_reported'
                ]);
            }
            
        }
        else {
            echo json_encode([
                'status' => 'error',
                'error' => 'no_comment_id'
            ]);
        }

    }
}