<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\Geometry;

interface CropBoxInterface extends BoxInterface
{
    public function getFinalWidth();
    public function getFinalHeight();
}
