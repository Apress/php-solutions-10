<?php
require_once('../classes/Ps2/CheckPassword.php');
$usernameMinChars = 6;
$errors = array();
if (strlen($username) < $usernameMinChars) {
  $errors[] = "Username must be at least $usernameMinChars characters.";
}
if (preg_match('/\s/', $username)) {
  $errors[] = 'Username should not contain spaces.';
}
$checkPwd = new Ps2_CheckPassword($password, 10);
$checkPwd->requireMixedCase();
$checkPwd->requireNumbers(2);
$checkPwd->requireSymbols();
$passwordOK = $checkPwd->check();
if (!$passwordOK) {
  $errors = array_merge($errors, $checkPwd->getErrors());
}
if ($password != $retyped) {
  $errors[] = "Your passwords don't match.";
}
if (!$errors) {
  // include the connection file
  require_once('connection.inc.php');
  $conn = dbConnect('write');
  // create a key
  $key = 'takeThisWith@PinchOfSalt';
  // prepare SQL statement
  $sql = 'INSERT INTO users_2way (username, pwd)
          VALUES (?, AES_ENCRYPT(?, ?))';
  $stmt = $conn->stmt_init();
  $stmt = $conn->prepare($sql);
  // bind parameters and insert the details into the database
  $stmt->bind_param('sss', $username, $password, $key);
  $stmt->execute();
  if ($stmt->affected_rows == 1) {
	$success = "$username has been registered. You may now log in.";
  } elseif ($stmt->errno == 1062) {
	$errors[] = "$username is already in use. Please choose another username.";
  } else {
	$errors[] = 'Sorry, there was a problem with the database.';
  }
}