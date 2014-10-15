<?php
namespace tests;


use \tomkyle\yaphr\FileSystem\CreateCacheDir;

class CreateCacheDirTest extends \PHPUnit_Framework_TestCase {


    public function testDefault()
    {
        $permissions = 0755;
        $path = '/tmp/path/to';

        $spl = new \SplFileInfo($path . '/output.jpg');
        new CreateCacheDir( $spl );

        $this->assertTrue( is_dir( $path ) );
        $this->assertTrue( is_writeable( $path ) );
    }

}
