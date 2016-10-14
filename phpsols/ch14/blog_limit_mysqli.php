<?php
include('./includes/title.inc.php');
require_once('./includes/connection.inc.php');
require_once('./includes/utility_funcs.inc.php');
// create database connection
$conn = dbConnect('read');
$sql = 'SELECT * FROM blog 
        WHERE updated > DATE_SUB(NOW(), INTERVAL 1 WEEK)
        ORDER BY created DESC';
$result = $conn->query($sql);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Japan Journey<?php if (isset($title)) {echo "&#8212;{$title}";} ?></title>
<link href="styles/journey.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body>
<div id="header">
    <h1>Japan Journey </h1>
</div>
<div id="wrapper">
    <?php include('./includes/menu.inc.php'); ?>
    <div id="maincontent">
      <?php
      while ($row = $result->fetch_assoc()) {
      ?>
        <h2><?php echo $row['title']; ?></h2>
          <p><?php $extract = getFirst($row['article']);
            echo $extract[0];
            if ($extract[1]) {
              echo '<a href="details.php?article_id=' . $row['article_id'] . '"> More</a>';
              } ?></p>
      <?php } ?>
    </div>
    <?php include('./includes/footer.inc.php'); ?>
</div>
</body>
</html>
