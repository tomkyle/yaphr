<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\Geometry;

class CropBox extends BoxAbstract implements CropBoxInterface
{

    public $final_width;
    public $final_height;

    public function __construct( $newWidth, $newHeight, BoxInterface $original)
    {
        $this->final_width  = $newWidth;
        $this->final_height = $newHeight;

        $height_ratio = $original->height / $newHeight;
        $width_ratio  = $original->width  / $newWidth;

        $optimal_ratio = ($height_ratio < $width_ratio)
                       ? $height_ratio
                       : $width_ratio;

        $this->height = $original->height / $optimal_ratio;
        $this->width  = $original->width  / $optimal_ratio;

    }

    public function getFinalWidth()
    {
        return $this->final_width;
    }

    public function getFinalHeight()
    {
        return $this->final_height;
    }

}
