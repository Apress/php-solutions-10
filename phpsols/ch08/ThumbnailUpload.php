<?php
require_once('Upload.php');
require_once('Thumbnail.php');

class Ps2_ThumbnailUpload extends Ps2_Upload {

  protected $_thumbDestination;
  protected $_deleteOriginal;
  protected $_suffix = '_thb';

  public function __construct($path, $deleteOriginal = false) {
	parent::__construct($path);
	$this->_thumbDestination = $path;
	$this->_deleteOriginal = $deleteOriginal;
  }

  public function setThumbDestination($path) {
	if (!is_dir($path) || !is_writable($path)) {
	  throw new Exception("$path must be a valid, writable directory.");
	}
    $this->_thumbDestination = $path;
  }

  public function setThumbSuffix($suffix) {
	if (preg_match('/\w+/', $suffix)) {
	  if (strpos($suffix, '_') !== 0) {
	    $this->_suffix = '_' . $suffix;
	  } else {
		$this->_suffix = $suffix;
	  }
	} else {
      $this->_suffix = ''; 
	}
  }

  protected function createThumbnail($image) {
	$thumb = new Ps2_Thumbnail($image);
	$thumb->setDestination($this->_thumbDestination);
	$thumb->setSuffix($this->_suffix);
	$thumb->create();
	$messages = $thumb->getMessages();
	$this->_messages = array_merge($this->_messages, $messages);
  }

  protected function processFile($filename, $error, $size, $type, $tmp_name, $overwrite) {
	$OK = $this->checkError($filename, $error);
	if ($OK) {
	  $sizeOK = $this->checkSize($filename, $size);
	  $typeOK = $this->checkType($filename, $type);
	  if ($sizeOK && $typeOK) {
		$name = $this->checkName($filename, $overwrite);
		$success = move_uploaded_file($tmp_name, $this->_destination . $name);
		if ($success) {
		  // don't add a message if the original image is deleted
		  if (!$this->_deleteOriginal) {
			$message = "$filename uploaded successfully";
			if ($this->_renamed) {
			  $message .= " and renamed $name";
			}
			$this->_messages[] = $message;
		  }
		  // create a thumbnail from the uploaded image
		  $this->createThumbnail($this->_destination . $name);
		  // delete the uploaded image if required
		  if ($this->_deleteOriginal) {
			unlink($this->_destination . $name); 
		  }
		} else {
		  $this->_messages[] = "Could not upload $filename";
		}
	  }
	}
  }

}