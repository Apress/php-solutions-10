<?php
require_once('../ch16/connection.inc.php');
$conn = dbConnect('read', 'pdo');
// create key
$key = 'takeThisWith@PinchOfSalt';
$sql = 'SELECT username FROM users_2way
		WHERE username = ? AND pwd = AES_ENCRYPT(?, ?)';
// prepare statement
$stmt = $conn->prepare($sql);
// bind variables when executing statement
$stmt->execute(array($username, $password, $key));
// if a match is found, rowCount() produces 1, which is treated as true
if ($stmt->rowCount()) {
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