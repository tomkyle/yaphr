#tomkyle\yaphr

Yet another photo resizer for JPG, PNG, GIF.  
OOP-style, crisp & useful sharpening.


##Installation
tbd.



##Example Workflow
This example shows how to crop a JPG and save it into a cache directory:

```php
<?php
use \tomkyle\yaphr\ImageFactory;
use \tomkyle\yaphr\Geometry\CropBox;
use \tomkyle\yaphr\Geometry\AutoBox;
use \tomkyle\yaphr\Resize;
use \tomkyle\yaphr\Filters\SharpenImage;
use \tomkyle\yaphr\FileSystem\CreateCacheDir;
use \tomkyle\yaphr\FileSystem\DeliverImage;
use \tomkyle\yaphr\FileSystem\SaveImage;
use \SplFileInfo;

// YAPHR likes `SplFileInfo`
$source = new SplFileInfo( '../master/path/to/original.jpg' );
$output = new SplFileInfo( './path/to/resized.jpg' );

// Generate image from any original
$factory = new ImageFactory();
$image   = $factory->newInstance( $source );

// Prepare cropping
$crop_box = new CropBox( 300, 200, $image );
$auto_box = new AutoBox( 300, 300, $image ); # not used

// Generate new (cropped) image
$resized = new Resize($image, $crop_box);

// Make it crisp
new SharpenImage( $resized );

// Prepare saving, write output
new CreateCacheDir( $output, 0775 );
new SaveImage( $resized, $output, 85 );
chmod($output, 0775);

// Send to client
new DeliverImage( $output, "exit" );
```




##Classes overview

###Image classes

```php
<?php
# Classes
use \tomkyle\yaphr\GifImage;
use \tomkyle\yaphr\JpegImage;
use \tomkyle\yaphr\PngImage;

# Abstracts and Interfaces
use \tomkyle\yaphr\ImageAbstract;
use \tomkyle\yaphr\ImageInterface;
use \tomkyle\yaphr\GifImageInterface;
use \tomkyle\yaphr\JpegImageInterface;
use \tomkyle\yaphr\PngImageInterface;
```

###Business classes

```php
<?php
# Classes
use \tomkyle\yaphr\ImageFactory;
use \tomkyle\yaphr\BlankImage;
use \tomkyle\yaphr\Resize;
```



###Geometry classes

```php
<?php
# Boxes
use \tomkyle\yaphr\Geometry\Box;
use \tomkyle\yaphr\Geometry\BoxFactory;
use \tomkyle\yaphr\Geometry\AutoBox;
use \tomkyle\yaphr\Geometry\CropBox;
use \tomkyle\yaphr\Geometry\SquareBox;
use \tomkyle\yaphr\Geometry\TallBox;
use \tomkyle\yaphr\Geometry\WideBox;

# Coordinates
use \tomkyle\yaphr\Geometry\CropStartCoordinates;
use \tomkyle\yaphr\Geometry\NullCoordinates;

# Abstracts and Interfaces
use \tomkyle\yaphr\Geometry\CoordinatesInterface;
use \tomkyle\yaphr\Geometry\BoxAbstract;
use \tomkyle\yaphr\Geometry\BoxInterface;
use \tomkyle\yaphr\Geometry\CropBoxInterface;
```

###Image filter classes
```php
<?php
# Classes
use \tomkyle\yaphr\Filters\SharpenImage;
use \tomkyle\yaphr\Filters\UnsharpMask;
```


###File system classes

```php
<?php
# Classes
use \tomkyle\yaphr\FileSystem\CreateCacheDir;
use \tomkyle\yaphr\FileSystem\CheckReadableFile;
use \tomkyle\yaphr\FileSystem\DeliverImage;
use \tomkyle\yaphr\FileSystem\FileExtension;
use \tomkyle\yaphr\FileSystem\SaveImage;
use \tomkyle\yaphr\FileSystem\SaveGif;
use \tomkyle\yaphr\FileSystem\SaveJpeg;
use \tomkyle\yaphr\FileSystem\SavePng;

# Abstracts and Interfaces
use \tomkyle\yaphr\FileSystem\SaveImageAbstract;
use \tomkyle\yaphr\FileSystem\SaveImageInterface;
```

###Exceptions

```php
<?php
# Classes and Interfaces
use \tomkyle\yaphr\Exceptions\FileNotFound;
use \tomkyle\yaphr\Exceptions\YaphrException;
use \tomkyle\yaphr\Exceptions\YaphrExceptionInterface;
```

###PHP resource aggregation

```php
<?php
# Interfaces and traits
use \tomkyle\yaphr\Resources\ResourceAggregateuse \tomkyle\yaphr\Resources\ResourceAggregateTrait
```


