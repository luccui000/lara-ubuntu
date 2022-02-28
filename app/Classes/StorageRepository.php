<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class StorageRepository
{
    private $helper;
    private $disk;

    public function __construct()
    {
//        $this->helper = $helper;
//        $this->disk = Storage::disk($this->helper->config('disk'));
    }
    public function getDirectorySize($path): float
    {
        $totalSize = 0;
        $path = rtrim(realpath($path), '/') . '/';
        if($path != false && $path != '' && file_exists($path)) {
            foreach (new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($path),
                     RecursiveIteratorIterator::LEAVES_ONLY,
                     RecursiveIteratorIterator::CATCH_GET_CHILD) as $object)
                $totalSize += $object->getSize();
        }
        return $totalSize;
    }
}
