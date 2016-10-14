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
?>
<pre>
<?php print_r($users); ?>
</pre>
</body>
</html>