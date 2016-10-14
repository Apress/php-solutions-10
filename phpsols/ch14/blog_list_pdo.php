<?php
include('../includes/connection.inc.php');
// create database connection
$conn = dbConnect('read', 'pdo');
$sql = 'SELECT article_id, title,
        DATE_FORMAT(created, "%a, %b %D, %Y") AS date_created
		FROM blog ORDER BY created DESC';
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
<p><a href="blog_insert_pdo.php">Insert new entry</a></p>
<table>
  <tr>
    <th scope="col">Created</th>
    <th scope="col">Title</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  <?php foreach ($conn->query($sql) as $row) { ?>
  <tr>
    <td><?php echo $row['date_created']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><a href="blog_update_pdo.php?article_id=<?php echo $row['article_id']; ?>">EDIT</a></td>
    <td><a href="blog_delete_pdo.php?article_id=<?php echo $row['article_id']; ?>">DELETE</a></td>
  </tr>
  <?php } ?>
</table>
</body>
</html>