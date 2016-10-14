<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8">
<title>Checking a File Before Displaying the Contents</title>
</head>

<body>
<?php
$contents = @ file_get_contents('C:/private/filetest_0.txt');
if ($contents === false) {
  echo 'Sorry, there was a problem reading the file.';
} else {
  echo $contents;
}
?>
</body>
</html>