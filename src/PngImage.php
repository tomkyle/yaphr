<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr;

use \tomkyle\yaphr\FileSystem\SavePng;
use \tomkyle\yaphr\FileSystem\CheckReadableFile;

class PngImage extends ImageAbstract implements PngImageInterface
{

    /**
     * PHP image type constant
     * @var int
     * @see http://php.net/manual/de/image.constants.php
     */
    protected $image_type = \IMAGETYPE_PNG;

    /**
     * @param string|SplFileInfo $file
     *
     * @uses  $width
     * @uses  $height
     * @uses  $resource
     * @uses  CheckReadableFile
     */
    protected function __construct($file)
    {
        new CheckReadableFile( $file );
        $this->resource = imagecreatefrompng($file);
        $this->width    = imagesx( $this->resource );
        $this->height   = imagesy( $this->resource );
    }


}
