<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Register user</title>
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
<h1>Register user</h1>
<form id="form1" method="post" action="">
  <p>
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
  </p>
  <p>
    <label for="pwd">Password:</label>
    <input type="password" name="pwd" id="pwd" required>
  </p>
  <p>
    <label for="conf_pwd">Confirm password:</label>
    <input type="password" name="conf_pwd" id="conf_pwd" required>
  </p>
  <p>
    <input name="register" type="submit" id="register" value="Register">
  </p>
</form>
</body>
</html>
