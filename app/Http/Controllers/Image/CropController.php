<?php

namespace App\Http\Controllers\Image;

use App\Classes\Image;
use App\Http\Controllers\Controller;
use App\Http\Requests\Image\UploadRequest;

class CropController extends Controller
{
    public function __invoke()
    {
        $image = new Image('/home/luccui/Pictures/Image.png');
        header("Content-Type: image/jpg");
        $image->makeThumbnail(100, 100, Image::FOCUS_SOUTHWEST);

        return response()->json([
            'image_blob' => $image->getImage()->getImageBlob()
        ]);
    }
}
