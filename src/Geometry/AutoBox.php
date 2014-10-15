<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\Geometry;

use \tomkyle\yaphr\Exceptions\YaphrException;



/**
 * AutoBox
 *
 * Creates a appropriate `BoxInterface` instance
 * for given `$width` and `$height` and original image.
 */
class AutoBox implements BoxInterface
{

    /**
     * @var BoxInterface
     */
    protected $box;



    /**
     * @param  int $width
     * @param  int $height
     * @param  BoxInterface $original
     * @throws \tomkyle\yaphr\Exceptions\YaphrException
     *
     * @uses   isLandscape()
     * @uses   isPortrait()
     * @uses   isSquare()
     */
    public function __construct( $width, $height, BoxInterface $original )
    {

        if ($this->isLandscape( $original )) {

            $this->box = new WideBox( $width, $original );

        }
        elseif ($this->isPortrait( $original )) {

            $this->box = new TallBox( $height, $original );

        }

        // hhmmm, original must be square then
        elseif ($this->isSquare( $original )) {

            $new_box = new Box( $width, $height );

            if ($this->isLandscape( $new_box ) ) {

                $this->box = new WideBox( $width, $original );

            } elseif ($this->isPortrait( $new_box )) {

                $this->box = new TallBox( $height, $original );

            } elseif ($this->isSquare( $new_box )) {

                $this->box = new SquareBox( $width );
            }

            else {
              throw new YaphrException("Huh... new box is neither portrait, landscape or square?!");
            }

        }

        else {
          throw new YaphrException("Huh... original is neither portrait, landscape or square?!");
        }

    }


    /**
     * @uses $box
     * @uses BoxInterface::getWidth()
     */
    public function getWidth()
    {
        return $this->box->getWidth();
    }


    /**
     * @uses $box
     * @uses BoxInterface::getHeight()
     */
    public function getHeight()
    {
        return $this->box->getHeight();
    }


    /**
     * @return boolean
     * @uses   BoxInterface::getHeight()
     * @uses   BoxInterface::getWidth()
     */
    protected function isLandscape( BoxInterface $box )
    {
        return $box->getHeight() < $box->getWidth();
    }


    /**
     * @return boolean
     * @uses   BoxInterface::getHeight()
     * @uses   BoxInterface::getWidth()
     */
    protected function isPortrait( BoxInterface $box )
    {
        return $box->getHeight() > $box->getWidth();
    }


    /**
     * @return boolean
     * @uses   BoxInterface::getHeight()
     * @uses   BoxInterface::getWidth()
     */
    protected function isSquare( BoxInterface $box )
    {
        return $box->getHeight() == $box->getWidth();
    }
}
