<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr;

use \tomkyle\yaphr\Geometry\Box;
use \tomkyle\yaphr\Geometry\BoxFactory;
use \tomkyle\yaphr\Geometry\BoxInterface;
use \tomkyle\yaphr\Geometry\CropBoxInterface;
use \tomkyle\yaphr\Geometry\NullCoordinates;
use \tomkyle\yaphr\Geometry\CropStartCoordinates;
use \tomkyle\yaphr\Geometry\CoordinatesInterface;


class Resize implements ImageInterface
{

    /**
     * @var ImageInterface
     */
    protected $original;


    /**
     * @var  ImageInterface
     */
    public $image;


    /**
     * @var int
     */
    public $width;


    /**
     * @var int
     */
    public $height;


    /**
     * @param  ImageInterface Original image
     * @param  BoxInterface   Dimensions box
     *
     * @uses   $image
     * @uses   $original
     * @uses   resize()
     * @uses   crop()
     * @uses   CropBoxInterface
     */
    public function __construct(ImageInterface $original, BoxInterface $box)
    {
        $this->original = $original;

        $this->resize( $box, $original );

        if ($box instanceOf CropBoxInterface ) {
            $this->crop( $box, $this->image );
        }

    }


    /**
     * @return int
     * @uses   $original
     * @uses   ImageInterface::getImageType()
     */
    public function getImageType()
    {
        return $this->original->getImageType();
    }

    /**
     * @return resource
     * @uses   $image
     * @uses   ImageInterface::getResource()
     */
    public function getResource()
    {
        return $this->image ? $this->image->getResource() : null;
    }

    /**
     * @return int
     * @uses   $image
     * @uses   $original
     * @uses   ImageInterface::getWidth()
     */
    public function getWidth()
    {
        return $this->image ? $this->image->getWidth() : $this->original->getWidth();
    }

    /**
     * @return int
     * @uses   $original
     * @uses   $image
     * @uses   ImageInterface::getHeight()
     */
    public function getHeight()
    {
        return $this->image ? $this->image->getHeight() : $this->original->getHeight();
    }




    /**
     * @param  BoxInterface   $resized
     * @param  ImageInterface $original
     * @return self
     * @uses   resample()
     */
    protected function resize( BoxInterface $resized, ImageInterface $original )
    {
        $this->resample( new BlankImage( $resized ), $original, new NullCoordinates, new NullCoordinates);
        return $this;
    }


    /**
     * @param  CropBoxInterface $box
     * @param  ImageInterface   $resized
     * @return self
     * @uses   resample()
     */
    protected function crop( CropBoxInterface $box, ImageInterface $resized )
    {
        // Retrieve final dimensions from CropBox
        $final = new Box( $box->getFinalWidth(), $box->getFinalHeight());

        // Apply to resized image object
        $resized->width  = $final->getWidth();
        $resized->height = $final->getHeight();

        // Calculate where to start cropping
        $src_start = new CropStartCoordinates( $final, $box);

        // Go!
        $this->resample( new BlankImage( $final ), $resized, new NullCoordinates, $src_start);

        return $this;
    }


    /**
     * @param  ImageInterface       $dest
     * @param  ImageInterface       $src
     * @param  CoordinatesInterface $dest_start
     * @param  CoordinatesInterface $src_start
     * @return self
     */
    protected function resample(ImageInterface $dest, ImageInterface $src, CoordinatesInterface $dest_start, CoordinatesInterface $src_start)
    {
        imagecopyresampled($dest->getResource(), $src->getResource(),
                           $dest_start->getX(),  $dest_start->getY(),
                           $src_start->getX(),   $src_start->getY(),
                           $dest->getWidth(),    $dest->getHeight(),
                           $src->getWidth(),     $src->getHeight());
        $this->image = $dest;
        return $this;
    }

}
