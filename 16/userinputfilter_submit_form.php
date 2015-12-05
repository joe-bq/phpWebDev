<?php

// here we show that we need to filter user input 
switch ($_POST["gender"]) {
	case 'Male':
	case 'Female':
	case 'Others':
		echo "<p align=\"center\">Congratulation, you are " . $_POST["gender"] . ".</p>";
	break;

	default:
		echo "<p align=\"center\"><span style=\"color: red;\">WARNING</span> Invalid input value for gender specified.</p>";
		break;
}
?>