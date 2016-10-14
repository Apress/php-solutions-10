<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Read a Text File into an Array</title>
</head>

<body>
<?php
$textfile = 'C:/private/filetest_02.txt';
if (file_exists($textfile) && is_readable($textfile)) {

  // read the file into an array called $users
  $users = file($textfile);
  
  // loop through the array to process each line
  for ($i = 0; $i < count($users); $i++) {
  // separate each element and store in a temporary array
  $tmp = explode(', ', $users[$i]);
  // assign each element of the temporary array to a named array key
  $users[$i] = array('name' => $tmp[0], 'password' => rtrim($tmp[1]));
  }
} else {
  echo "Can't open $textfile";
}

?>
<pre>
<?php print_r($users); ?>
</pre>
</body>
</html>