<?php 

// perl styles exit
exit('Script ending now');

// or die - stmt or die paradigm
mysqli_query($query) or die ('Could not execute query');

function err_msg() { 
	return 'MySQL Error was:' . mysqli_error();
}



?>