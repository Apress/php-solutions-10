<?php
require_once('../includes/connection.inc.php');
$conn = dbConnect('read', 'pdo');
$getImages = 'SELECT image_id, filename FROM images';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>PDO: Insert Integer in SQL</title>
<style>
figure {
	margin: 30px;
	display:block;
}
figcaption {
	font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;
	font-weight:bold;
	display:inline-block;
	max-width:250px;
	margin:10px;
}
</style>
</head>

<body>
<form action="" method="get" id="form1">
  <select name="image_id" id="image_id">
    <?php foreach ($conn->query($getImages) as $row) { ?>
    <option value="<?php echo $row['image_id']; ?>"
    <?php if (isset($_GET['image_id']) && $_GET['image_id'] == $row['image_id']) {
	  echo 'selected';
	} ?>
    ><?php echo $row['filename']; ?></option>
    <?php } ?>
  </select>
  <input type="submit" name="go" id="go" value="Display">
</form>
</body>
</html>