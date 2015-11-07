<?php
  //create short variable name
  $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
?>
<html>
<head>
  <title>Bob's Auto Parts - Customer Orders</title>
</head>
<body>
<h1>Bob's Auto Parts</h1>
<h2>Customer Orders</h2>
<?php

@ $fp = fopen("$DOCUMENT_ROOT/orders/orders.txt", "rb");
if (!$fp) { 
  echo "<p><strong>No orders pending. Please try again later.</strong></p>";
  exit;
}

# we can lock the file for SH reading
flock($fp, LOCK_SH);

while (!feof($fp)) {
  $order = fgets($fp, 999);
  echo $order.'<br />';
}

# when we finish reading. unlock it
flock($fp, LOCK_UN);
?>
</body>
</html>
