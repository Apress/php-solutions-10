<?php
if (!isset($_SESSION)) {
  session_start();
}
$filename = basename($_SERVER['SCRIPT_FILENAME']);
$current = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$redirectFirst = str_replace($filename, $firstPage, $current);
$redirectNext = str_replace($filename, $nextPage, $current);
if ($filename != $firstPage && !isset($_SESSION['formStarted'])) {
  header("Location: $redirectFirst");
  exit;
}

if (isset($_POST[$submit])) {
// create empty array for any missing fields
  $missing = array();
  // create $required array if not set
  if (!isset($required)) {
	$required = array();
  } else {
	// using casting operator to turn single string to array
	$required = (array) $required;
  }
  // process the $_POST variables and save them in the $_SESSION array
  foreach ($_POST as $key => $value) {
	// assign to temporary variable and strip whitespace if not an array
	$temp = is_array($value) ? $value : trim($value);
	// if empty and required, add to $missing array
	if (empty($temp) && in_array($key, $required)) {
	  $missing[] = $key;
	} else {
	  // otherwise, assign to a variable of the same name as $key
	  $_SESSION[$key] = $temp;
	}
  }
  // if no required fields are missing, redirect to next page
  if (!$missing) {
	header("Location: $redirectNext");
	exit;
  }
}