<?php  
// ----------------------------------------------
//  AutoLoadClass
// ----------------------------------------------
// Define a class which is not yet introduced and show how the __autoload works

class AutoLoadClass { 
	public function __construct() {
		echo "AutoLoadClass constructing";
	}
}

?>