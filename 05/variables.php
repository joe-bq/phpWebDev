<?php

// ----------------------------------------------
// 	variable scope
// ----------------------------------------------
// In PHP
//   1. local variable has local scope
//   2. global variable has global scope
//   3. 'global' makes a variable in function to have a global variable.
// 



function fn1() {
	echo "inside the function, \$var = " . $var . "<br />";
	$var = "content 2";
	echo "inside the function, \$var = " . $var . "<br />";
}

$var = "content 2";
fn1();
echo "outside the function, \$var = " . $var . "<br />";


function fn() {
	global $var;
	//echo "inside the function, \$var = " . $var . "<br />";
	$var = "contents";
	echo "inside the function, \$var = " . $var . "<br />";
}

fn();
echo "outside the function, \$var = " . $var . "<br />";
?>