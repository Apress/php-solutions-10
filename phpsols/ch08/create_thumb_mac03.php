<?php
if (isset($_POST['create'])) {
  require_once('../classes/Ps2/Thumbnail.php');
  try {
	$thumb = new Ps2_Thumbnail($_POST['pix']);
	$thumb->setDestination('C:/upload_test/thumbs/');
	$thumb->setMaxSize(100);
	$thumb->setSuffix('small');
	$thumb->create();
	$thumb->test();
  } catch (Exception $e) {
	echo $e->getMessage();
  }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Create Thumbnail</title>
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
  <form id="form1" name="form1" method="post" action="">
    <p>
      <select name="pix" id="pix">
        <option value="">Select an image</option>
        <?php
	$files = new DirectoryIterator('../images');
	$images = new RegexIterator($files, '/\.(?:jpg|png|gif)$/i');
	foreach ($images as $image) {
	?>
        <option value="/Applications/MAMP/htdocs/phpsols/images/<?php echo $image; ?>"><?php echo $image; ?></option>
        <?php } ?>
      </select>
    </p>
    <p>
      <input type="submit" name="create" id="create" value="Create Thumbnail">
    </p>
  </form>
</body>
</html>