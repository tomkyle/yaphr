<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\Geometry;

class Box extends BoxAbstract implements BoxInterface
{

    public function __construct( $width, $height)
    {
        $this->width  = $width;
        $this->height = $height;
    }

}
