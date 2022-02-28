<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\UploadRequest;

class UploadController extends Controller
{
    public function __invoke(UploadRequest $request)
    {
        $image = $request->file('image');
        $imageMimeType = $image->getClientOriginalExtension();
        $imageName = date('dmy_hms') . '.' . $imageMimeType;
        $path = $image->storeAs('public/images', $imageName);

        return response()->json([
            'image_link' => url('storage/images', $imageName),
            'image_storage' => storage_path($path)
        ]);
    }
}
