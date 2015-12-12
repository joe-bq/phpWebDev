<?php 

// serializing variables and object

// the format to serialize object is as follow.
//   $serial_object = serialize($my_object);

class employee 
{
	var $name;
	var $employee_id;
}

$this_emp = new employee;
$this_emp->name = "Fred";
$this_emp->employee_id = 5324;

$serial_object = serialize($this_emp);

echo "serial_object is $serial_object<br />";
?>