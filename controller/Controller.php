<?php
namespace App\controller;


use App\entity\Image;

class Controller {
    public function createImageInFolder($image_input_name, $width, $height, $folder) {
        $image = new Image($image_input_name);   

        if ($image->isExtAllowed()) {
            $upload_errors = 'invalid_extension';
        }
        else {
            $upload_errors = null;
        }

        if (is_null($upload_errors)) {
            $image->resizeAndCompress($image_input_name, $width, $height);
            $upload_result = $image->upload($folder);
        } else {
            $upload_result = null;
        }

        return array(
            'upload_errors' => $upload_errors,
            'upload_results' => $upload_result);
    }
}