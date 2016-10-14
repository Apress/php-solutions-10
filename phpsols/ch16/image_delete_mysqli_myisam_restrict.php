<?php
include('../includes/connection.inc.php');
$conn = dbConnect('write');
// initialize flags
$OK = false;
$deleted = false;
// initialize statement
$stmt = $conn->stmt_init();
// get details of selected record
if (isset($_GET['image_id']) && !$_POST) {
  // prepare SQL query
  $sql = 'SELECT image_id, filename, caption
          FROM images WHERE image_id = ?';
  $stmt->prepare($sql);
  // bind the query parameters
  $stmt->bind_param('i', $_GET['image_id']);
  // bind the result to variables
  $stmt->bind_result($image_id, $filename, $caption);
  // execute the query, and fetch the result
  $stmt->execute();
  $stmt->fetch();
}
// if confirm deletion button has been clicked, delete record
if (isset($_POST['delete'])) {
  $sql = 'SELECT image_id FROM blog WHERE image_id = ?';
  $stmt->prepare($sql);
  $stmt->bind_param('i', $_POST['image_id']);
  $stmt->execute();
  // if num_rows is not 0, there are dependent records
  if ($stmt->num_rows) {
	$error = 'That image has dependent records in a child table, and cannot be deleted.';
  } else {
	$sql = 'DELETE FROM images WHERE image_id = ?';
	$stmt->prepare($sql);
	$stmt->bind_param('i', $_POST['image_id']);
	$stmt->execute();
	if ($stmt->affected_rows == 1) {
	  $deleted = true;
	} else {
	  $deleted = false;
	  $error = 'There was a problem deleting the record.';
	}
  }
  // To delete the image, you also need to pass the filename and path to unlink
  if ($deleted) {
	ulink('../images/' . $filename);
  }
}
// redirect the page if deletion is successful, 
// cancel button clicked, or $_GET['image_id'] not defined
if ($deleted || isset($_POST['cancel_delete']) || !isset($_GET['image_id']))  {
  header('Location: ' . $image_list); // you need to create an image list similar to blog_list_mysqli.php
  exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Delete Image</title>
<link href="../styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Delete Image </h1>
<?php 
if (isset($error)) {
  echo "<p class='warning'>Error: $error</p>";
} elseif(isset($image_id) && $image_id == 0) { ?>
<p class="warning">Invalid request: record does not exist.</p>
<?php } else { ?>
<p class="warning">Please confirm that you want to delete the following image. This action cannot be undone.</p>
<p><img src="../images/<?php echo $filename; ?>" alt=""></p>
<p><?php echo $caption; ?></p>
<?php } ?>
<form id="form1" method="post" action="">
    <p>
	<?php if(isset($image_id) && $image_id > 0) { ?>
        <input type="submit" name="delete" value="Confirm Deletion">
	<?php } ?>
		<input name="cancel_delete" type="submit" id="cancel_delete" value="Cancel">
	<?php if(isset($image_id) && $image_id > 0) { ?>
		<input name="image_id" type="hidden" value="<?php echo $image_id; ?>">
	<?php } ?>
    </p>
</form>
</body>
</html>
