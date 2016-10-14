<?php
session_start();
// if session variable not set, redirect to login page
if (!isset($_SESSION['authenticated'])) {
  header('Location: http://localhost/phpsols/sessions/login.php');
  exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=iso-"utf-8">
<title>Secret menu</title>
</head>

<body>
<h1>Restricted area</h1>
<p><a href="secretpage.php">Another secret page</a> </p>
</body>
</html>
