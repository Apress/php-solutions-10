<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Formatting DateTime Objects</title>
</head>

<body>
<?php 
$xmas2010 = DateTime::createFromFormat('d/m/Y', '25/12/2010');
echo $xmas2010->format('l, jS F Y');
?>
</body>
</html>