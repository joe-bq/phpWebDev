<html>
<head>
  <title>Book-O-Rama Book Entry Results</title>
</head>
<body>
<h1>Book-O-Rama Book Entry Results</h1>
<?php
  // create short variable names
  $isbn=$_POST['isbn'];
  $author=$_POST['author'];
  $title=$_POST['title'];
  $price=$_POST['price'];

  if (!$isbn || !$author || !$title || !$price)
  {
     echo 'You have not entered all the required details.<br />'
          .'Please go back and try again.';
     exit;
  }
  if (!get_magic_quotes_gpc())
  {
    $isbn = addslashes($isbn);
    $author = addslashes($author);
    $title = addslashes($title);
    $price = doubleval($price);
  }

  @ $db = new mysqli('localhost', 'bookorama', 'bookorama123', 'books');

  if (mysqli_connect_errno()) 
  {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }

// in this example we will verify how to use the prepared statements and the parameter bindings
  $query = "insert into books values (?, ?, ?, ?)";
  $stmt = $db->prepare($query);
  $stmt->bind_param("sssd", $isbn, $author,  $title, $price);
  $stmt->execute();

  echo $stmt->affected_rows . 'book inserted into database.';
  $db->close();
?>
</body>
</html>
