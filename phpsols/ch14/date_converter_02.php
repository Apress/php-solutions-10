<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Convert Date to MySQL Format</title>
<style>
input[type="number"] {
	width:50px;
}
</style>
</head>

<body>
<form id="form1" method="post" action="">
  <p>
    <label for="select">Month:</label>
        <select name="month" id="month">
          <?php
          $months = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug', 'Sep','Oct','Nov','Dec');
          $thisMonth = date('n');
          for ($i = 1; $i <= 12; $i++) { ?>
            <option value="<?php echo $i; ?>"
            <?php if ($i == $thisMonth) { echo ' selected'; } ?>>
            <?php echo $months[$i-1]; ?>
            </option>
          <?php } ?>
        </select>
    <label for="day">Date:</label>
    <input name="day" type="number" required id="day" max="31" min="1" maxlength="2">
    <label for="year">Year:</label>
    <input name="year" type="number" required id="year" maxlength="4">
  </p>
  <p>
    <input type="submit" name="convert" id="convert" value="Convert">
  </p>
</form>
<?php
if (isset($_POST['convert'])) {
  require_once('utility_funcs.inc.php');
  $converted = convertDateToMySQL($_POST['month'], $_POST['day'], $_POST['year']);
  if ($converted[0]) {
	echo 'Valid date: ' . $converted[1];
  } else {
	echo 'Error: ' . $converted[1] . '<br>';
	echo 'Input was: ' . $months[$_POST['month']-1] . ' ' . $_POST['day'] . ', ' . $_POST['year'];
  }
}
?>
</body>
</html>