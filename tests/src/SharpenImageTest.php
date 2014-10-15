<?php
namespace tests;


use \tomkyle\yaphr\Filters\SharpenImage;
use \tomkyle\yaphr\ImageFactory;

class SharpenImageTest extends \PHPUnit_Framework_TestCase {


    protected $output_path;
    protected $photo_dir;
    protected $image_factory;

    public function setUp()
    {
        $this->image_factory = new ImageFactory;
        $this->photo_dir     = realpath( __DIR__ . '/../samples');
    }


    /**
     * @dataProvider provideValidSampleImages
     */
    public function testImage( $file )
    {
        $image = $this->image_factory->newInstance( $this->photo_dir . $file );

        $matrix = array(
            array(-1.4,  -1,  -1.4),
            array(-1,    24,  -1),
            array(-1.4,  -1,  -1.4)
        );

        $sharpen1 = new SharpenImage( $image, $matrix );
        $sharpen2 = new SharpenImage( $image->getResource(), $matrix );

        $this->assertInstanceOf( '\tomkyle\yaphr\Filters\SharpenImage', $sharpen1 );
        $this->assertInstanceOf( '\tomkyle\yaphr\Filters\SharpenImage', $sharpen2 );
    }


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidArgument( )
    {
        new SharpenImage( "InvalidArgument" );
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
