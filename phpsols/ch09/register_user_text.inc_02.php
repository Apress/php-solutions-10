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
  // encrypt password, using username as salt
  $password = sha1($username.$password);
  // open the file in append mode
  $file = fopen($userfile, 'a+');
  // if filesize is zero, no names yet registered
  // so just write the username and password to file
  if (filesize($userfile) === 0) {
    fwrite($file, "$username, $password");
	$result = "$username registered.";
  } else {
    // if filesize is greater than zero, check username first
    // move internal pointer to beginning of file
    rewind($file);
    // loop through file one line at a time
    while (!feof($file)) {
	  $line = fgets($file);
	  // split line at comma, and check first element against username
	  $tmp = explode(', ', $line);
	  if ($tmp[0] == $username) {
	    $result = "$username taken - choose a different username.";
	    break;
	  }
	}
    // if $result not set, username is OK
    if (!isset($result)) {
	  // insert line break followed by username, comma, and password
	  fwrite($file, PHP_EOL . "$username, $password");
	  $result = "$username registered.";
    }
    // close the file
    fclose($file);
  }
}