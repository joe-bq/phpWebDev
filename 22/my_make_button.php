<?php
// check we have the appropriate variable data 
// variables are button-text and color

$button_text = $_REQUEST['button_text'];
$color = $_REQUEST['color'];


$height = 200;
$width = 200;
$im = ImageCreateTrueColor($width, $height);
$blue = ImageColorAllocate($im, 0, 0, 64);

// ImageFill($im, 0, 0, $blue);
imagefilledrectangle($im, 0, 0, 399, 29, $white);



// Work out if the font size will fit and make it smaller until it does 
// Start out with the biggest size that will reasonably fit on our buttons
$font_size = 25;

// you need to tell GD2 where your fonts reside
putenv('GDFONTPATH=C:\WINDOWS\Fonts');

//  GDFONTPATH doesn't work works for windows.
//
// https://www.drupal.org/node/93763
// http://www.nusphere.com/kb/phpmanual/function.imagettftext.htm
//   this is not working...
// $fontname = 'Arial';

$fontname = getenv("GDFONTPATH") . "\\arial.ttf";

  $white = ImageColorAllocate ($im, 255, 255, 255);
  Header ('Content-type: image/png');
  ImageTTFText ($im, $font_size, 0, 50, 50, $white, $fontname,
                $button_text);
    ImagePNG ($im);


ImageDestroy ($im);


/*

// code example 
// http://www.nusphere.com/kb/phpmanual/function.imagettftext.htm?

// Set the content-type
header("Content-type: image/png");

// Create the image
$im = imagecreatetruecolor(400, 30);

// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 399, 29, $white);

// The text to draw
$text = 'Testing...';
// Replace path by your own font path
$font = 'c:\Windows\Fonts\arial.ttf';

// Add some shadow to the text
imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);

// Add the text
imagettftext($im, 20, 0, 10, 20, $black, $font, $text);

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);
*/
?>