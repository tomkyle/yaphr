<?php
namespace tests;

use \tomkyle\yaphr\Geometry\CropBox;
use \tomkyle\yaphr\Geometry\Box;

class CropBoxTest extends \PHPUnit_Framework_TestCase {




    public function testInstantiation()
    {
        $box = new CropBox(100, 100, new Box( 200, 200 ));
        $this->assertInstanceOf('\tomkyle\yaphr\Geometry\BoxInterface', $box);
    }

}
