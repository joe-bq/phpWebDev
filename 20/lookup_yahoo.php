<html>
<head>
  <title>Stock Quote from NASDAQ</title>
</head>
<body>
<?php
  // choose stock to look at
  $symbol='AMZN';
  echo "<h1>Stock Quote for $symbol</h1>";

  // $url="http://download.finance.yahoo.com/d/quotes.csv" .
  //         "?s=" . $symbol . "&e=.csv&f=s11d1t1c1ohgv";

  $url="http://download.finance.yahoo.com/d/quotes.csv" . "?s=" . $symbol . "&e=.csv&f=s11d1t1c1ohgv";

  if (!($contents = file_get_contents($url))) 
  {
    die ('Failure to open ' . $url);
  }

  // extract relevant data
  list($symbol, $quote, $date, $time) = explode(',', $contents);
  $date = trim($date, '"');
  $time = trim($time, '"');

  echo "<p>" . $symbol . "was last sold at : " . $quote . "</p>";
  echo "<p>Quote current as of " . $date . " at " . $time . "</p>";

  // acknowledge source
  echo '<p>This information retrieved from <br /> <a href="' . $url . '">' . $url . '</a>.</p>';
?>
</body>
</html>
