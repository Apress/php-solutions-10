<?php
require_once('../includes/connection.inc.php');
// initialize flags
$OK = false;
$done = false;
// create database connection
$conn = dbConnect('write', 'pdo');
// get details of selected record
if (isset($_GET['article_id']) && !$_POST) {
  // prepare SQL query
  $sql = 'SELECT article_id, title, article FROM blog
		  WHERE article_id = ?';
  $stmt = $conn->prepare($sql);
  // bind the results
  $stmt->bindColumn(1, $article_id);
  $stmt->bindColumn(2, $title);
  $stmt->bindColumn(3, $article);
  // execute query by passing array of variables
  $OK = $stmt->execute(array($_GET['article_id']));
  $stmt->fetch();
}
// redirect if $_GET['article_id'] not defined
if (!isset($_GET['article_id'])) {
  header('Location: http://localhost/phpsols/admin/blog_list_pdo.php');
  exit;
}
// display error message if query fails
if (isset($stmt) && !$OK && !$done) {
  $error = $stmt->errorInfo();
  if (isset($error[2])) {
	$error = $error[2];
  }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Update Blog Entry</title>
<link href="../styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Update Blog Entry</h1>
<p><a href="blog_list_pdo.php">List all entries </a></p>
<?php 
if (isset($error)) {
  echo "<p class='warning'>Error: $error</p>";
}
if($article_id == 0) { ?>
  <p class="warning">Invalid request: record does not exist.</p>
<?php } else { ?>
<form id="form1" method="post" action="">
  <p>
    <label for="title">Title:</label>
    <input name="title" type="text" class="widebox" id="title" value="<?php echo htmlentities($title, ENT_COMPAT, 'utf-8'); ?>">
  </p>
  <p>
    <label for="article">Article:</label>
    <textarea name="article" cols="60" rows="8" class="widebox" id="article"><?php echo htmlentities($article, ENT_COMPAT, 'utf-8'); ?></textarea>
  </p>
  <p>
    <input type="submit" name="update" value="Update Entry" id="update">
    <input name="article_id" type="hidden" value="<?php echo $article_id; ?>">
  </p>
</form>
<?php } ?>
</body>
</html>