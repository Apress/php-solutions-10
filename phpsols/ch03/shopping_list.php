<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Foreach loop - shopping list</title>
</head>

<body>
<?php
$shoppingList = array('wine', 'fish', 'bread', 'grapes', 'cheese');
foreach ($shoppingList as $item) {
  echo $item . '<br>';
  }
?>
</body>
</html>
