<?php
namespace tests;

use \tomkyle\yaphr\Geometry\BoxFactory;
use \tomkyle\yaphr\Geometry\Box;
use \tomkyle\yaphr\ImageFactory;
use \tomkyle\yaphr\ImageInterface;

class BoxFactoryTest extends \PHPUnit_Framework_TestCase {

    protected $box_factory;
    protected $test_box;


    public function setUp()
    {
        $this->box_factory   = new BoxFactory;
        $this->test_box      = new Box( 200, 201);
    }


    /**
     * @dataProvider provideValidBoxFactoryMethods
     */
    public function testInstantiation( $width, $height, $method = null )
    {
        if ($method) {
            $box = $this->box_factory->newInstance( $width, $height, $this->test_box, $method );
        } else {
            $box = $this->box_factory->newInstance( $width, $height, $this->test_box);
        }

        $this->assertInstanceOf('\tomkyle\yaphr\Geometry\BoxInterface', $box);
        $this->assertGreaterThan(0, $box->getWidth());
        $this->assertGreaterThan(0, $box->getHeight());
    }

    /**
     * @expectedException \Exception
     */
    public function testWrongInstantiation( )
    {
        $this->box_factory->newInstance( 100, 100, $this->test_box, "wrong" );
    }



    public function provideValidBoxFactoryMethods()
    {
        return array(
            array( 150, 100, 'auto'),
            array( 150, 150, 'auto'),
            array( 150, 100, 'exact'),
            array( 150, 100, 'tall'),
            array( 150, 100, 'portrait'),
            array( 150, 100, 'landscape'),
            array( 150, 100, 'wide'),
            array( 150, 100, 'crop'),
            array( 150, 100)
        );
    }

}
