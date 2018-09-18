<?php



require '../vendor/autoload.php';

use Intervention\Image\ImageManagerStatic as Image;

class ImageChange
{
    private $img;

    public function __construct($filename)
    {
        $this->img = Image::make($filename);
    }

    public function rotate($degree, $newImageName)
    {
        $tmpImg = clone $this->img;
        $tmpImg->rotate($degree);
        $tmpImg->save($newImageName);
        unset($tmpImg);
    }

    public function setWatermark($wmFilename, $wmSize, $wmPosition, $newImageName)
    {
        $watermark = Image::make($wmFilename);
        $watermark->resize(round($wmSize * $this->img->width()), null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $tmpImg = clone $this->img;
        $tmpImg->insert($watermark, 'center');
        $tmpImg->save($newImageName);
        unset($tmpImg);
    }

    public function resizeProportional($newWidth, $newImageName)
    {
        $tmpImg = clone $this->img;
        $tmpImg->resize($newWidth, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $tmpImg->save($newImageName);
        unset($tmpImg);
    }
}