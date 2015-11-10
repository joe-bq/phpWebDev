<?php

	echo "auto_prepend_file, auto_append_file" . "<br />";
	echo "On windows:" . "<br />";
	echo "auto_prepend_file = \"c:/Program Files/Apache Software Foundataion/Apache2.2//inclujde/header.php\"" . '<br />';
	echo "auto_prepend_file = \"c:/Program Files/Apache Software Foundataion/Apache2.2//inclujde/footer.php\"" . "<br />";

	echo "on unix:" . "<br />";
	echo "auto_prepend_file = \"/home/username/include/header.php\"" . "<br />";
	echo "auto_prepend_file = \"/home/username/include/footer.php\"" . "<br />";

	echo "if you are running with Apache web server, create .htaccess file, with the following contents:" . "<br />";
	echo "php_value auto_prepend_file \"/home/username/include/header.php\"" . "<br />" . "<br />";
	echo "php_value auto_prepend_file \"/home/username/include/footer.php\"" . "<br />" . "<br />";


	// ----------------------------------------------
	// 	function invocation
	// ----------------------------------------------
	// In PHP
	// 1. variable names are case-sensitive, while function invocation, it is not case-sensitive
	// 2. php does not support function overload - most dynamic programming does not support function overload - in my humble opinion...

	// -- in create_table.php, we discuss the 1) default parameter 2) varargs

	// -- parameters.php, pass by value, pass by reference

	// -- larger.php, return statement - shows a techinque to return FALSE IN CASE INVALID ARGUMENTS.
?>