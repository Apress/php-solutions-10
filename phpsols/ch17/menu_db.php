<?php
require_once('../includes/session_timeout_db.inc.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Secret menu</title>
</head>

<body>
<h1>Restricted area</h1>
<p><a href="secretpage_db.php">Another secret page</a> </p>
<?php include('../includes/logout_db.inc.php'); ?>
</body>
</html>
