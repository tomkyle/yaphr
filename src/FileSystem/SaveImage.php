<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\FileSystem;

use \tomkyle\yaphr\Exceptions\YaphrException;


/**
 * SaveImage
 *
 * Saves the image depending on the target file extension,
 * using either `SaveJpeg`, `SaveGif` or `SavePng`.
 */
class SaveImage extends SaveImageAbstract implements SaveImageInterface
{


    /**
     * @param  resource $image     Image resource or `ImageInterface` instance
     * @param  string   $save_path Where to store that file
     *
     * @uses   SaveImageAbstract::makeSureIsResource()
     * @uses   SaveImageAbstract::makeSureIsString()
     * @uses   FileExtension
     *
     * @throws YaphrException
     */
    public function __construct( $image, $save_path, $quality = 100 )
    {
        $image     = $this->makeSureIsResource( $image );
        $save_path = $this->makeSureIsString( $save_path );

        $extension = new FileExtension( $save_path );

        switch( $extension->__toString() )
        {
            case 'jpg':
            case 'jpeg':
                return new SaveJpeg( $image, $save_path, $quality );
                break;
            case 'gif':
                return new SaveGif( $image, $save_path, $quality );
                break;
            case 'png':
                return new SavePng( $image, $save_path, $quality );
                break;
            default:
                throw new YaphrException( "Could not determine SaveImage class from filename" );
                break;
        }
    }
}
