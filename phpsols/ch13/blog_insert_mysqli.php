<?php
if (isset($_POST['insert'])) {
  require_once('../includes/connection.inc.php');
  // initialize flag
  $OK = false;
  // create database connection
  $conn = dbConnect('write');
  // initialize prepared statement
  $stmt = $conn->stmt_init();
  // create SQL
  $sql = 'INSERT INTO blog (title, article, created)
		  VALUES(?, ?, NOW())';
  if ($stmt->prepare($sql)) {
	// bind parameters and execute statement
	$stmt->bind_param('ss', $_POST['title'], $_POST['article']);
    // execute and get number of affected rows
	$stmt->execute();
	if ($stmt->affected_rows > 0) {
	  $OK = true;
	}
  }
  // redirect if successful or display error
  if ($OK) {
	header('Location: http://localhost/phpsols/admin/blog_list_mysqli.php');
	exit;
  } else {
	$error = $stmt->error;
  }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Insert Blog Entry</title>
<link href="../styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Insert New Blog Entry</h1>
<?php if (isset($error)) {
  echo "<p>Error: $error</p>";
} ?>
<form id="form1" method="post" action="">
  <p>
    <label for="title">Title:</label>
    <input name="title" type="text" class="widebox" id="title">
  </p>
  <p>
    <label for="article">Article:</label>
    <textarea name="article" cols="60" rows="8" class="widebox" id="article"></textarea>
  </p>
  <p>
    <input type="submit" name="insert" value="Insert New Entry" id="insert">
  </p>
</form>
</body>
</html>