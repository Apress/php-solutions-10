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

  public function setDestination($destination) {
	if (is_dir($destination) && is_writable($destination)) {
       // get last character
	   $last = substr($destination, -1);
	   // add a trailing slash if missing
	  if ($last == '/' || $last == '\\') {
		$this->_destination = $destination;
	  } else {
	    $this->_destination = $destination . DIRECTORY_SEPARATOR;
	  }
	} else {
	  $this->_messages[] = "Cannot write to $destination.";
	}
  }

  public function setMaxSize($size) {
	if (is_numeric($size)) {
	  $this->_maxSize = abs($size);
	}
  }
  
  public function setSuffix($suffix) {
	if (preg_match('/^\w+$/', $suffix)) {
	  if (strpos($suffix, '_') !== 0) {
	    $this->_suffix = '_' . $suffix;
	  } else {
		$this->_suffix = $suffix;
	  }
	} else {
      $this->_suffix = ''; 
	}
  }

  public function create() {
    if ($this->_canProcess && $this->_originalwidth != 0) {
	  $this->calculateSize($this->_originalwidth, $this->_originalheight);
	  $this->getName();
	} elseif ($this->_originalwidth == 0) {
	  $this->_messages[] = 'Cannot determine size of ' . $this->_original; 
	}
  }

  public function test() {
	echo 'File: ' . $this->_original . '<br>';
	echo 'Original width: ' . $this->_originalwidth . '<br>';
	echo 'Original height: ' . $this->_originalheight . '<br>';
	echo 'Image type: ' . $this->_imageType . '<br>';
	echo 'Destination: ' . $this->_destination . '<br>';
	echo 'Max size: ' . $this->_maxSize .  '<br>';
	echo 'Suffix: ' . $this->_suffix .  '<br>';
	echo 'Thumb width: ' . $this->_thumbwidth . '<br>';
	echo 'Thumb height: ' . $this->_thumbheight . '<br>';
	echo 'Base name: ' . $this->_name . '<br>';
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
  
  protected function calculateSize($width, $height) {
	if ($width <= $this->_maxSize && $height <= $this->_maxSize) {
	  $ratio = 1;
	} elseif ($width > $height) {
	  $ratio = $this->_maxSize/$width;
	} else {
	  $ratio = $this->_maxSize/$height;
	}
	$this->_thumbwidth = round($width * $ratio);
	$this->_thumbheight = round($height * $ratio);
  }

  protected function getName() {
	$extensions = array('/\.jpg$/i', '/\.jpeg$/i', '/\.png$/i', '/\.gif$/i');
	$this->_name = preg_replace($extensions, '', basename($this->_original));
  }

}