<?php
/**
 * This file is part of tomkyle/yaphr.
 */
namespace tomkyle\yaphr\Filters;

use \tomkyle\yaphr\ImageInterface;


/**
 * SharpenImage
 *
 * Sharpens a given image resource or `ImageInterface` instance,
 * using a matrix and `imageconvolution`.
 *
 * @see  http://php.net/manual/de/function.imageconvolution.php#104006
 * @see  http://php.net/manual/de/function.imageconvolution.php#56145
 */
class SharpenImage
{

    // (The very first matrix)
    // public $sharpen_matrix_v0 = array(
    //   array(-1, -1, -1),
    //   array(-1, 16, -1),
    //   array(-1, -1, -1)
    // );


    // (The second very first matrix)
    // public $sharpen_matrix_v1 = array(
    //    array(-1.2,  -1,  -1.2),
    //    array(-1,    20,  -1),
    //    array(-1.2,  -1,  -1.2)
    //);


    public $sharpen_matrix = array(
        array(-1.4,  -1,  -1.4),
        array(-1,    24,  -1),
        array(-1.4,  -1,  -1.4)
    );


    public function __construct ( $image, array $sharpen_matrix = null)
    {
        if (is_array( $sharpen_matrix )) {
            $this->sharpen_matrix = $sharpen_matrix;
        }

        if ( $image instanceOf ImageInterface ) {
            $image = $image->getResource();
        }

        if (!is_resource( $image )) {
            throw new \InvalidArgumentException( "Image resource expected");
        }

        $offset  = 0;
        $divisor = array_sum(array_map('array_sum', $this->sharpen_matrix));

        imageconvolution($image, $this->sharpen_matrix, $divisor, $offset);

    }
}
