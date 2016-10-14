<?php
if (isset($_GET['go'])) {
  require_once('../includes/connection.inc.php');
  $conn = dbConnect('read');
  $sql = 'SELECT image_id, filename, caption FROM images WHERE caption LIKE ?';
  $searchterm = '%'. $_GET['search'] .'%';
  $stmt = $conn->stmt_init();
  if ($stmt->prepare($sql)) {
    $stmt->bind_param('s', $searchterm);
	$stmt->bind_result($image_id, $filename, $caption);
	$stmt->execute();
	$stmt->store_result();
	$numRows = $stmt->num_rows;
  } else {
	echo $stmt->error;
  }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>MySQLi Prepared Statement</title>
</head>

<body>
<form id="form1" method="get" action="">
  <input type="text" name="search" id="search">
  <input type="submit" name="go" id="go" value="Search">
</form>
<?php if (isset($numRows)) { ?>
<p>Number of results for <b><?php echo htmlentities($_GET['search'], ENT_COMPAT, 'utf-8'); ?></b>: <?php echo $numRows; ?></p>
<?php if ($numRows) { ?>
<table>
  <tr>
    <th scope="col">image_id</th>
    <th scope="col">filename</th>
    <th scope="col">caption</th>
  </tr>
  <?php while ($stmt->fetch()) { ?>
  <tr>
    <td><?php echo $image_id; ?></td>
    <td><?php echo $filename; ?></td>
    <td><?php echo $caption; ?></td>
  </tr>
  <?php } ?>
</table>
<?php }
} ?>
</body>
</html>