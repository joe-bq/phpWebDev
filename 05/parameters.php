<?php 
// ----------------------------------------------
// 	parameter pass by value , pass by reference
// ----------------------------------------------
// -- default by value, & changes to by references
// 
// 


function increment(&$value, $amount = 1) { 
	$value += $amount;
}

$a = 10;
echo $a . "<br />" . "\n";
increment($a); // -- better if we can do increment(&$a); if suggestion
echo $a . "<br />";

?>