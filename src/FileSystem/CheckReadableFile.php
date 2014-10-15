<?php
namespace tomkyle\yaphr\FileSystem;

use \tomkyle\yaphr\Exceptions\FileNotFound;

class CheckReadableFile
{
    public function __construct( $file )
    {
        if (!is_readable( $file )) {
            throw new FileNotFound( "Not readable: $file" );
        }
    }
}
