<?php
namespace tests;

use \tomkyle\yaphr\ImageFactory;

class PngImageTest extends \PHPUnit_Framework_TestCase {

    protected $image_factory;
    protected $image;
    protected $photo_dir;


    public function setUp()
    {
        $this->photo_dir     = realpath( __DIR__ . '/../samples');
        $this->image_factory = new ImageFactory;
        $this->image = $this->image_factory->newInstance( $this->photo_dir . '/black-transparent.png');

    }

    public function testDefault( )
    {
        $this->assertInstanceOf('\tomkyle\yaphr\PngImageInterface', $this->image);
        $this->assertInstanceOf('\tomkyle\yaphr\PngImage', $this->image);
    }


}
