<?php
require_once('../includes/connection.inc.php');
// connect to MySQL
$conn = dbConnect('read', 'pdo');
// prepare the SQL query
$sql = "SELECT * FROM images
        ORDER BY image_id";
// submit the query and capture the result
$result = $conn->query($sql);
$error = $conn->errorInfo();
if (isset($error[2])) die($error[2]);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Connecting with PDO: Order by User Input</title>
</head>

<body>
<form id="form1" method="get" action="">
  <label for="column">Order by:</label>
  <select name="column" id="column">
    <option>image_id</option>
    <option>filename</option>
    <option>caption</option>
  </select>
  <select name="direction" id="direction">
    <option value="ASC">Ascending</option>
    <option value="DESC">Descending</option>
  </select>
  <input type="submit" name="change" id="change" value="Change">
</form>
<table>
  <tr>
    <th>image_id</th>
    <th>filename</th>
    <th>caption</th>
  </tr>
<?php foreach ($conn->query($sql) as $row) { ?>
  <tr>
    <td><?php echo $row['image_id']; ?></td>
    <td><?php echo $row['filename']; ?></td>
    <td><?php echo $row['caption']; ?></td>
  </tr>
<?php } ?>
</table>
</body>
</html>