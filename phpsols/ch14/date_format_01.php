<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Formatting DateTime Objects</title>
</head>

<body>
<?php 
$now = new DateTime();
$xmas2010 = new DateTime('12/25/2010');
?>
<p>It's now <?php echo $now->format('g.ia'); ?> on <?php echo $now->format('l, F jS, Y'); ?></p>
<p>Christmas 2010 falls on a <?php echo $xmas2010->format('l'); ?></p>
</body>
</html>