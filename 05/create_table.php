<?php


function create_table($data)
{
  echo '<table border = 1>';
  reset($data); // Remember this is used to point to the beginning
  $value = current($data);
  while ($value)
  {
     echo "<tr><td>$value</td></tr>\n";
     $value = next($data);
  }
  echo '</table>';
}

$my_array = array('Line one.','Line two.','Line three.');
create_table($my_array);

	// ----------------------------------------------
	// 	create function with default parameter
	// ----------------------------------------------
	// function can have default value parameter
	// 

function create_table2($data, $border = 1, $cellpadding = 4, $cellspacing = 4) {
	echo "<table border = \"" . $border . "\" cellpadding=\"" . $cellpadding . "\" cellspacing=\"" . $cellspacing . "\">";

	reset($data);

	for ($i = 0; $i < sizeof($data); $i++) { 
		// echo "<tr><td>" . $data[$i] . "</td></tr>\n";
		echo "<tr><td>$data[$i]</td></tr>\n";
	}	

	echo "</table>";

}


create_table2($my_array);

	// ----------------------------------------------
	// 	create function that has vararg
	// ----------------------------------------------
	// -- three helper functions - func_num_args, func_get_arg(), func_get_args()
	// 
function var_args() {
	echo "Number of parameters:";
	echo func_num_args();

	echo "<br />";
	$args = func_get_args();
	foreach ($args as $arg) {
		echo $arg . "<br />";
	}
}

var_args('1', 2, 3.5/*, array(1, 2, 3)*/);


?>
