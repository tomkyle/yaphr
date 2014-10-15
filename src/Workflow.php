<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr;

use \tomkyle\yaphr\Geometry\BoxInterface;
use \tomkyle\yaphr\Filters\SharpenImage;
use \tomkyle\yaphr\FileSystem\DeliverImage;
use \tomkyle\yaphr\FileSystem\CreateCacheDir;
use \tomkyle\yaphr\FileSystem\SaveImage;
use \SplFileInfo;

/**
 * Workflow
 *
 * Fulfills the complete resize/sharpen/save workflow
 * for a given `ImageInterface` with `BoxInterface`
 * and `SplFileInfo` output target.
 */
class Workflow
{

    /**
     * @param ImageInterface $image
     * @param BoxInterface   $box
     * @param SplFileInfo    $output_file
     * @param int            Octal permissions, default: `0775`
     *
     * @uses  Resize
     * @uses  SharpenImage
     * @uses  CreateCacheDir
     * @uses  SaveImage
     * @uses  DeliverImage
     */
    public function __construct( ImageInterface $image, BoxInterface $box, SplFileInfo $output_file, $permissions = 0775)
    {
        $permissions = 0775;

        $resized = new Resize($image, $box);
        new SharpenImage( $resized );

        new CreateCacheDir( $output_file, $permissions);
        new SaveImage( $resized, $output_file, 85 );
        chmod($output_file, $permissions);

        new DeliverImage( $output_file, "exit" );
    }
}
