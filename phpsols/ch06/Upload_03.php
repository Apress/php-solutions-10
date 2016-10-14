<?php
class Ps2_Upload {
	
  protected $_uploaded = array();
  protected $_destination;
  protected $_max = 51200;
  protected $_messages = array();
  protected $_permitted = array('image/gif',
								'image/jpeg',
								'image/pjpeg',
								'image/png');
  protected $_renamed = false;

  public function __construct($path) {
	if (!is_dir($path) || !is_writable($path)) {
	  throw new Exception("$path must be a valid, writable directory.");
	}
	$this->_destination = $path;
	$this->_uploaded = $_FILES;
  }

  public function move() {
	$field = current($this->_uploaded);
	$OK = $this->checkError($field['name'], $field['error']);
	if ($OK) {
	  $sizeOK = $this->checkSize($field['name'], $field['size']);
	  $typeOK = $this->checkType($field['name'], $field['type']);
	  if ($sizeOK && $typeOK) {
		$success = move_uploaded_file($field['tmp_name'], $this->_destination . $field['name']);
		if ($success) {
		  $this->_messages[] = $field['name'] . ' uploaded successfully';
		} else {
		  $this->_messages[] = 'Could not upload ' . $field['name'];
		}
	  }
	}
  }

  public function getMessages() {
	return $this->_messages;
  }
  
  protected function checkError($filename, $error) {
	switch ($error) {
	  case 0:
		return true;
	  case 1:
	  case 2:
	    $this->_messages[] = "$filename exceeds maximum size: " . $this->getMaxSize();
		return true;
	  case 3:
		$this->_messages[] = "Error uploading $filename. Please try again.";
		return false;
	  case 4:
		$this->_messages[] = 'No file selected.';
		return false;
	  default:
		$this->_messages[] = "System error uploading $filename. Contact webmaster.";
		return false;
	}
  }

  public function getMaxSize() {
	return number_format($this->_max/1024, 1) . 'kB';
  }

  protected function checkSize($filename, $size) {
	if ($size == 0) {
	  return false;
	} elseif ($size > $this->_max) {
	  $this->_messages[] = "$filename exceeds maximum size: " . $this->getMaxSize();
	  return false;
	} else {
	  return true;
	}
  }
  
  protected function checkType($filename, $type) {
	if (empty($type)) {
	  return false;
	} elseif (!in_array($type, $this->_permitted)) {
	  $this->_messages[] = "$filename is not a permitted type of file.";
	  return false;
	} else {
	  return true;
	}
  }

  public function addPermittedTypes($types) {
	$types = (array) $types;
    $this->isValidMime($types);
	$this->_permitted = array_merge($this->_permitted, $types);
  }

  protected function isValidMime($types) {
    $alsoValid = array('image/tiff',
				       'application/pdf',
				       'text/plain',
				       'text/rtf');
  	$valid = array_merge($this->_permitted, $alsoValid);
	foreach ($types as $type) {
	  if (!in_array($type, $valid)) {
		throw new Exception("$type is not a permitted MIME type");
	  }
	}
  }

  public function setMaxSize($num) {
	if (!is_numeric($num)) {
	  throw new Exception("Maximum size must be a number.");
	}
	$this->_max = (int) $num;
  }

}