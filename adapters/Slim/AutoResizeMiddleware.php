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
 * AutoResizeMiddleware
 *
 * Adds a URL route to Slim that defines the long side length of the requested image,
 * using Yaphrs's `AutoBox`.
 *
 * URL example:
 *
 *     /400/path/to/image.jpg
 *
 * If the long side is given as 400px, a portrait image will be delivered 400px high,
 * and a landscape image 400px wide.
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
 *     $app->add(new AutoResizeMiddleware( $originals, $cache, `300|600`);
 *     ?>
 *
 * @author Carsten Witt <tomkyle@posteo.de>
 */
class AutoResizeMiddleware extends \Slim\Middleware
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
     * Allowed request widths as regex (without delimiters), e.g. `\d+`
     * @var string
     */
    public $width_regex = '\d+';



    /**
     * Accepts two `SplFileInfo` instances for both originals and cache directory
     * and, optionally and recommended, a regex with allowed image widths.
     *
     * @param SplFileIno  $originals    Original images directory
     * @param SplFileIno  $cache        Output (caching) directory
     * @param string      $width_regex  Recommended: regex string without delimiters, default: `null`
     */
    public function __construct( SplFileInfo $originals, SplFileInfo $cache, $width_regex = null )
    {
        $this->originals = $originals;
        $this->cache     = $cache;

        if (is_string( $width_regex ) and !empty( $width_regex )) {
            $this->width_regex = $width_regex;
        }
    }



    /**
     * @uses $originals
     * @uses $cache
     * @uses $width_regex
     */
    public function call()
    {
        $app       = $this->app;
        $cache     = $this->cache;
        $originals = $this->originals;


        $app->get('/:width/:file+', function ($width, $file) use ( $app, $originals, $cache ) {


            try {
                $source = new SplFileInfo( $originals . '/' . implode("/", $file) );
                $output = new SplFileInfo( $cache . $app->request->getResourceUri() );

                $image_factory = new ImageFactory;
                $image = $image_factory->newInstance( $source );

                $box = new AutoBox( $width, $width, $image );
                new Workflow( $image, $box, $output);

            } catch (FileNotFound $e) {
                $app->notFound();
            }
        })->conditions(array(
            'width' => $this->width_regex
        ));


        // Call the next middleware
        $this->next->call();

    }

}
