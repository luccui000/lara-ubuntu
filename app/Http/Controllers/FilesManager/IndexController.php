<?php

namespace App\Http\Controllers\FilesManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    const FORMAT_GB = 1073741824;
    const FORMAT_MB = 1048576;
    const FORMAT_KB = 1024;
    const FORMAT_BYTES = 1;
    const FORMAT_BYTE = 1;

    public function __invoke(Request $request)
    {
        $path = $request->get('path') ?? '/home/luccui';
        $path = DIRECTORY_SEPARATOR . trim($path);
        $hidden = $request->has('hidden');

        $directories = scandir($path);
        $directories = array_filter($directories, fn ($directory) => $directory !== "." and $directory !== "..");

        $directories = $hidden ? $directories : array_filter($directories, fn($directory) => !str_starts_with($directory, '.'));

        // cache in a minute
        $keyCache = "files.index." . $path;
        $keyCache .= $hidden ? 'true' : 'false';

        $dirs = Cache::remember($keyCache, 60, function() use ($directories, $path) {
            return array_map(function($directory) use ($path) {
                return [
                    'name' => $directory,
                    'size' => $this->formatFolderSize(disk_total_space($path . DIRECTORY_SEPARATOR . $directory))
                ];
            }, $directories);
        });
        dd($dirs);
        return view('files-manager.index', [
            'directories' => $dirs
        ]);
    }
    protected function formatFolderSize($folderSize) {
        if($folderSize >= self::FORMAT_GB) {
            return number_format($folderSize, self::FORMAT_GB, 2) . 'GB';
        } else if($folderSize >= self::FORMAT_MB) {
            return number_format($folderSize, self::FORMAT_MB, 2) . 'MB';
        } else if($folderSize >= self::FORMAT_KB) {
            return number_format($folderSize, self::FORMAT_KB, 2) . 'KB';
        } else if($folderSize > self::FORMAT_BYTES) {
            return number_format($folderSize, self::FORMAT_BYTES, 2) . 'bytes';
        } else if($folderSize === self::FORMAT_BYTE) {
            return number_format($folderSize, self::FORMAT_BYTE, 2) . 'byte';
        }
    }
}
