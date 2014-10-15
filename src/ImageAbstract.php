<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr;

use \tomkyle\yaphr\Resources\ResourceAggregateTrait;

abstract class ImageAbstract implements ImageInterface
{

    use ResourceAggregateTrait;


    /**
     * PHP image type constant
     * @var int
     * @see http://php.net/manual/de/image.constants.php
     */
    public $image_type = null;


    /**
     * @var int
     */
    public $width;

    /**
     * @var int
     */
    public $height;


    /**
     * Returns the IMAGETYPE constant for the image.
     *
     * @return int
     * @uses   $image_type
     * @see    http://php.net/manual/de/image.constants.php
     */
    public function getImageType()
    {
        return $this->image_type;
    }


    /**
     * @uses $width
     */
    public function getWidth()
    {
        return $this->width;
    }


    /**
     * @uses $height
     */
    public function getHeight()
    {
        return $this->height;
    }


}
