<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Changing Time Zones</title>
</head>

<body>
<?php
$UK = new DateTimeZone('Europe/London');
$USeast = new DateTimeZone('America/New_York');
$Hawaii = new DateTimeZone('Pacific/Honolulu');
$now = new DateTime('now', $UK);
?>
<p>In London, it's now <?php echo $now->format('l, F jS, Y g.ia'); ?>.</p>
<p>In New York, it's <?php
$now->setTimezone($USeast);
echo $now->format('l, F jS, Y g.ia'); ?>.</p>
<p>In Hawaii, it's <?php 
$now->setTimezone($Hawaii);
echo $now->format('l, F jS, Y g.ia'); ?>.</p>
</body>
</html>