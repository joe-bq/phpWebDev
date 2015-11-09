;<?php
  //create short variable names


  // --------------------------------------------
  //           TRIM
  // --------------------------------------------

  $name=trim($_POST['name']);
  $email=trim($_POST['email']);
  $feedback=addslashes(trim($_POST['feedback']));

  if (strlen($email) < 6) {
    echo 'that email address is not valid';
    exit; // force execution of the php script
  }

/*
  $name = trim('joe');
  $email = trim('bigcustomer@exmaple.com');
  $feedback=addslashes((trim("your sales told, we don't provide guarantee to our customer ")));
*/
  $email_array = explode('@', $email);
  if (strtolower($email_array[1]) == "bigcustomer.com") {
    $toaddress = "bob@example.com";
  } else {
    $toaddress = "feedback@example";
  }

  $toaddress = 'feedback@example.com';

  // change the $toaddress based on feedback contents
  if (strstr($feedback, 'shop')) 
    $toaddress = 'retail@example.com';
  else if (strstr($feedback, 'delivery'))
    $toaddress = 'fulfillment@example.com';
  elseif (strstr($feedback, 'bill')) {
    $toaddress = 'accounts@example.com';
  }

  if (!ereg('^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-]+\.[a-zA-Z0-9_\-\.]+$', $email)) { 
    echo "<p>That is not a valid email address.</p>" .
          "<p>Please return to the previous page and try again.</p>"; 
    exit;
  }

  $toaddress = "feedback@example.com";
  if (eregi('shop|customer service|retail', $feedback)) 
    $toaddress = "retail@example";
  else if (eregi('delivery|fulfill', $feedback)) 
    $toaddress = "fulfillment@example";
  elseif (eregi("bill|account", $feedback)) 
    $toaddress = "accounts@example";

  if (eregi("bigcustomer\.com", $email)) { 
    $toaddress = "bob@example.com";
  }

  
  $subject = 'Feedback from web site';
  $mailcontent = 'Customer name: '.$name."\n"
                 .'Customer email: '.$email."\n"
                 ."Customer comments: \n".$feedback."\n";
  $fromaddress = 'From: webserver@example.com';

  // mail($toaddress, $subject, $mailcontent, $fromaddress);
?>
<html>
<head>
  <title>Bob's Auto Parts - Feedback Submitted</title>
</head>
<body>
<h1>Feedback submitted</h1>
<p>Your feedback (shown below) has been sent.</p>
<?php 

  // --------------------------------------------
  //           FORMAT
  // --------------------------------------------
  // -- nl2br: newline to break

  // -- sprintf, printf

  // -- addslashes and removeslashes
  // e.g.  $feedback=addslashes(trim($_POST['feedback']));


  // --------------------------------------------
  //           explode, implode, join
  // --------------------------------------------
  // -- explode, implode, and strtok


  // --------------------------------------------
  //           strtolower,strtoupper,ucfirst,ucwords
  // --------------------------------------------
  // 

echo "Customer feedback before slashes<br />";
echo $_POST['feedback'];

echo "<br />Customer feedback after addslashes<br />";
echo $feedback;

echo "<br />Customer feedback after stripslashes<br />";
echo stripslashes($feedback);

echo "strtok example";

$token = strtok($feedback, " ");
echo $token . "<br />";
while ($token != "") { 
  $token = strtok(" ");
  echo $token . "<br />";
}


  // --------------------------------------------
  //           substr
  // --------------------------------------------
  // -- substr the start index and end index can be negative, meaning index counting from backword

$test = 'your customer service is excellent';

echo substr($test, 1) . "<br />";
echo substr($test, -9) . "<br />";;
echo substr($test, 0, 4) . "<br />";;
echo substr($test, 5, -13) . "<br />";;

  // --------------------------------------------
  //           strcmp, strcasecmp, strnatcmp
  // --------------------------------------------
  // -- string comparison 

  // --------------------------------------------
  //           strlen - test the length of a string 
  // --------------------------------------------
  // -- tell the length of a string


  // --------------------------------------------
  //           strstr, strchr, strrchr, stristr
  // --------------------------------------------
  // -- strstr, strchr looks for string, or char in a string
  // -- strrchr reverse lookup
  // -- stristr ignore case
  // return string found otherwise, return false

  // --------------------------------------------
  //           strpos, strrpos
  // --------------------------------------------
  // -- return position for looking string, if not found, return fales, 
  // compare the result with === operator

  $test = "Hello world";
  echo strpos($test, "o") . "<br />";

  echo strpos($test, "o", 5) . "<br />";

  $result = strpos($test, "H");
  if ($result === false) {
    echo "Not Found <br />";
  } else { 
    echo "Found a position " . $result . "<br />";
  }

  // --------------------------------------------
  //           strpos, strrpos
  // --------------------------------------------
  // -- return position for looking string, if not found, return fales, 
  // compare the result with === operator
  

?>


<p><?php echo nl2br($mailcontent); ?></p>


</body>
</html>
