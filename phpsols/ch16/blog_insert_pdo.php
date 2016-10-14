<?php
require_once('../includes/connection.inc.php');
// create database connection
$conn = dbConnect('write', 'pdo');
if (isset($_POST['insert'])) {
  // initialize flag
  $OK = false;

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
			  VALUES (:filename, :caption)';
	  $stmt = $conn->prepare($sql);
	  $stmt->bindParam(':filename', $names[0], PDO::PARAM_STR);
	  $stmt->bindParam(':caption', $_POST['caption'], PDO::PARAM_STR);
	  $stmt->execute();
	  $imageOK = $stmt->rowCount();
	}
	// get the image's primary key or find out what went wrong
	if ($imageOK) {
	  // PDO uses the lastInsertId() method on the connection object
	  $image_id = $conn->lastInsertId();
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
			  VALUES(:image_id, :title, :article, NOW())';
	  $stmt = $conn->prepare($sql);
	  // PDO binds parameters individually, so bind the image_id here
      $stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
	} else {
	  // create SQL
	  $sql = 'INSERT INTO blog (title, article, created)
			  VALUES(?, ?, NOW())';
	  $stmt = $conn->prepare($sql);
	}
	// both versions need to bind the title and article parameters
    $stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
	$stmt->bindParam(':article', $_POST['article'], PDO::PARAM_STR);
	// execute and get number of affected rows
	$stmt->execute();
	$OK = $stmt->rowCount();
  }
 
  // if the blog entry was inserted successfully, check for categories
  if ($OK && isset($_POST['category'])) {
	// get the article's primary key
	$article_id = $conn->lastInsertId();
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
		$catError = $conn->errorInfo();
		$catError = $catError[2];
	  }
	}
  }

  // redirect if successful or display error
  if ($OK && !isset($imageError) && !isset($catError)) {
	header('Location: http://localhost/phpsols/admin/blog_list_pdo.php');
	exit;
  } else {
	$error = $stmt->errorInfo();
	$error = $error[2];
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
	foreach($conn->query($getCats) as $row) {
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
	  foreach ($conn->query($getImages) as $row) {
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