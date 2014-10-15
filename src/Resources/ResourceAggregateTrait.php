<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\Resources;

trait ResourceAggregateTrait
{

    /**
     * @var resource
     */
    public $resource;


    /**
     * Returns a PHP image resource.
     *
     * @return resource
     * @see    http://de1.php.net/manual/de/function.imagecreate.php
     * @uses   $resource
     */
    public function getResource()
    {
        return $this->resource;
    }
}
