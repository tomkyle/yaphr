<?php
namespace tests;

use \tomkyle\yaphr\ImageFactory;
use \tomkyle\yaphr\Resize;
use \tomkyle\yaphr\Workflow;
use \tomkyle\yaphr\Geometry\BoxFactory;
use \tomkyle\yaphr\Geometry\Box;

class WorkflowTest extends \PHPUnit_Framework_TestCase {

    protected $image_factory;
    protected $image;
    protected $box_factory;
    protected $box;
    protected $photo_dir;
    protected $output_file;


    public function setUp()
    {
        $this->photo_dir     = realpath( __DIR__ . '/../samples');
        $this->image_factory = new ImageFactory;
        $this->image = $this->image_factory->newInstance( $this->photo_dir . '/beeswing.jpg');
        $this->box_factory   = new BoxFactory;
        $this->box           = new Box( 50, 60);
        $this->output_file   = new \SplFileInfo( '/tmp/yaphr/path/to/' . '/beeswing.jpg');
    }




    public function testDefault()
    {
        ob_start();
        new Workflow( $this->image, $this->box, $this->output_file);
        $moin = ob_get_clean();
        $this->assertContains(
          'gd-jpeg', $moin
        );
    }

}
