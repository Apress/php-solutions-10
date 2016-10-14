<?php
// if the form has been submitted, process the input text
if (isset($_POST['putContents'])) {
  // create a file ready for writing only if it doesn't already exist
  $file = fopen('C:/private/filetest_04.txt', 'x');
  // write the contents
  fwrite($file, $_POST['contents']);
  // close the file
  fclose($file);
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Exclusive write</title>
</head>

<body>
<form id="writeFile" name="writeFile" method="post" action="">
    <p>
        <label for="contents">Write this to file:</label>
        <textarea name="contents" cols="40" rows="6" id="contents"></textarea>
    </p>
    <p>
        <input name="putContents" type="submit" id="putContents" value="Write to file">
    </p>
</form>
</body>
</html>
