<html>
<head>
  <title>Uploading...</title>
</head>
<body>
<h1>Uploading file...</h1>
<?php

  if ($_FILES['userfile']['error'] > 0) {
    echo 'Problem:';


    switch ($_FILES['userfile']['error']) {
      case 1:
        echo "File execeeded upload_max_filesize";
        break;
      case 2:
        echo "File exceeded max_file_size";
        break;
      case 3:
        echo "File only partially uploaded";
        break;
      case 4:
        echo "No file uploaded";
        break;
      case 6:
        echo "cannot upload file: No temp directory specified";
        break;
      case 7:
          echo "Upload failed: cannot write to disk";
        break;
    }
    exit;
  }

  // Doees the file has the right MIME type?
  if ($_FILES['userfile']['type'] != 'text/plain') { 
    echo 'problem: file is not plain text';
    exit;
  }

  // put the file where we'd like it 
  $upfile = 'C:\ProgramFiles\apache\httpd\Apache24\htdocs\uploads\\' . $_FILES['userfile']['name'];

echo "\$upfile = " . $upfile . "<br />";
echo "\$_FILES['userfile']['name'] = " . $_FILES['userfile']['name'] . "<br />";
echo "\$_FILES['userfile']['tmp_name'] = " . $_FILES['userfile']['tmp_name'] . "<br />";

  if (is_uploaded_file($_FILES['userfile']['name'])) 
  {
    if (!move_uploaded_file($_FILES['userfile']['name'], $upfile))
    {
      echo "problem: could not move file to destination directory";
      exit;
    }
  }
  else
  {
    echo 'problem: possible file upload attack. Filename:';
    echo $_FILES['userfile']['name'];

    exit;
  }

  echo 'File uploaded successfully<br><br>'; 

  // remove possible HTML and PHP tags from the file's contents.
  $contents = file_get_contents($upfile);
  $contents = strip_tags($contents);
  file_put_contents($_FILES['userfile']['name'], $contents);

  // show what was uploaded
  echo 'Preview of uploaded file contents:<br/><hr/>';
  echo nl2br($contents);
  echo '<br/><hr/>';

?>
</body>
</html>
