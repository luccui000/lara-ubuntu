<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FileManagerController extends ApiController
{
    public function index(Request $request)
    {
        $path = trim($request->input('path'), '/');
        $path = DIRECTORY_SEPARATOR . $path;
        $isHidden = $request->input('is_hidden') ?? true;

        // cache in a minute
        $dirs = Cache::remember("files.index.{$path}", 60, function() use ($path, $isHidden) {
            $directories = scandir($path);
            $dirs = [];
            if($isHidden) {
                foreach ($directories as $directory) {
                    if(str_starts_with($directory, '.')) {
                        continue;
                    }
                    $dirs[] = [
                        'name' => $directory,
                        'size' => $this->getDirectorySize("{$path}/{$directory}"),
                    ];
                }
            } else {
                $dirs = $directories;
            }
            return $dirs;
        });

        return response()->json(
            $dirs
        );
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    protected function getDirectorySize($path) {
        $byteTotal = 0;
        $path = realpath($path);
        if($path !== false && is_dir($path) && $path !== '' &&  file_exists($path)) {
            foreach (
                new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS)) as $object) {
                $byteTotal += $object->getSize();
            }
        }
        return $byteTotal / 1000;
    }
}
