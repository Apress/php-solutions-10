<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Using the DateInterval Class: Add</title>
</head>

<body>
<?php
$xmas2010 = new DateTime('12/25/2010');
$xmas2010->add(new DateInterval('P12D'));
?>
<p>Twelfth Night falls on <?php echo $xmas2010->format('l, F jS, Y'); ?>.</p>
</body>
</html>