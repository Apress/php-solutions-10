<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Update Blog Entry</title>
<link href="../styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Update Blog Entry</h1>
<p><a href="blog_list_mysqli.php">List all entries </a></p>
<form id="form1" method="post" action="">
  <p>
    <label for="title">Title:</label>
    <input name="title" type="text" class="widebox" id="title">
  </p>
  <p>
    <label for="article">Article:</label>
    <textarea name="article" cols="60" rows="8" class="widebox" id="article"></textarea>
  </p>
  <p>
    <input type="submit" name="update" value="Update Entry" id="update">
  </p>
</form>
</body>
</html>