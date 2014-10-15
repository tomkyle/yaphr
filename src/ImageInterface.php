<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr;

use \tomkyle\yaphr\Geometry\BoxInterface;
use \tomkyle\yaphr\Resources\ResourceAggregate;

interface ImageInterface extends BoxInterface, ResourceAggregate
{

    /**
     * Returns the IMAGETYPE constant for the image.
     *
     * @return int
     * @see    http://php.net/manual/de/image.constants.php
     */
    public function getImageType();

}
