<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\Geometry;


class SquareBox extends BoxAbstract implements BoxInterface
{

    public function __construct( $side )
    {
        $this->width  = $side;
        $this->height = $side;
    }

}
