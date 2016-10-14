<?php
if (!file_exists($userlist) || !is_readable($userlist)) {
  $error = 'Login facility unavailable. Please try later.';
} else {
  // read the file into an array called $users
  $users = file($userlist);
  // loop through the array to process each line
  for ($i = 0; $i < count($users); $i++) {
	// separate each element and store in a temporary array
	$tmp = explode(', ', $users[$i]);
	// check for a matching record
	if ($tmp[0] == $username && rtrim($tmp[1]) == $password) {
      $_SESSION['authenticated'] = 'Jethro Tull';
	  $_SESSION['start'] = time();
	  session_regenerate_id();
	  break;
	}
  }
  // if the session variable has been set, redirect
  if (isset($_SESSION['authenticated'])) {
	header("Location: $redirect");
	exit;
  } else {
	$error = 'Invalid username or password.';
  }
}
