<?php
class Ps2_CheckPassword{

  protected $_password;
  protected $_minimumChars;
  protected $_mixedCase = false;
  protected $_minimumNumbers = 0;
  protected $_minimumSymbols = 0;
  protected $_errors = array();

  public function __construct($password, $minimumChars = 8) {
	$this->_password = $password;
	$this->_minimumChars = $minimumChars;
  }

  public function check() {
	if (preg_match('/\s/', $this->_password)) {
	  $this->_errors[] = 'Password cannot contain spaces.';
	}
	if (strlen($this->_password) < $this->_minimumChars) {
	  $this->_errors[] = "Password must be at least $this->_minimumChars characters.";
	}
	return $this->_errors ? false : true;
  }

  public function getErrors() {
	return $this->_errors; 
  }

}
