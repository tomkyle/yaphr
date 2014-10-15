<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\FileSystem;

use \tomkyle\yaphr\Resources\ResourceAggregate;

abstract class SaveImageAbstract implements SaveImageInterface
{

    /**
     * @return resource
     * @uses   ResourceAggregate::getResource()
     * @throws \InvalidArgumentException
     */
    public function makeSureIsResource( $image )
    {
        if ($image instanceOf ResourceAggregate) {
            $image = $image->getResource();
        }

        if (!is_resource($image)) {
            throw new \InvalidArgumentException( "Generic image resource or instance of ResourceAggregate expected.");
        }

        return $image;
    }

    /**
     * @return string
     * @throws \InvalidArgumentException
     */
    public function makeSureIsString( $string )
    {
        if ($string instanceOf \SplFileInfo) {
            $string = $string->__toString();
        }

        if (!is_string( $string )) {
            throw new \InvalidArgumentException( "String or SplFileInfo instance expected.");
        }
        return $string;

    }
}
