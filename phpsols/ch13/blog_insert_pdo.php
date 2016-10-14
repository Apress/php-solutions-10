<?php
if (isset($_POST['insert'])) {
  require_once('../includes/connection.inc.php');
  // initialize flag
  $OK = false;
  // create database connection
  $conn = dbConnect('write', 'pdo');
  // create SQL
  $sql = 'INSERT INTO blog (title, article, created)
		  VALUES(:title, :article, NOW())';
  // prepare the statement
  $stmt = $conn->prepare($sql);
  // bind the parameters and execute the statement
  $stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
  $stmt->bindParam(':article', $_POST['article'], PDO::PARAM_STR);
  // execute and get number of affected rows
  $stmt->execute();
  $OK = $stmt->rowCount();
  // redirect if successful or display error
  if ($OK) {
	header('Location: http://localhost/phpsols/admin/blog_list_pdo.php');
	exit;
  } else {
	$error = $stmt->errorInfo();
	if (isset($error[2])) {
	  $error = $error[2];
    }
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