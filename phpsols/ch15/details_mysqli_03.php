<?php
require_once('./includes/utility_funcs.inc.php');
require_once('./includes/connection.inc.php');
// connect to the database
$conn = dbConnect('read');
// check for article_id in query string
if (isset($_GET['article_id']) && is_numeric($_GET['article_id'])) {
  $article_id = (int) $_GET['article_id'];
} else {
  $article_id = 0;
}
$sql = "SELECT title, article, DATE_FORMAT(updated, '%W, %M %D, %Y') AS updated, filename, caption
	    FROM blog LEFT JOIN images USING (image_id)
	    WHERE blog.article_id = $article_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8">
<title>Japan Journey</title>
<link href="styles/journey.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body>
<div id="header">
    <h1>Japan Journey </h1>
</div>
<div id="wrapper">
    <?php include('./includes/menu.inc.php'); ?>
    <div id="maincontent">
        <h2><?php if ($row) {
          echo $row['title'];
        } else {
          echo 'No record found';
        }
        ?>
        </h2>
        <p><?php if ($row) { echo $row['updated']; } ?></p>
        <?php
        if ($row && !empty($row['filename'])) {
          $filename = "images/{$row['filename']}";
          $imageSize = getimagesize($filename);
        ?>
        <div id="pictureWrapper">
        <img src="<?php echo $filename; ?>" alt="<?php echo $row['caption']; ?>"
        <?php echo $imageSize[3];?>>
        </div>
        <?php } if ($row) { echo convertToParas($row['article']); } ?>
        <p><a href="
        <?php
        // check that browser supports $_SERVER variables
        if (isset($_SERVER['HTTP_REFERER']) && isset($_SERVER['HTTP_HOST'])) {
          $url = parse_url($_SERVER['HTTP_REFERER']);
          // find if visitor was referred from a different domain
          if ($url['host'] == $_SERVER['HTTP_HOST']) {
            // if same domain, use referring URL
            echo $_SERVER['HTTP_REFERER'];
          }
        } else {
          // otherwise, send to main page
          echo 'blog.php';
        } ?>">Back to the blog</a></p>
    </div>
    <?php include('./includes/footer.inc.php'); ?>
</div>
</body>
</html>
