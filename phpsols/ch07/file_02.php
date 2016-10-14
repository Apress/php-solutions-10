<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Read a Text File into an Array</title>
</head>

<body>
<?php
// read the file into an array called $users
$users = file('C:/private/filetest_02.txt');

// loop through the array to process each line
for ($i = 0; $i < count($users); $i++) {
  // separate each element and store in a temporary array
  $tmp = explode(', ', $users[$i]);
  // assign each element of the temporary array to a named array key
  $users[$i] = array('name' => $tmp[0], 'password' => $tmp[1]);
}
?>
<pre>
<?php print_r($users); ?>
</pre>
</body>
</html>