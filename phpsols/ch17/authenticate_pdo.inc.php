<?php
require_once('../ch16/connection.inc.php');
$conn = dbConnect('read', 'pdo');
// get the username's details from the database
$sql = 'SELECT salt, pwd FROM users WHERE username = :username';
// prepare statement
$stmt = $conn->prepare($sql);
// bind the input parameter
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
// bind the result, using a new variable for the password
$stmt->bindColumn(1, $salt);
$stmt->bindColumn(2, $storedPwd);
$stmt->execute();
$stmt->fetch();
// encrypt the submitted password with the salt and compare with stored password
if (sha1($password . $salt) == $storedPwd) {
  $_SESSION['authenticated'] = 'Jethro Tull';
  // get the time the session started
  $_SESSION['start'] = time();
  session_regenerate_id();
  header("Location: $redirect");
  exit;
} else {
  // if no match, prepare error message
  $error = 'Invalid username or password';
}