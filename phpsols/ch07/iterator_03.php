<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Burrowing Down with the RecursiveDirectoryIterator</title>
</head>

<body>
<pre>
<?php 
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('../images'));
$images = new RegexIterator($files, '/\.(?:jpg|png|gif)$/i');
foreach ($images as $file) {
  echo $file->getRealPath() . '<br>';
}
?>
</pre>
</body>
</html>