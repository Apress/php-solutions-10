<?php
session_start();
if (!isset($_SESSION['formStarted'])) {
  header('Location: http://localhost/phpsols/sessions/multiple_01.php');
  exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Multiple form 4</title>
</head>

<body>
<p>The details submitted were as follows: </p>
<ul>
<?php
// unset the formStarted variable
unset($_SESSION['formStarted']);
foreach ($_SESSION as $key => $value) {
  // unset the session variable
  unset($_SESSION[$key]);
  // skip the submit buttons
  if ($key == 'next') {
	continue;
  }
  echo "<li>$key: $value</li>";
}
?>
</ul>
</body>
</html>
