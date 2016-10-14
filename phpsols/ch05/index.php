<?php ob_start();
try {
  include('./includes/title.inc.php');
  include('./includes/random_image.php'); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8">
<title>Japan Journey
<?php if (isset($title)) {echo "&#8212;{$title}";} ?>
</title>
<link href="styles/journey.css" rel="stylesheet" type="text/css" media="screen">
<?php
if (isset($imageSize)) {
?>
<style>
#caption {
 width: <?php echo $imageSize[0];
?>px;
}
</style>
<?php } ?>
</head>

<body>
<div id="header">
  <h1>Japan Journey</h1>
</div>
<div id="wrapper">
<?php
  $file = 'includes/menu.inc.php';
  if (file_exists($file) && is_readable($file)) {
    include($file);
  } else {
    throw new Exception("$file can't be found"); } ?>
  <div id="maincontent">
    <h2>A Journey through Japan with PHP</h2>
    <p>One of the benefits of using PHP is that you can extract common page elements such as the menu and footer, and turn them into server-side includes. Using PHP functions and conditional logic, you can automatically change  the page title and indicate the current page in the menu. Generating a random image on the front page also adds interest to the site.</p>
    <?php if (isset($imageSize)) { ?>
      <div id="pictureWrapper"><img src="<?php echo $selectedImage; ?>" alt="Random image" class="picBorder" <?php echo $imageSize[3]; ?>>
        <p id="caption"><?php echo $caption; ?></p>
      </div>
      <?php } ?>
    <p>Ut enim ad minim veniam, quis nostrud exercitation consectetur adipisicing elit. Velit esse cillum dolore ullamco laboris nisi in reprehenderit in voluptate. Mollit anim id est laborum. Sunt in culpa duis aute irure dolor excepteur sint occaecat.</p>
    <p>Eu fugiat nulla pariatur. Ut labore et dolore magna aliqua. Cupidatat non proident, quis nostrud exercitation ut enim ad minim veniam. Quis nostrud exercitation eu fugiat nulla pariatur. Ut labore et dolore magna aliqua. Sed do eiusmod tempor incididunt velit esse cillum dolore ullamco laboris nisi.</p>
    <p>Sed do eiusmod tempor incididunt ullamco laboris nisi consectetur adipisicing elit. Ut aliquip ex ea commodo consequat. Qui officia deserunt ut labore et dolore magna aliqua. Velit esse cillum dolore eu fugiat nulla pariatur. Sed do eiusmod tempor incididunt cupidatat non proident, sunt in culpa. Sunt in culpa duis aute irure dolor excepteur sint occaecat.</p>
    <p>Quis nostrud exercitation eu fugiat nulla pariatur. Ut labore et dolore magna aliqua. Sunt in culpa duis aute irure dolor excepteur sint occaecat.</p>
  </div>
  <?php include('./includes/footer.inc.php'); ?>
</div>
</body>
</html>
<?php } catch (Exception $e) {
  ob_end_clean();
  header('Location: http://localhost/phpsols2e/error.php');
}
ob_end_flush();
?>