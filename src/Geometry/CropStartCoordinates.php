<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\Geometry;


class CropStartCoordinates extends NullCoordinates implements CoordinatesInterface
{

    public function __construct( BoxInterface $inner, BoxInterface $outer)
    {
        $this->x = ( $outer->getWidth()  / 2) - ( $inner->getWidth()  /2 );
        $this->y = ( $outer->getHeight() / 2) - ( $inner->getHeight() /2 );
    }


}
