<html>
<head>
  <title>Mirror update</title>
</head>
<body>
<h1>Mirror update</h1> 
<?php
// set up variables - change these to suit application 
$host = 'ftp.cs.rmit.edu.au';
$user = 'anonymous';
$password = 'laura@tangledweb.com.au';
$remotefile = '/pub/tsg/teraterm/ttssh14.zip';
$localfile = '../uploads/writable/ttssh14.zip';

// connect to host
$conn = ftp_connect("$host");
if (!$conn)
{
  echo 'Error: Could not connect to ftp server<br />';
  exit;
}

echo 'Connected to $host.<br />';

// log in to host
$result = @ftp_login($conn, $user, $pass);
if (!$result)
{
  echo "Error: Could not log on as $user<br />";
  ftp_quit($conn);
  exit;
}

echo "Logged in as $user<br />";

// check if file times to see if an update is required.
echo "Checking file time...<br />";
if (file_exists($localfile))
{
  $localtime = filemtime($localfile);
  echo 'Local file last updated ';
  echo date('G:i j-M-Y', $localtime);
  echo '<br />';
}
else
{
  $localtime = 0;
}

$remotetime = ftp_mdtm($conn, $remotefile);
if (!($remotetime >= 0))
{
  // this doesn't mena the file's not there, server may not support mod time
  echo "Can't access remote file time.<br />";
  $remotetime = $localtime + 1; // make sure of an update
}
else
{
  echo "remote file last updated '";
  echo date('G:i j-M-Y', $remotetime);
  echo "<br />";

}

if (!(remotetime > $localtime))
{
  echo "Local copy is up to update.<br />";
  exit;
}


// download file 
echo 'Getting file from server...<br />';
$fp = fopen($localfile, 'w');
if (!$success = ftp_fget($conn, $fp, $remotefile, FTP_BINARY))
{
  echo 'Error: Could not download file';
  ftp_quit($conn);
  exit;
}

fclose($fp);

echo 'File downloaded successfully';

// close connection to host
ftp_quit($conn);


?>
</body>
</html>