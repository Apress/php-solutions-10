<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Automatically Generated Image Menu</title>
</head>

<body>
  <form id="form1" name="form1" method="post" action="">
  <select name="pix" id="pix">
    <option value="">Select an image</option>
    <?php
	$files = new DirectoryIterator('../images');
	$images = new RegexIterator($files, '/\.(?:jpg|png|gif)$/i');
	foreach ($images as $image) {
	?>
    <option value="<?php echo $image; ?>"><?php echo $image; ?></option>
    <?php } ?>
  </select>
  </form>
</body>
</html>