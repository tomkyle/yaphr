<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\FileSystem;

class SavePng extends SaveImageAbstract implements SaveImageInterface
{

    /**
     * @uses SaveImageAbstract::makeSureIsResource()
     * @uses SaveImageAbstract::makeSureIsString()
     */
    public function __construct( $image, $save_path, $quality = 100 )
    {
        $image     = $this->makeSureIsResource( $image );
        $save_path = $this->makeSureIsString( $save_path );

        // Scale quality from 0-100 to 0-9,
        // then invert quality setting as 0 is best, not 9
        $scaleQuality       = round( $quality / 100 * 9);
        $invertScaleQuality = 9 - $scaleQuality;


        imagepng($image, $save_path, $invertScaleQuality);

    }
}
