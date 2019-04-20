<?php
namespace App\controller;

use App\model\BannerManager;
use App\model\UserManager;
use App\entity\Banner;
use App\entity\Image;

class BackEndController {

    public function showHomepageBack() {
        require(__DIR__.'\..\view\back\homepageView.php');
    }

    public function showBannerSection() {
        $banner_manager = new BannerManager();
        $banners = $banner_manager->getBanners();

        require(__DIR__.'\..\view\back\bannerManagementView.php');
    }

    public function createImageInFolder($image_input_name, $width, $height, $folder) {
        $image = new Image($image_input_name);

        $upload_errors = [];
        $image_name = '';

        if ($image->isExtAllowed()) {
            $upload_errors[] = 'invalid_extension';
        }

        if (empty($upload_errors)) {
            $image->resizeAndCompress($image_input_name, $width, $height);
            $image_name = $image->upload($folder);
        }

        return array($upload_errors, $image_name);
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
                        'title' => $_POST['title'],
                        'caption' => $_POST['caption'],
                        'button_title' => $_POST['button-title'],
                        'button_link' => $_POST['button-link']
                    );

                    $image_input_name = 'banner-image';
                              
                    if($_FILES[$image_input_name]['error'] == 0) {
                        $upload_data = $this->createImageInFolder($image_input_name, 1250, 680, 'banners');

                        $upload_errors = $upload_data[0];

                        if (!empty($upload_data[1])) {
                        
                            $image_name = $upload_data[1];

                            $banner_data['image'] = $image_name;

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

        require(__DIR__.'\..\view\back\bannerCreationView.php');
    }

    public function editBanner($id) {
        $banner_manager = new BannerManager();
        
        $modified_data = [];

        if (isset($_POST) && !empty($_POST)) {
            $errors = [];

            if (isset($_POST['id'], $_POST['display-order'], $_POST['title'], $_POST['caption'], $_POST['button-title'], $_POST['button-link'], $_FILES['banner-image'])) {
                if (!empty($_POST['id']) && !empty($_POST['display-order']) && !empty($_POST['title']) && !empty($_POST['caption']) && !empty($_POST['button-title']) && !empty($_POST['button-link'])) {
                    $modified_data = array(
                        'id' => $_POST['id'],
                        'display_order' => $_POST['display-order'],
                        'title' => $_POST['title'],
                        'caption' => $_POST['caption'],
                        'button_title' => $_POST['button-title'],
                        'button_link' => $_POST['button-link']
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
                    
                    $modified_data['image'] = $image_name;

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

        require(__DIR__.'\..\view\back\editBannerView.php');
    }

    public function deleteBanner($id) {
        $banner_manager = new BannerManager();
        $banner_manager->deleteBanner($id);

        header('Location:index.php?action=showBannersManagement&banner=delete');
    }
}