<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\Geometry;

class BoxFactory
{


    public function newInstance( $newWidth, $newHeight, BoxInterface $original, $method = 'auto' )
    {
       switch ($method) {
            case 'exact':
                return new Box( $newWidth, $newHeight );
                break;

            case 'tall':
            case 'portrait':
                return new TallBox( $newHeight, $original );
                break;

            case 'wide':
            case 'landscape':
                return new WideBox( $newWidth, $original);
                break;

            case 'crop':
                return new CropBox( $newWidth, $newHeight, $original );
                break;

            case 'auto':
                return new AutoBox( $newWidth, $newHeight, $original );
                break;

            default:
                throw new \Exception( "Box method $method not supported." );
                break;
        }

    }

}
