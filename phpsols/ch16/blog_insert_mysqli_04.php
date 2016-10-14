<?php
require_once('../includes/connection.inc.php');
// create database connection
$conn = dbConnect('write');
if (isset($_POST['insert'])) {
  // initialize flag
  $OK = false;
  // initialize prepared statement
  $stmt = $conn->stmt_init();

  // if a file has been uploaded, process it
  if(isset($_POST['upload_new']) && $_FILES['image']['error'] == 0) {
	$imageOK = false;
	require_once('../classes/Ps2/Upload.php');
	$upload = new Ps2_Upload('../images/');
	$upload->move();
	$names = $upload->getFilenames();
	// $names will be an empty array if the upload failed
	if ($names) {
	  $sql = 'INSERT INTO images (filename, caption)
			  VALUES (?, ?)';
	  $stmt->prepare($sql);
	  $stmt->bind_param('ss', $names[0], $_POST['caption']);
	  $stmt->execute();
	  $imageOK = $stmt->affected_rows;
	}
	// get the image's primary key or find out what went wrong
	if ($imageOK) {
	  $image_id = $stmt->insert_id;
	} else {
	  $imageError = implode(' ', $upload->getMessages());
	}
  } elseif (isset($_POST['image_id']) && !empty($_POST['image_id'])) {
	// get the primary key of a previously uploaded image
	$image_id = $_POST['image_id'];
  }

  // don't insert blog details if the image failed to upload
  if (!isset($imageError)) {
	// if $image_id has been set, insert it as a foreign key
	if (isset($image_id)) {
	  $sql = 'INSERT INTO blog (image_id, title, article, created)
			  VALUES(?, ?, ?, NOW())';
	  $stmt->prepare($sql);
      $stmt->bind_param('iss', $image_id, $_POST['title'], $_POST['article']);
	} else {
	  // create SQL
	  $sql = 'INSERT INTO blog (title, article, created)
			  VALUES(?, ?, NOW())';
	  $stmt->prepare($sql);
	  $stmt->bind_param('ss', $_POST['title'], $_POST['article']);
	}
	// execute and get number of affected rows
	$stmt->execute();
	$OK = $stmt->affected_rows;
  }
 
  // if the blog entry was inserted successfully, check for categories
  if ($OK && isset($_POST['category'])) {
	// get the article's primary key
	$article_id = $stmt->insert_id;
	foreach ($_POST['category'] as $cat_id) {
	  if (is_numeric($cat_id)) {
		$values[] = "($article_id, " . (int) $cat_id . ')';
	  }
	}
	if ($values) {
	  $sql = 'INSERT INTO article2cat (article_id, cat_id)
	          VALUES ' . implode(',', $values);
      // execute the query and get error message if it fails
	  if (!$conn->query($sql)) {
		$catError = $conn->error;
	  }
	}
  }

  // redirect if successful or display error
  if ($OK && !isset($imageError) && !isset($catError)) {
	header('Location: http://localhost/phpsols/admin/blog_list_mysqli.php');
	exit;
  } else {
	$error = $stmt->error;
	if (isset($imageError)) {
	  $error .= ' ' . $imageError;
	}
	if (isset($catError)) {
	  $error .= ' ' . $catError;
	}
  }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Insert Blog Entry</title>
<link href="../styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Insert New Blog Entry</h1>
<?php if (isset($error)) {
  echo "<p>Error: $error</p>";
} ?>
<form id="form1" method="post" action="" enctype="multipart/form-data">
  <p>
    <label for="title">Title:</label>
    <input name="title" type="text" class="widebox" id="title" value="<?php if (isset($error)) {
	  echo htmlentities($_POST['title'], ENT_COMPAT, 'utf-8');
	} ?>">
  </p>
  <p>
    <label for="article">Article:</label>
    <textarea name="article" cols="60" rows="8" class="widebox" id="article"><?php if (isset($error)) {
	  echo htmlentities($_POST['article'], ENT_COMPAT, 'utf-8');
	} ?></textarea>
  </p>
  <p>
    <label for="category">Categories:</label>
    <select name="category[]" size="5" multiple id="category">
    <?php
	// get categories
	$getCats = 'SELECT cat_id, category FROM categories
	            ORDER BY category';
	$categories = $conn->query($getCats);
	while ($row = $categories->fetch_assoc()) {
	?>
    <option value="<?php echo $row['cat_id']; ?>" <?php
    if (isset($_POST['category']) && in_array($row['cat_id'], $_POST['category'])) {
	  echo 'selected';
	} ?>><?php echo $row['category']; ?></option>
    <?php } ?>
    </select>
  </p>
  <p>
    <label for="image_id">Uploaded image:</label>
    <select name="image_id" id="image_id">
      <option value="">Select image</option>
            <?php
	  // get the list of images
	  $getImages = 'SELECT image_id, filename
	                FROM images ORDER BY filename';
	  $images = $conn->query($getImages);
	  while ($row = $images->fetch_assoc()) {
	  ?>
      <option value="<?php echo $row['image_id']; ?>"
      <?php
	  if (isset($_POST['image_id']) && $row['image_id'] == $_POST['image_id']) {
		echo 'selected';
	  }
	  ?>><?php echo $row['filename']; ?></option>
      <?php } ?>
    </select>
  </p>
  <p id="allowUpload">
    <input type="checkbox" name="upload_new" id="upload_new">
    <label for="upload_new">Upload new image</label>
  </p>
  <p class="optional">
    <label for="image">Select image:</label>
    <input type="file" name="image" id="image">
  </p>
  <p class="optional">
    <label for="caption">Caption:</label>
    <input name="caption" type="text" class="widebox" id="caption">
  </p>
  <p>
    <input type="submit" name="insert" value="Insert New Entry">
  </p>
</form>
<script src="toggle_fields.js"></script>
</body>
</html>