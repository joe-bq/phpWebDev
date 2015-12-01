<html>
<head>
  <title>Book-O-Rama Search Results</title>
</head>
<body>
<h1>Book-O-Rama Search Results</h1>
<?php
  

// this is the same as results.php , however manually typed, to strengthen impressions
// create short variables names
$searchtype = $_POST['searchtype'];
$searchterm = $_POST['searchterm'];

if (!$searchterm || !$searchtype)  { 
  echo "You have not entered search details. Please go back and try again";
  exit;
}

// magic quotes means that php does magic quote itself.
if (!get_magic_quotes_gpc()) { 
  $searchtype = addslashes($searchtype);
  $searchterm = addslashes($searchterm);
}

// host: localshot, user: bookorama, password: bookorama123, db: books
@ $db = mysqli_connect('localhost', 'bookorama', 'bookorama123', 'books');

if (mysqli_connect_errno()) {
  echo "Error: Could not connect to database. Please try again later.";
  exit;
}

$query = "select * from books where " . $searchtype . " like '%" . $searchterm . "'%";

$result = mysqli_query($db, $query);

$num_results = mysqli_num_rows($results);

echo "<p>Number of books found: " . $num_results . "</p>";


/*
  for ($i=0; $i <$num_results; $i++)
  {
     $row = $result->mysqli_fetch_assoc();
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
  
  // or you can use mysqli_fetch_array
  for ($i=0; $i <$num_results; $i++)
  {
     $row = $result->mysqli_fetch_row();
     echo '<p><strong>'.($i+1).'. Title: ';
     echo htmlspecialchars(stripslashes($row[0]));
     echo '</strong><br />Author: ';
     echo stripslashes($row[1]);
     echo '<br />ISBN: ';
     echo stripslashes($row[2]);
     echo '<br />Price: ';
     echo stripslashes($row[3]);
     echo '</p>';
  }
  */

    // or you can use mysqli_object
  for ($i=0; $i <$num_results; $i++)
  {
     $row = $result->mysqli_fetch_object();
     echo '<p><strong>'.($i+1).'. Title: ';
     echo htmlspecialchars(stripslashes($row->title));
     echo '</strong><br />Author: ';
     echo stripslashes($row->author);
     echo '<br />ISBN: ';
     echo stripslashes($row->isbn);
     echo '<br />Price: ';
     echo stripslashes($row->price      );
     echo '</p>';
  }




  // now to free the database
  mysqli_free_result($result);
  mysqli_close($db);

?>
</body>
</html>
