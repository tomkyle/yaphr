<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr;

use \tomkyle\yaphr\Geometry\BoxInterface;

/**
 * BlankImage
 *
 * `Resize` uses this class for creating the resized (or cropped) image.
 */
class BlankImage extends ImageAbstract implements ImageInterface
{
    /**
     * `null` since a blank image usually has no image type...
     * @var null
     */

    public $image_type = null;

    /**
     * @param BoxInterface $size Image dimensions
     *
     * @uses  $width
     * @uses  $height
     * @uses  $resource
     * @uses  BoxInterface::getWidth()
     * @uses  BoxInterface::getHeight()
     * @uses  ImageAbstract::getWidth()
     * @uses  ImageAbstract::getHeight()
     */
    public function __construct( BoxInterface $size )
    {
        $this->width  = $size->getWidth();
        $this->height = $size->getHeight();

        $this->resource = imagecreatetruecolor($this->getWidth(), $this->getHeight());
        imagesavealpha($this->resource, true);
        imagealphablending($this->resource, false);
    }

}
