<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\FileSystem;


class DeliverImage
{

    /**
     * @uses FileExtension
     */
    public function __construct( $file, $do_exit = true )
    {
        list($width, $height, $mime_type, $attr) = getimagesize( $file );

        if (!is_string( $mime_type )) {

            $extension = new FileExtension( $file );
            switch( $extension->__toString() )
            {
                case 'jpg':
                case 'jpeg':
                    $image_type = \IMAGETYPE_JPEG;
                    break;
                case 'gif':
                    $image_type = \IMAGETYPE_GIF;
                    break;
                case 'png':
                    $image_type = \IMAGETYPE_PNG;
                    break;
                default:
                    throw new \Exception( "Could not determine image type from filename" );
                    break;
            }
            $mime_type = image_type_to_mime_type($image_type);
        }
        header("Content-type: " . $mime_type );
        readfile( $file );

        if ($do_exit) {
            exit;
        }

    }

}


