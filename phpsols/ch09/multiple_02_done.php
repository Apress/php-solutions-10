<?php
$firstPage = 'multiple_01.php';
$nextPage = 'multiple_03.php';
$submit = 'next';
require_once('../includes/multiform.inc.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Multiple form 2</title>
</head>

<body>
<?php if (isset($missing)) { ?>
<p> Please fix the following required fields:</p>
  <ul>
  <?php 
  foreach ($missing as $item) {
    echo "<li>$item</li>";
  }
  ?>
  </ul>
<?php } ?>
<form id="form1" name="form1" method="post" action="">
    <p>
        <label for="age">Age:</label>
        <input type="number" name="age" id="age">
    </p>
    <p>
        <input type="submit" name="next" value="Next &gt;">
    </p>
</form>
</body>
</html>
