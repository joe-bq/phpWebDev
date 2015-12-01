<html>
<head>
  <title>Book-O-Rama Search Results</title>
</head>
<body>
<h1>Book-O-Rama Search Results</h1>
<?php
  // create short variable names
  $searchtype=$_POST['searchtype'];
  $searchterm=$_POST['searchterm'];

// $searchterm = "java";
// $searchtype = "title";

  $searchterm= trim($searchterm);

  if (!$searchtype || !$searchterm)
  {
     echo 'You have not entered search details.  Please go back and try again.';
     exit;
  }
  
  if (!get_magic_quotes_gpc())
  {
    $searchtype = addslashes($searchtype);
    $searchterm = addslashes($searchterm);
  }

  // set up for using PEAR DB
  require_once('MDB2.php');
  $user = 'bookorama';
  $pass = 'bookorama123';
  $host = 'localhost';
  $db_name  = 'books';

  // it seems that you need to install the drive, such as 
  //
  //  # pear install MDB2#mysqli
  //  # pear install MDB2#mysql - this could be an internet errors
  // 
  // after the two commands, then the necessary driveers will be installed.
  //
  // set up universal connectoin string or DSN
  $dsn = 'mysqli://' . $user . ':' . $pass . "@" . $host . "/" .  $db_name;

  $options = array('persistent' => true);

  // connect to database
  // $db = & MDB2::connect($dsn);

  // $db = & MDB2::factory($dsn, $options);
  $db = & MDB2::connect(array(
    'phptype'  => 'mysqli', # it used to be 'phptype' => 'mysql'
        'username' => $user,
        'password' => $pass,
        'hostspec' => $host,
        'database' => $db_name,));

  // check to see if a connection fails
  echo 'dsn = ' . $dsn . "<br />";
  if (MDB2::isError($db)) { 
    echo $db->getMessage();
    exit;
  }

  $db->setFetchMode(MDB2_FETCHMODE_ASSOC);

  // perform a query 
  $query = "select * from books where " . $searchtype . " like '%" . $searchterm . "%'";

  echo 'search query = ' . $query . "<br />";

  $result = $db->query($query);

  // check that results was OK
  if (MDB2::isError($result)) {
    echo $db->getMessage();
    exit;
  }


  // get numbers of returned rows
  $num_results = $result->numRows();

  echo "there are " . $num_results . " rows in the returned list";

  // display each returned row
  for ($i=0; $i <$num_results; $i++)
  {
     $row = $result->fetchRow(DB_FETCHMODE_ASSOC);
     echo '<p><strong>'.($i+1).'. Title: ';
     echo htmlspecialchars(stripslashes($row['title']));
     echo '</strong><br />Author: ';
     echo stripslashes($row['author']);
     echo '<br />ISBN: ';
     echo stripslashes($row['isbn']);
     echo '<br />Price: ';
     echo stripslashes($row['price']);
     echo '</p>';
  }
  // disconnect from database
  $db->disconnect();
?>
</body>
</html>
