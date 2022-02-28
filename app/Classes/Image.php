<?php

namespace App\Classes;

use Imagick;

class Image
{
    const FOCUS_CENTER = 'center';
    const FOCUS_SOUTHWEST = 'southwest';
    const FOCUS_SOUTHEAST = 'southwest';
    const FOCUS_NORTHEAST = 'northeast';
    const FOCUS_NORTHWEST = 'northwest';

    private $path;
    private $image;

    public function __construct($path)
    {
        $this->path = $path;
        $this->image = new Imagick($this->getRealPath());
    }
    public function getRealPath(): string
    {
        return realpath($this->path);
    }
    public function cropImage($width, $height, $startX = 0, $startY = 0)
    {
        $this->image->cropImage($width, $height, $startX, $startY);
    }
    public function makeThumbnail($newWidth, $newHeight, $focus = 'center')
    {
        $width = $this->image->getImageWidth();
        $height = $this->image->getImageHeight();
        if($width > $height) {
            $resizeNewWidth = $width * $newWidth  / $height;
            $resizeNewHeight = $newHeight;
        } else {
            $resizeNewWidth = $width;
            $resizeNewHeight = $height * $newWidth / $width;
        }
        $this->image->resizeImage(
            $resizeNewWidth,
            $resizeNewHeight,
            Imagick::FILTER_LANCZOS,
            0.9
        );
        switch ($focus) {
            case Image::FOCUS_NORTHWEST:
                $this->image->cropImage($newWidth, $newHeight, 0, 0);
                break;
            case Image::FOCUS_CENTER:
                $this->image->cropImage(
                    $newWidth,
                    $newHeight,
                    ($resizeNewWidth - $newWidth) / 2,
                    ($resizeNewHeight - $newHeight) / 2
                );
                break;
            case Image::FOCUS_NORTHEAST:
                $this->image->cropImage(
                    $newWidth,
                    $newHeight,
                    $resizeNewWidth - $newWidth,
                    0
                );
                break;
            case Image::FOCUS_SOUTHWEST:
                $this->image->cropImage(
                    $newWidth,
                    $newHeight,
                    0,
                    $resizeNewHeight - $newHeight
                );
                break;
            case Image::FOCUS_SOUTHEAST:
                $this->image->cropImage(
                    $newWidth,
                    $newHeight,
                    $resizeNewWidth -  $newWidth,
                    $resizeNewHeight - $newHeight
                );
                break;
        }
    }
    public function getPath()
    {
        return $this->path;
    }
    public function getImage()
    {
        return $this->image;
    }
}
