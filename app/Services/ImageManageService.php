<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageManageService
{
    private $storageDisk = 'public';
    private $bannerFolder = 'banner/';
    private $newsFolder = 'news/';
    private $materialFolder = 'material/';
    private $productFolder = 'product/';

    public function putBannerImage($file, $fileContent)
    {
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $saveFile = $fileName . '.' . $extension;
        $savePathFile = $this->bannerFolder . $saveFile;

        $bool = Storage::disk($this->storageDisk)->put($savePathFile, $fileContent);

        $result['status'] = $bool;
        if ($bool) {
            $result['file'] = $saveFile;
        }
        return $result;
    }

    public function delBannerImage($file)
    {
        return Storage::disk($this->storageDisk)->delete($this->bannerFolder . $file);
    }

    public function putNewsImage($file, $fileContent)
    {
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $saveFile = $fileName . '.' . $extension;
        $savePathFile = $this->newsFolder . $saveFile;

        $bool = Storage::disk($this->storageDisk)->put($savePathFile, $fileContent);

        $result['status'] = $bool;
        if ($bool) {
            $result['file'] = $saveFile;
        }
        return $result;
    }

    public function delNewImage($file)
    {
        return Storage::disk($this->storageDisk)->delete($this->newsFolder . $file);
    }

    public function putMaterialImage($file, $fileContent)
    {
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $saveFile = $fileName . '.' . $extension;
        $savePathFile = $this->materialFolder . $saveFile;

        $bool = Storage::disk($this->storageDisk)->put($savePathFile, $fileContent);

        $result['status'] = $bool;
        if ($bool) {
            $result['file'] = $saveFile;
        }
        return $result;
    }

    public function delMaterialImage($file)
    {
        return Storage::disk($this->storageDisk)->delete($this->materialFolder . $file);
    }

    public function putProductImage($file, $fileContent)
    {
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $saveFile = $fileName . '.' . $extension;
        $savePathFile = $this->productFolder . $saveFile;

        $bool = Storage::disk($this->storageDisk)->put($savePathFile, $fileContent);

        $result['status'] = $bool;
        if ($bool) {
            $result['file'] = $saveFile;
        }
        return $result;
    }

    public function delProductImage($file)
    {
        return Storage::disk($this->storageDisk)->delete($this->productFolder . $file);
    }
}