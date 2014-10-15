<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr;

use \tomkyle\yaphr\FileSystem\SaveGif;
use \tomkyle\yaphr\FileSystem\CheckReadableFile;

class GifImage extends ImageAbstract implements GifImageInterface
{

    /**
     * PHP image type constant
     * @var int
     * @see http://php.net/manual/de/image.constants.php
     */
    protected $image_type = \IMAGETYPE_GIF;


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

        $this->resource  = imagecreatefromgif($file);
        $this->width  = imagesx( $this->resource );
        $this->height = imagesy( $this->resource );
    }


}
