<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8">
<title>Extract Words from a Text File</title>
</head>

<body>
<?php
// get the contents of the file
$contents = file_get_contents('C:/private/filetest_01.txt');
echo getFirstWords($contents, 7);


function getFirstWords($string, $number) {
  $words = explode(' ', $string);
  $first = array_slice($words, 0, $number);
  return implode(' ', $first);
}
?>
</body>
</html>