<?php
namespace tests;


use \tomkyle\yaphr\FileSystem\SaveImage;
use \tomkyle\yaphr\FileSystem\CreateCacheDir;
use \tomkyle\yaphr\ImageFactory;

class SaveImageTest extends \PHPUnit_Framework_TestCase {


    protected $output_path;
    protected $photo_dir;
    protected $image_factory;

    public function setUp()
    {
        $this->image_factory = new ImageFactory;
        $this->output_path   = new \SplFileInfo( '/tmp/path/to/images' );
        $this->photo_dir     = realpath( __DIR__ . '/../samples');
    }


    /**
     * @dataProvider provideValidSampleImages
     */
    public function testImage( $file )
    {
        $image = $this->image_factory->newInstance( $this->photo_dir . $file );

        $output_file = $this->output_path . $file;

        new CreateCacheDir( $output_file);
        new SaveImage( $image, $output_file, 85 );

        $this->assertTrue( is_file( $output_file ));
        $this->assertTrue( is_readable( $output_file ));
    }


    public function provideValidSampleImages()
    {
        return array(
            array( '/beeswing.jpg' ),
            array( '/black-transparent.png' ),
            array( '/black-transparent.gif' )
        );
    }


}
