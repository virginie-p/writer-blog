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

class BackEndController extends Controller {

    public function showHomepageBack() {
        require(__DIR__.'/../view/back/homepageView.php');
    }

    public function showBannersSection() {
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
                        'title' => strip_tags($_POST['title']),
                        'caption' => strip_tags($_POST['caption']),
                        'button_title' => strip_tags($_POST['button-title']),
                        'button_link' => strip_tags($_POST['button-link'])
                    );

                    $image_input_name = 'banner-image';
                              
                    if($_FILES[$image_input_name]['error'] == 0) {
                        $upload_data = $this->createImageInFolder($image_input_name, 1250, 680, 'banners');

                        $upload_errors = $upload_data[0];

                        if (!empty($upload_data[1])) {
                        
                            $image_name = $upload_data[1];

                            $banner_data['image'] = strip_tags($image_name);

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

    public function editBanner($id) {
        $banner_manager = new BannerManager();
        
        $modified_data = [];

        if (isset($_POST) && !empty($_POST)) {
            $errors = [];

            if (isset($_POST['id'], $_POST['display-order'], $_POST['title'], $_POST['caption'], $_POST['button-title'], $_POST['button-link'], $_FILES['banner-image'])) {
                if (!empty($_POST['id']) && !empty($_POST['display-order']) && !empty($_POST['title']) && !empty($_POST['caption']) && !empty($_POST['button-title']) && !empty($_POST['button-link'])) {
                    $modified_data = array(
                        'id' => $id,
                        'display_order' => $_POST['display-order'],
                        'title' => strip_tags($_POST['title']),
                        'caption' => strip_tags($_POST['caption']),
                        'button_title' => strip_tags($_POST['button-title']),
                        'button_link' => strip_tags($_POST['button-link'])
                    );
                }
                else {
                    $errors[]= 'missing_fields';
                }
            }

            $image_input_name = 'banner-image';

            if (!empty($_FILES[$image_input_name]['name'])) {
                              
                if($_FILES[$image_input_name]['error'] == 0) {
                    $upload_data = $this->createImageInFolder($image_input_name, 1250, 680, 'banners');

                    $upload_errors = $upload_data[0];
                    $image_name = $upload_data[1];
                    
                    $modified_data['image'] = strip_tags($image_name);

                    $edited_banner = new Banner($modified_data);

                    $banner_manager->editBanner($edited_banner);

                    $banner_edit_succeed = 1;

                } else {
                    $errors[]='image_or_size_invalid';
                }
                
            } else {
                $edited_banner = new Banner($modified_data);

                $banner_manager->editBanner($edited_banner);

                $banner_edit_succeed = 1;
            }

        }
        
        $banner = $banner_manager->getBanner($id);

        require(__DIR__.'/../view/back/editBannerView.php');
    }

    public function deleteBanner($id) {
        $banner_manager = new BannerManager();
        $banner_manager->deleteBanner($id);

        header('Location:index.php?action=showBannersManagement&banner=delete');
        exit;
    }

    public function showBooksSection() {
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
                        'title' => $_POST['title'],
                        'subtitle' => $_POST['subtitle']
                    );

                    $image_input_name = 'book-cover-image';
                              
                    if($_FILES[$image_input_name]['error'] == 0) {
                        $upload_data = $this->createImageInFolder($image_input_name, 595, 842, 'books_covers');

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

    public function editBook($id) {
        $book_manager = new BookManager();
        $user_manager = new UserManager();
        $authors= $user_manager->getAdmins();
        
        $modified_data = [];

        if (isset($_POST) && !empty($_POST)) {
            $errors = [];

            if (isset($_POST['id'], $_POST['author'], $_POST['title'], $_POST['subtitle'], $_FILES['book-cover-image'])) {
                if (!empty($_POST['id']) && !empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['subtitle'])) {
                    $modified_data = array(
                        'id' => $id,
                        'author_id' => strip_tags($_POST['author']),
                        'title' => strip_tags($_POST['title']),
                        'subtitle' => strip_tags($_POST['subtitle'])
                    );
                }
                else {
                    $errors[]= 'missing_fields';
                }
            }

            $image_input_name = 'book-cover-image';

            if (!empty($_FILES[$image_input_name]['name'])) {
                              
                if($_FILES[$image_input_name]['error'] == 0) {
                    $upload_data = $this->createImageInFolder($image_input_name, 595, 842, 'books_covers');

                    $upload_errors = $upload_data[0];
                    $image_name = $upload_data[1];
                    
                    $modified_data['book_cover_image'] = strip_tags($image_name);

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
        
        $book = $book_manager->getBook($id);

        require(__DIR__.'/../view/back/editBookView.php');
 
    }

    public function showChaptersSection($book_id) {
        $chapter_manager = new ChapterManager();
        $chapters = $chapter_manager->getChapters($book_id);
        $book_manager = new BookManager();
        $book = $book_manager->getBook($book_id);

        require(__DIR__.'/../view/back/chaptersManagementView.php');
    }

    public function createChapter($book_id) {
        $chapter_manager = new ChapterManager();
        $book_manager = new BookManager();
        $book = $book_manager->getBook($book_id);

        $chapter_data = [];

        if (isset($_POST) && !empty($_POST)) {
            $errors = [];

            if (isset($_POST['title'], $_POST['content'], $_FILES['chapter-image'])) {
                if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_FILES['chapter-image']['name'])) {
                    $chapter_data = array(
                        'book_id' => $book_id,
                        'title' => strip_tags($_POST['title']),
                        'content' => $_POST['content']
                    );

                    $image_input_name = 'chapter-image';
                              
                    if($_FILES[$image_input_name]['error'] == 0) {
                        $upload_data = $this->createImageInFolder($image_input_name, 1250, 350, 'chapters_images');

                        $upload_errors = $upload_data[0];

                        if (!empty($upload_data[1])) {
                        
                            $image_name = $upload_data[1];

                            $chapter_data['image'] = strip_tags($image_name);

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

        require(__DIR__.'/../view/back/createChapterView.php');

    }
    
    public function editChapter($chapter_id){
        $chapter_manager = new ChapterManager();

        if (isset($_POST) && !empty($_POST)) {
            $errors = [];

            if (isset($_POST['title'], $_POST['content'], $_FILES['chapter-image'])) {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    $modified_data = array(
                        'id' => $chapter_id,
                        'title' => strip_tags($_POST['title']),
                        'content' => $_POST['content']
                    );
                }
                else {
                    $errors[]= 'missing_fields';
                }
            }

            $image_input_name = 'chapter-image';

            if (!empty($_FILES[$image_input_name]['name'])) {
                              
                if($_FILES[$image_input_name]['error'] == 0) {
                    $upload_data = $this->createImageInFolder($image_input_name, 595, 842, 'chapters_images');

                    $upload_errors = $upload_data[0];
                    $image_name = $upload_data[1];
                    
                    $modified_data['image'] = strip_tags($image_name);

                    $edited_chapter = new Chapter($modified_data);

                    $affected_lines = $book_manager->editChapter($edited_chapter);

                    if (!$affected_lines) {
                        $errors[] = 'upload_problem';
                    } else {
                        $chapter_edit_succeed = 1;
                    }

                } else {
                    $errors[]='image_or_size_invalid';
                }
                
            } else {
                $edited_chapter = new Chapter($modified_data);

                $affected_lines = $chapter_manager->editChapter($edited_chapter);

                if (!$affected_lines) {
                    $errors[] = 'upload_problem';
                } else {
                    $chapter_edit_succeed = 1;
                }
            }
        }

        $chapter = $chapter_manager->getChapter($chapter_id);

        require(__DIR__.'/../view/back/editChapterView.php');
    }

    public function showUsersSection() {
        $user_manager = new UserManager();
        $users = $user_manager->getMembers();

        require(__DIR__.'/../view/back/usersManagementView.php');
    }

    public function displayUser($id) {
        $user_manager = new UserManager();
        $user = $user_manager->getMember($id);

        require(__DIR__.'/../view/back/displayUserView.php');
    }

    public function deleteUser($id) {
        $user_manager = new UserManager();
        $affected_lines = $user_manager->deleteUser($id);

        if (empty($affected_lines)){
            header('Location:index.php?action=showUsersManagement&user=delete');
            exit;
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