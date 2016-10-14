<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Modify Dates</title>
</head>

<body>
<?php 
$format = 'F j, Y';
$date = new DateTime('January 31, 2011'); ?>
<p>Original date: <?php echo $date->format($format); ?>.</p>
<p>Add one month: <?php
$date->modify('+1 month');
echo $date->format($format);
$date->modify('-1 month');
?>
<p>Subtract one month: <?php echo $date->format($format); ?>.</p>
</body>
</html>