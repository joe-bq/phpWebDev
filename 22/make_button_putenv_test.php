<?php 

putenv('GDFONTPATH=C:\WINDOWS\Fonts');

//  GDFONTPATH doesn't work wrk for windows.
//
// https://www.drupal.org/node/93763
// http://www.nusphere.com/kb/phpmanual/function.imagettftext.htm
// $fontname = 'Arial';

$fontname = getenv("GDFONTPATH") . "\\arial.ttf";


echo "\$fontname = $fontname <br />"

?>