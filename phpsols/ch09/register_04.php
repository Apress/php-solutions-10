<?php
if (isset($_POST['register'])) {
  $username = trim($_POST['username']);
  $password = trim($_POST['pwd']);
  $retyped = trim($_POST['conf_pwd']);
  $userfile = 'C:/private/encrypted.txt';
  require_once('../includes/register_user_text.inc.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Register User</title>
<style>
label {
	display:inline-block;
	width:115px;
	text-align:right;
	padding-right:2px;
}
input[type="submit"] {
	margin-left:122px;
}
</style>
</head>

<body>
<h1>Register User</h1>
<?php
if (isset($result)) {
  echo '<ul>';
  foreach ($result as $item) {
	echo "<li>$item</li>";
  }
  echo '</ul>';
}
?>
<form action="" method="post" id="form1">
  <p>
    <label for="username">Username:</label>
    <input type="text" name="username" id="username">
  </p>
  <p>
    <label for="pwd">Password:</label>
    <input type="password" name="pwd" id="pwd">
  </p>
  <p>
    <label for="conf_pwd">Retype Password:</label>
    <input type="password" name="conf_pwd" id="conf_pwd">
  </p>
  <p>
    <input type="submit" name="register" id="register" value="Register">
  </p>
</form>
</body>
</html>