<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Create Thumbnail</title>
</head>

<body>
  <form id="form1" name="form1" method="post" action="">
    <p>
      <select name="pix" id="pix">
        <option value="">Select an image</option>
        <?php
	$files = new DirectoryIterator('../images');
	$images = new RegexIterator($files, '/\.(?:jpg|png|gif)$/i');
	foreach ($images as $image) {
	?>
        <option value="C:/xampp/htdocs/phpsols/images/<?php echo $image; ?>"><?php echo $image; ?></option>
        <?php } ?>
      </select>
    </p>
    <p>
      <input type="submit" name="create" id="create" value="Create Thumbnail">
    </p>
  </form>
</body>
</html>