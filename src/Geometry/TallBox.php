<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\Geometry;

class TallBox extends BoxAbstract implements BoxInterface
{

    public function __construct( $height,  BoxInterface $original )
    {
        $ratio = $original->getWidth() / $original->getHeight();

        $this->width  = $height * $ratio;
        $this->height = $height;
    }


}
