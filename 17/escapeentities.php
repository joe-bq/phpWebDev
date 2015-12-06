<?php

$input_str = "<p align=\"center\"> The user gave us \"15000?\".</p>
	<script type=\"text/javascript\"> 
		// malicious JavaScript code goes here
	</script>";


$str =htmlspecialchars($input_str);

echo nl2br($str);

$str = htmlentities($input_str, ENT_QUOTES, "UTF-8");
echo nl2br($str);

?>