<?php
namespace tests;

use \tomkyle\yaphr\ImageFactory;

class ImageFactoryTest extends \PHPUnit_Framework_TestCase {

    protected $image_factory;
    protected $photo_dir;

    public function setUp()
    {
        $this->image_factory = new ImageFactory;
        $this->photo_dir     = realpath( __DIR__ . '/../samples');
    }

    public function testDefault( )
    {
        $this->assertInstanceOf('\tomkyle\yaphr\ImageFactory', $this->image_factory);
    }

    /**
     * @expectedException \tomkyle\yaphr\Exceptions\FileNotFound
     */
    public function testNotFound( )
    {
        $image = $this->image_factory->newInstance( 'doesnotexist' );
        $this->assertInstanceOf('\tomkyle\yaphr\ImageInterface', $image);
    }

    /**
     * @expectedException \tomkyle\yaphr\Exceptions\YaphrException
     */
    public function testUnsupportedExtension( )
    {
        $this->image_factory->newInstance( $this->photo_dir . '/gif-with-wrong-extension.bak' );
    }


    /**
     * @dataProvider provideValidSampleImages
     * @covers \tomkyle\yaphr\Resources\ResourceAggregateTrait::getResource()
     * @covers \tomkyle\yaphr\Resources\ResourceAggregate::getResource()
     * @covers \tomkyle\yaphr\ImageAbstract::getWidth()
     * @covers \tomkyle\yaphr\ImageAbstract::getWidth()
     * @covers \tomkyle\yaphr\ImageAbstract::getImageType()
     */
    public function testImage( $file )
    {
        $image = $this->image_factory->newInstance( $this->photo_dir . $file );
        $this->assertInstanceOf('\tomkyle\yaphr\ImageInterface', $image);

        $image_type = $image->getImageType();
        $this->assertInternalType('integer', $image_type );
        $this->assertInternalType('string',   image_type_to_mime_type( $image_type ));
        $this->assertInternalType('resource', $image->getResource());
        $this->assertGreaterThan(0, $image->getWidth());
        $this->assertGreaterThan(0, $image->getHeight());

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
