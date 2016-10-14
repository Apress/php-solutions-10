<?php
if (isset($_GET['go'])) {
  require_once('../includes/connection.inc.php');
  $conn = dbConnect('read');
  $searchterm = '%' . $conn->real_escape_string($_GET['search']) . '%';
  $sql = "SELECT * FROM images WHERE caption LIKE '$searchterm'";
  $result = $conn->query($sql) or die($conn->error);
  $numRows = $result->num_rows;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Using the MySQLi real_escape_string() method</title>
</head>

<body>
<form id="form1" method="get" action="">
  <label for="search"></label>
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
  <?php while ($row = $result->fetch_assoc()) { ?>
  <tr>
    <td><?php echo $row['image_id']; ?></td>
    <td><?php echo $row['filename']; ?></td>
    <td><?php echo $row['caption']; ?></td>
  </tr>
  <?php } ?>
</table>
<?php }
} ?>
</body>
</html>