<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr;

use \tomkyle\yaphr\FileSystem\SaveJpeg;
use \tomkyle\yaphr\FileSystem\CheckReadableFile;

class JpegImage extends ImageAbstract implements JpegImageInterface
{

    /**
     * PHP image type constant
     * @var int
     * @see http://php.net/manual/de/image.constants.php
     */
    public $image_type = \IMAGETYPE_JPEG;


    /**
     * @param string|SplFileInfo $file
     *
     * @uses  $width
     * @uses  $height
     * @uses  $resource
     * @uses  CheckReadableFile
     */
    public function __construct($file)
    {
        new CheckReadableFile( $file );
        $this->resource = imagecreatefromjpeg($file);
        $this->width  = imagesx( $this->resource );
        $this->height = imagesy( $this->resource );
    }


}
