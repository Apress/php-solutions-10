<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Simple function with argument - no return value</title>
</head>

<body>
<?php
function sayHi($name) {
  echo "Hi, $name!";
}
$visitor = 5;
sayHi($visitor);
?>
</body>
</html>
