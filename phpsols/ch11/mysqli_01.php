<?php
require_once('../includes/connection.inc.php');
// connect to MySQL
$conn = dbConnect('read');
// prepare the SQL query
$sql = 'SELECT * FROM images';
// submit the query and capture the result
$result = $conn->query($sql) or die(mysqli_error());
// find out how many records were retrieved
$numRows = $result->num_rows;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Connecting with MySQLi</title>
</head>

<body>
<p>A total of <?php echo $numRows; ?> records were found.</p>
</body>
</html>