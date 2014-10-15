<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\Geometry;

class NullCoordinates implements CoordinatesInterface
{
    public $x = 0;
    public $y = 0;


    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

}
