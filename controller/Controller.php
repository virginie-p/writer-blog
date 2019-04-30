<?php
namespace App\controller;


use App\entity\Image;

class Controller {
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
}