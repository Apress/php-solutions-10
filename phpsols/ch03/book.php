<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Foreach loop - book</title>
</head>

<body>
<?php
$book = array('title'     => 'PHP Solutions: Dynamic Web Design Made Easy, Second Edition',
              'author'    => 'David Powers',
              'publisher' => 'friends of ED',
              'ISBN'      => '978-1-4302-3249-0');
foreach ($book as $key => $value) {
  echo "The value of $key is $value<br>";
  }
?>
</body>
</html>
