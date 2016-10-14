<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Heredoc syntax</title>
</head>

<body>
<?php
$fish = 'whiting';
$mockTurtle = <<< Gryphon
"Will you walk a little faster?" said a $fish to a snail.
"There's a porpoise close behind us, and he's treading on my tail."
Gryphon;
echo $mockTurtle;
?>
</body>
</html>
