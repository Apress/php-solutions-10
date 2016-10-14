<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Using the DateInterval Class: Diff</title>
</head>

<body>
<p><?php
$independence = new DateTime('7/4/1776');
$now = new DateTime();
$interval = $now->diff($independence);
echo $interval->format('%Y years %m months %d days'); ?> since American independence.</p>
</body>
</html>