<?php
session_start();
// if session variable not set, redirect to login page
if (!isset($_SESSION['authenticated'])) {
  header('Location: http://localhost/phpsols/sessions/login.php');
  exit;
}
// run this script only if the logout button has been clicked
if (isset($_POST['logout'])) {
  // empty the $_SESSION array
  $_SESSION = array();
  // invalidate the session cookie
  if (isset($_COOKIE[session_name()])) {
	setcookie(session_name(), '', time()-86400, '/');
  }
  // end session and redirect
  session_destroy();
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
<form id="logoutForm" method="post" action="">
  <input name="logout" type="submit" id="logout" value="Log out">
</form>
</body>
</html>
