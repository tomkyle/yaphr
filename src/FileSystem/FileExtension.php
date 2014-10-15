<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\FileSystem;

class FileExtension
{
    public $extension = '';

    public function __construct( $file )
    {
        $ext_with_dot = strtolower(strrchr($file, '.'));

        if (is_string( $ext_with_dot )
        and mb_strlen( $ext_with_dot ) > 1) {
            $this->extension = mb_substr( $ext_with_dot, 1 );
        } else {
            throw new \RuntimeException( "Could not determine file extension." );
        }
    }

    public function __toString()
    {
        return $this->extension;
    }
}
