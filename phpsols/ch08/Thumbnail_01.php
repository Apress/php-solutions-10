<?php
class Ps2_Thumbnail {
  protected $_original;
  protected $_originalwidth;
  protected $_originalheight;
  protected $_thumbwidth;
  protected $_thumbheight;
  protected $_maxSize = 120;
  protected $_canProcess = false;
  protected $_imageType;
  protected $_destination;
  protected $_name;
  protected $_suffix = '_thb';
  protected $_messages = array();

  public function __construct($image) {
	if (is_file($image) && is_readable($image)) {
	  $details = getimagesize($image);
	} else {
	  $details = null;
	  $this->_messages[] = "Cannot open $image.";
	}
	// if getimagesize() returns an array, it looks like an image
	if (is_array($details)) {
  	  $this->_original = $image;
	  $this->_originalwidth = $details[0];
	  $this->_originalheight = $details[1];
	  // check the MIME type
      $this->checkType($details['mime']);
	} else {
	  $this->_messages[] = "$image doesn't appear to be an image."; 
	}
  }

  public function test() {
	echo 'File: ' . $this->_original . '<br>';
	echo 'Original width: ' . $this->_originalwidth . '<br>';
	echo 'Original height: ' . $this->_originalheight . '<br>';
	echo 'Image type: ' . $this->_imageType . '<br>';
	if ($this->_messages) {
	  print_r($this->_messages);
	}
  }

  protected function checkType($mime) {
	$mimetypes = array('image/jpeg', 'image/png', 'image/gif');
	if (in_array($mime, $mimetypes)) {
	  $this->_canProcess = true;
	  // extract the characters after 'image/'
	  $this->_imageType = substr($mime, 6);
	}
  }
  
}