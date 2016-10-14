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
  $conn = dbConnect('write', 'pdo');
  // create a key
  $key = 'takeThisWith@PinchOfSalt';
  // prepare SQL statement
  $sql = 'INSERT INTO users_2way (username, pwd)
          VALUES (:username, AES_ENCRYPT(:pwd, :key))';
  $stmt = $conn->prepare($sql);
  // bind parameters and insert the details into the database
  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
  $stmt->bindParam(':pwd', $password, PDO::PARAM_STR);
  $stmt->bindParam(':key', $key, PDO::PARAM_STR);
  $stmt->execute();
  if ($stmt->rowCount() == 1) {
	$success = "$username has been registered. You may now log in.";
  } elseif ($stmt->errorCode() == 23000) {
	$errors[] = "$username is already in use. Please choose another username.";
  } else {
	$errors[] = 'Sorry, there was a problem with the database.';
  }
}