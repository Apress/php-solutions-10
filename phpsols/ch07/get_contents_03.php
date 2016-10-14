<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8">
<title>Display First Four Words from a Text File</title>
</head>

<body>
<?php
// get the contents of the file
$contents = file_get_contents('C:/private/filetest_01.txt');
// split the contents into an array of words
$words = explode(' ', $contents);
// extract the first four elements of the array
$first = array_slice($words, 0, 4);
// join the first four elements and display
echo implode(' ', $first);
?>
</body>
</html>