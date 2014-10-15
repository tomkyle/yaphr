<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr;

use \tomkyle\yaphr\FileSystem\FileExtension;
use \tomkyle\yaphr\FileSystem\CheckReadableFile;
use \tomkyle\yaphr\Exceptions\YaphrException;


/**
 * Factory class for creating `ImageInterface` instances
 */
class ImageFactory
{

    /**
     * Returns a new `ImageInterface` instance
     * depending on the given file extension.
     *
     * Currently, these formats are supported:
     *
     * - Jpeg
     * - GIF
     * - PNG
     *
     * @param  string $file Filename
     * @return ImageInterface `JpegImage`, `GifImage` or `PngImage`
     * @throws YaphrException
     *
     * @uses   CheckReadableFile
     * @uses   FileExtension
     * @uses   JpegImage
     * @uses   GifImage
     * @uses   PngImage
     */
    public function newInstance( $file )
    {
        new CheckReadableFile( $file );

        $extension = new FileExtension( $file );
        switch( $extension->__toString() )
        {
            case 'jpg':
            case 'jpeg':
                return new JpegImage( $file );
                break;
            case 'gif':
                return new GifImage( $file );
                break;
            case 'png':
                return new PngImage( $file );
                break;
            default:
                throw new YaphrException( "Could not determine Image class from filename" );
                break;
        }
    }
}
