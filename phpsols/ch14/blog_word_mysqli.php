<?php
include('../includes/title.inc.php');
require_once('../includes/connection.inc.php');
// create database connection
$conn = dbConnect('read');
$sql = 'SELECT article_id, title, LEFT(article, 100) AS first100
        FROM blog ORDER BY created DESC';
$result = $conn->query($sql);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Japan Journey<?php if (isset($title)) {echo "&#8212;{$title}";} ?></title>
<link href="../styles/journey.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body>
<div id="header">
    <h1>Japan Journey </h1>
</div>
<div id="wrapper">
    <?php include('../includes/menu.inc.php'); ?>
    <div id="maincontent">
      <?php
      while ($row = $result->fetch_assoc()) {
      ?>
        <h2><?php echo $row['title']; ?></h2>
          <p><?php $extract = $row['first100'];
			  // find position of last space in extract
			  $lastSpace = strrpos($extract, ' ');
			  // use $lastSpace to set length of new extract and add ...
			  echo substr($extract, 0, $lastSpace) . '... ';
		      ?>
            <a href="details.php?article_id=<?php $row['article_id']; ?>"> More</a></p>
      <?php } ?>
    </div>
    <?php include('../includes/footer.inc.php'); ?>
</div>
</body>
</html>
