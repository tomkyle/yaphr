<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\Resources;

interface ResourceAggregate
{

    /**
     * Returns a PHP image resource.
     *
     * @return resource
     * @see    http://de1.php.net/manual/de/function.imagecreate.php
     */
    public function getResource();
}
