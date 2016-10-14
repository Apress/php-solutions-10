<?php
if (isset($_POST['upload'])) {
  require_once('../classes/Ps2/ThumbnailUpload.php');
  try {
	$upload = new Ps2_ThumbnailUpload('C:/upload_test/');
	$upload->setThumbDestination('C:/upload_test/thumbs/');
	$upload->move();
	$messages = $upload->getMessages();
  } catch (Exception $e) {
	echo $e->getMessage();
  }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8">
<title>Multiple Upload</title>
</head>

<body>
<?php
if (isset($messages) && !empty($messages)) {
  echo '<ul>';
  foreach ($messages as $message) {
	echo "<li>$message</li>";
  }
  echo '</ul>';
}
?>
<form action="" method="post" enctype="multipart/form-data" id="uploadImage">
  <p>
    <label for="image">Upload images (multiple selections permitted):</label>
    <input type="file" name="image[]" id="image" multiple>
  </p>
  <p>
    <input type="submit" name="upload" id="upload" value="Upload">
  </p>
</form>
</body>
</html>