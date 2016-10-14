<?php
require_once('../includes/connection.inc.php');
// connect to MySQL
$conn = dbConnect('read', 'pdo');
// prepare the SQL query
$sql = 'SELECT * FROM images
        WHERE caption LIKE "%maiko%"';
// submit the query and capture the result
$result = $conn->query($sql);
$error = $conn->errorInfo();
if (isset($error[2])) die($error[2]);
// find out how many records were retrieved
$numRows = $result->rowCount();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Connecting with PDO: Using WHERE</title>
</head>

<body>
<p>A total of <?php echo $numRows; ?> records were found.</p>
<table>
  <tr>
    <th>image_id</th>
    <th>filename</th>
    <th>caption</th>
  </tr>
<?php foreach($conn->query($sql) as $row){ ?>
  <tr>
    <td><?php echo $row['image_id']; ?></td>
    <td><?php echo $row['filename']; ?></td>
    <td><?php echo $row['caption']; ?></td>
  </tr>
<?php }  ?>
</table>
</body>
</html>