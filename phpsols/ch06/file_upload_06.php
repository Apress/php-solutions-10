<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8">
<title>Multiple Upload</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" id="uploadImage">
  <p>
    <label for="image">Upload images (multiple selections permitted):</label>
    <input type="file" name="image[]" id="image" multiple>
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