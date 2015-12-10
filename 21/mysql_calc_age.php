<?php
 // set date for calculation
 $day = 18;
 $month = 9;
 $year = 1972;

 // format birthday as an ISO 8601 date
 $bdayISO = date("c", mktime ('', '', '', $month, $day, $year));

 // use mysql query to calculate an age in days
 $db = mysqli_connect('localhost', 'root', 'root');
 $res = mysqli_query($db, "select datediff(now(), '$bdayISO')");
 $age = mysqli_fetch_array($res);

 // convert age in days to age in years (approximately)
 echo "Age is ".floor($age[0]/365.25) . "<br />";


 // we can instruct MySql to use specified format, such as 
 // e.g. select date_format(date_column, '%m %d %Y') from tablename
 $res = mysqli_query($db, "select date_format(now(), '%m %d %Y')");
 $formatted_date = mysqli_fetch_array(($res));

 echo "formatted date is " . $formatted_date[0] . "<br />";

?>