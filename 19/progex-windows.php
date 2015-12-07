<?php

   chdir('../19/');

///// exec version
   echo '<pre>';
   
   // windows
   exec('dir', $result);
   foreach ($result as $line) 
     echo "$line\n";

   echo '</pre>';
   echo '<br><hr><br>';

///// passthru version
   echo '<pre>';
   
   // windows
   passthru('dir');

   echo '</pre>';
   echo '<br><hr><br>';
 
///// system version 
   
   echo '<pre>';
   // windows
   $result = system('dir');
   echo '</pre>';
   echo '<br><hr><br>';

/////backticks version
   
   echo '<pre>';
   // windows
   $result = `dir`;
   echo $result;
   echo '</pre>';

?>

