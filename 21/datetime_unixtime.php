<?php


// get UNIX timestamp
// - the following are equivalent
$timestamp = mktime();
$timestamp = time();
$timestamp = date("U");



// unix time at noon 12
$time = mktime(12, 0, 0);

// unix time at Jan 1st
$time = mktime(0, 0, 0, 0, 1, 1);

// simple date calculation
$mon = 1;
$day = 2;
$year = 1972;
$time = mktime(12, 0, 0, $mon, $day + 30, $year);


?>