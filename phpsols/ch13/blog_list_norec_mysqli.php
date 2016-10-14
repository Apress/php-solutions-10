<?php
require_once('../includes/connection.inc.php');
// create database connection
$conn = dbConnect('read');
$sql = 'SELECT * FROM blog ORDER BY created DESC';
$result = $conn->query($sql) or die(mysqli_error());
###################################
# Get the number of records found #
###################################
$numRows = $result->num_rows;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Manage Blog Entries</title>
<link href="../styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Manage Blog Entries</h1>
<p><a href="blog_insert_mysqli.php">Insert new entry</a></p>
<?php
#######################################
# Display message if no records found #
#######################################
if ($numRows == 0) {
?>
  <p>No records found</p>
<?php
##################################
# Otherwise, display the results #
##################################
} else {
?>
<table>
  <tr>
    <th scope="col">Created</th>
    <th scope="col">Title</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  <?php while($row = $result->fetch_assoc()) { ?>
  <tr>
    <td><?php echo $row['created']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><a href="blog_update_mysqli.php?article_id=<?php echo $row['article_id']; ?>">EDIT</a></td>
    <td><a href="blog_delete_mysqli.php?article_id=<?php echo $row['article_id']; ?>">DELETE</a></td>
  </tr>
  <?php } ?>
</table>
<?php
####################################################
# Close the else clause wrapping the results table #
####################################################
}
?>
</body>
</html>