<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Recurring Dates with the DatePeriod Class</title>
</head>

<body>
<p>
<?php
$period = new DatePeriod('R5/2011-02-05T00:00:00Z/P10D');
foreach ($period as $date) {
	echo $date->format('l, F j, Y') . '<br>';
}
?>
</p>
</body>
</html>