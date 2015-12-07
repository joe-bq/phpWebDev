<html>
<head>
  <title>Browse Directories</title>
</head>
<body>
<h1>Browsing</h1>
<?php
  // implements browse dir with dir() method, it has 'handle' and 'path' property
// dir is a class.
  $dir = dir("../19/");
  echo "<p>Handle is $dir->handle</p>";
  echo "<p>Upload directory is $dir->path</p>";
  echo '<p>Directory Listing:</p><ul>';
  while (false !== ($file = $dir->read()))
  {
    if ($file != '.' && $file != '..')
      echo "<li>$file</li>";
  }
  echo '</ul>';
  $dir->close();
?>
</body>
</html>
