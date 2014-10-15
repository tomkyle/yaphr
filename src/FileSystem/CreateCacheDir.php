<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\FileSystem;

class CreateCacheDir
{
    public function __construct( $target, $permissions = 0775)
    {
        $newdir = dirname( $target );

        if (!is_dir( $newdir )) {

            // Make nested directories "underway" writable...
            $oldmask = umask( $permissions & ~0777 );

            // Recursively create directory
            mkdir( $newdir, $permissions, true );

            // restore umask
            umask($oldmask);
        }
    }
}
