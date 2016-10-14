<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8">
<title>Multiple Upload for Older Browsers</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" id="uploadImage">
  <p>
    <label for="image">Upload image:</label>
    <input type="file" name="image[]" id="image">
  </p>
  <p>
    <label for="image2">Upload image:</label>
    <input type="file" name="image[]" id="image2">
  </p>
  <p>
    <label for="image3">Upload image:</label>
    <input type="file" name="image[]" id="image3">
  </p>
  <p>
    <input type="submit" name="upload" id="upload" value="Upload">
  </p>
</form>
<pre>
<?php
if (isset($_POST['upload'])) {
  print_r($_FILES);
}
?>
</pre>
</body>
</html>