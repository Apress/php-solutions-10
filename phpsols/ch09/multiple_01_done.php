<?php
if (isset($_POST['next'])) {
  session_start();
  // set a variable to control access to other pages
  $_SESSION['formStarted'] = true;
  // set required fields
  $required = 'first_name';
  $firstPage = 'multiple_01.php';
  $nextPage = 'multiple_02.php';
  $submit = 'next';
  require_once('../includes/multiform.inc.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Multiple form 1</title>
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
<form id="form1" method="post" action="">
    <p>
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required>
    </p>
    <p>
      <label for="family_name">Family Name:</label>
      <input type="text" name="family_name" id="family_name">
    </p>
    <p>
        <input type="submit" name="next" value="Next &gt;">
    </p>
</form>
</body>
</html>
