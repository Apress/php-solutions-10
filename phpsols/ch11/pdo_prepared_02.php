<?php
if (isset($_GET['go'])) {
  require_once('../includes/connection.inc.php');
  $conn = dbConnect('read', 'pdo');
  $sql = 'SELECT image_id, filename, caption FROM images WHERE caption LIKE :search';
  $searchterm = '%'. $_GET['search'] .'%';
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':search', $searchterm, PDO::PARAM_STR);
  $stmt->bindColumn('image_id', $image_id);
  $stmt->bindColumn('filename', $filename);
  $stmt->bindColumn(3, $caption);
  $stmt->execute();
  $numRows = $stmt->rowCount();
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>PDO Prepared Statement</title>
</head>

<body>
<form id="form1" method="get" action="">
  <input type="text" name="search" id="search">
  <input type="submit" name="go" id="go" value="Search">
</form>
<?php if (isset($_GET['search'])) { ?>
<p>Number of results for <b><?php echo htmlentities($_GET['search'], ENT_COMPAT, 'utf-8'); ?></b>: <?php echo $numRows; ?></p>
<?php //if ($numRows) { ?>
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
//} ?>
</body>
</html>