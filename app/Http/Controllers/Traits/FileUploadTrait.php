<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

trait FileUploadTrait {
    public function uploadFiles($photo, $folder_name) {
        $event_photo_name = [];
        $photos = (gettype($photo) != 'array') ? array($photo) : $photo;

        $thumbnailPath = 'public/uploads/' . $folder_name . '/thumb';
        $originalPath = 'public/uploads/' . $folder_name;

        if (! file_exists($originalPath)) {
            mkdir($originalPath, 0775);
        }

        if (! file_exists($thumbnailPath)) {
            mkdir($thumbnailPath, 0775);
        }

        if (count($photos)) {
            foreach($photos as $originalImage) {
                $defaul_size = 100;
				$file_name = rand(1000, 999999) . time(). '.' .$originalImage->getClientOriginalExtension();

                $mainImage = Image::make($originalImage);
                $mainImage->save($originalPath.'/'.$file_name);

                list($width, $height) = getimagesize($originalImage);

                if ($width > $height) {
                    $img_width = $defaul_size;
                    $img_height = ($defaul_size*$height)/$width;
                } else if ($height > $width) {
                    $img_height = $defaul_size;
                    $img_width = ($defaul_size*$width)/$height;
                } else {
                    $img_width = $defaul_size;
                    $img_height = $defaul_size;
                }

                $thumbnailImage = Image::make($originalImage);
                $thumbnailImage->resize($img_width, $img_height, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbnailPath.'/'.$file_name);

                $event_photo_name[] = $file_name;
            }
        }

        return $event_photo_name;
    }
}