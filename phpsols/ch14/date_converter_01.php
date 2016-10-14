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
      <option value=""></option>
    </select>
    <label for="day">Date:</label>
    <input name="day" type="number" required="required" id="day" max="31" min="1" maxlength="2">
    <label for="year">Year:</label>
    <input name="year" type="number" required="required" id="year" maxlength="4">
  </p>
  <p>
    <input type="submit" name="convert" id="convert" value="Convert">
  </p>
</form>
</body>
</html>