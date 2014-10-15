<?php
namespace tests;

use \tomkyle\yaphr\ImageFactory;
use \tomkyle\yaphr\Resize;
use \tomkyle\yaphr\Geometry\BoxFactory;

class ResizeTest extends \PHPUnit_Framework_TestCase {

    protected $image_factory;
    protected $image;
    protected $box_factory;
    protected $photo_dir;


    public function setUp()
    {
        $this->photo_dir     = realpath( __DIR__ . '/../samples');
        $this->image_factory = new ImageFactory;
        $this->image = $this->image_factory->newInstance( $this->photo_dir . '/beeswing.jpg');
        $this->box_factory   = new BoxFactory;

    }

    /**
     * @dataProvider provideValidBoxFactoryMethods
     */
    public function testVariousResizeMethods( $width, $height, $method = null)
    {
        $box = $method
             ? $this->box_factory->newInstance($width, $height, $this->image, $method)
             : $this->box_factory->newInstance($width, $height, $this->image);

        $resized = new Resize( $this->image, $box);
        $this->assertInstanceOf('\tomkyle\yaphr\Resize', $resized);
        $this->assertInstanceOf('\tomkyle\yaphr\ImageInterface', $resized);
        $this->assertGreaterThan(0, $resized->getWidth());
        $this->assertGreaterThan(0, $resized->getHeight());

        $image_type = $resized->getImageType();
        $this->assertInternalType('integer', $image_type );
        $this->assertInternalType('string',   image_type_to_mime_type( $image_type ));
        $this->assertInternalType('resource', $resized->getResource() );

    }



    public function provideValidBoxFactoryMethods()
    {
        return array(
            array( 150, 100, 'auto'),
            array( 150, 150, 'auto'),
            array( 150, 100, 'exact'),
            array( 150, 100, 'portrait'),
            array( 150, 100, 'landscape'),
            array( 150, 100, 'crop'),
            array( 150, 100)
        );
    }

}
