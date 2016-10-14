<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Using DirectoryIterator to Inspect the Contents of a Folder</title>
</head>

<body>
<pre>
<?php 
$files = new DirectoryIterator('../images');
foreach ($files as $file) {
  echo $file . '<br>';
}
?>
</pre>
</body>
</html>