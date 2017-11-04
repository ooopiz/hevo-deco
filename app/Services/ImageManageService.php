<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageManageService
{
    private $storageDisk = 'public';

    public function putBannerImage($file, $fileContent)
    {
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $saveFile = $fileName . '.' . $extension;
        $savePathFile = 'banner/' . $saveFile;

        $bool = Storage::disk($this->storageDisk)->put($savePathFile, $fileContent);

        $result['status'] = $bool;
        if ($bool) {
            $result['file'] = $savePathFile;
        }
        return $result;
    }

    public function delBannerImage($file)
    {
        return Storage::disk($this->storageDisk)->delete($file);
    }

    public function putNewsImage($file, $fileContent)
    {
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $saveFile = $fileName . '.' . $extension;
        $savePathFile = 'news/' . $saveFile;

        $bool = Storage::disk($this->storageDisk)->put($savePathFile, $fileContent);

        $result['status'] = $bool;
        if ($bool) {
            $result['file'] = $savePathFile;
        }
        return $result;
    }

    public function delNewImage($file)
    {
        return Storage::disk($this->storageDisk)->delete($file);
    }

    public function putMaterialImage($file, $fileContent)
    {
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $saveFile = $fileName . '.' . $extension;
        $savePathFile = 'material/' . $saveFile;

        $bool = Storage::disk($this->storageDisk)->put($savePathFile, $fileContent);

        $result['status'] = $bool;
        if ($bool) {
            $result['file'] = $savePathFile;
        }
        return $result;
    }

    public function delMaterialImage($file)
    {
        return Storage::disk($this->storageDisk)->delete($file);
    }
}