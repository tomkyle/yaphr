<?php
namespace tomkyle\yaphr\Adapters\Slim;

use \tomkyle\yaphr\ImageFactory;
use \tomkyle\yaphr\Geometry\CropBox;
use \tomkyle\yaphr\Geometry\AutoBox;
use \tomkyle\yaphr\Exceptions\FileNotFound;
use \tomkyle\yaphr\Workflow;
use \SplFileInfo;
use \Slim\Route;


/**
 * CropMiddleware
 *
 * Adds a URL route to Slim that allows defining a crop with given width and height,
 * using Yaphrs's `CropBox`.
 *
 * URL example:
 *
 *     /400x200/path/to/image.jpg
 *
 * The delivered image will be 400px wide and 200px tall
 *
 * Usage:
 *
 *     <?php
 *     use \Slim\Slim;
 *     use \tomkyle\yaphr\Adapters\Slim\AutoResizeMiddleware;
 *
 *     $originals = new \SplFileInfo( '../master' );
 *     $cache     = new \SplFileInfo( '.' );
 *
 *     $app = new Slim;
 *     $app->add(new CropMiddleware( $originals, $cache);
 *     ?>
 *
 * @author Carsten Witt <tomkyle@posteo.de>
 */
class CropMiddleware extends \Slim\Middleware
{

    /**
     * @var SplFileInfo
     */
    public $originals;

    /**
     * @var SplFileInfo
     */
    public $cache;

    /**
     * Allowed crop dimensions as regex (without delimiters), e.g. `\d+x\d+`
     * @var string
     */
    public $crop_regex = '\d+x\d+';



    /**
     * Accepts two `SplFileInfo` instances for both originals and cache directory
     * and, optionally and recommended, a regex for parsing both width and height.
     *
     * @param SplFileIno $originals
     * @param SplFileIno $cache
     * @param string     $crop_regex  Optional: regex string without delimiters, default: `null`
     */
    public function __construct( SplFileInfo $originals, SplFileInfo $cache, $crop_regex = null  )
    {
        $this->originals = $originals;
        $this->cache     = $cache;

        if (is_string( $crop_regex ) and !empty( $crop_regex )) {
            $this->crop_regex = $crop_regex;
        }

    }






    /**
     * @uses $originals
     * @uses $cache
     * @uses $crop_regex
     */
    public function call()
    {
        $app       = $this->app;
        $cache     = $this->cache;
        $originals = $this->originals;


        // ======================
        // URLs containing s.th. like "/300x150/path/to/image.jpg"
        // ======================

        $app->get('/:width_and_height/:file+', function ($width_and_height, $file) use ( $app, $originals, $cache ) {

            list($width, $height) = explode( 'x', $width_and_height );

            try {
                $source = new SplFileInfo( $originals . '/' . implode("/", $file) );
                $output = new SplFileInfo( $cache . $app->request->getResourceUri() );

                $image_factory = new ImageFactory;
                $image = $image_factory->newInstance( $source );

                $box = new CropBox( $width, $height, $image );
                new Workflow( $image, $box, $output);

            } catch (FileNotFound $e) {
                $app->notFound();
            }

        })->conditions(array(
            'width_and_height' => $this->crop_regex
        ));



        // Call the next middleware
        $this->next->call();

    }

}
