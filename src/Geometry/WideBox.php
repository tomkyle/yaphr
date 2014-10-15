<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\Geometry;

class WideBox extends BoxAbstract implements BoxInterface
{

    public function __construct( $width,  BoxInterface $original )
    {
        $ratio = $original->getHeight() / $original->getWidth();

        $this->height = $width * $ratio;
        $this->width  = $width;
    }


}
