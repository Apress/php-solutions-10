<?php
// if the form has been submitted, process the input text
if (isset($_POST['putContents'])) {
  
  $filename = 'C:/private/filetest_04.txt';
  // open a file for reading and writing
  $file = fopen($filename, 'r+');
  
  // the pointer is at the beginning, so existing content is overwritten
  // uncomment the next line to move the pointer to the end
  // fseek($file, 0, SEEK_END);
  fwrite($file, $_POST['contents']);
  
  // read the contents from the current position
  $readRest = '';
  while (!feof($file)) {
    $readRest .= fgets($file);
  }
  
  // reset internal pointer to the beginning
  rewind($file);
  // read the contents from the beginning (nasty gotcha here)
  // file has not been closed, so filesize refers to original size
  $readAll = fread($file, filesize($filename));
  
  // uncomment the next four lines when adding content at end
  // $readAll = '';
  // while (!feof($file)) {
  //   $readAll .= fgets($file);
  // }

  // pointer now at the end, so write the form contents again
  fwrite($file, $_POST['contents']);
  
  // read immediately without moving the pointer
  $readAgain = '';
  while (!feof($file)) {
    $readAgain .= fgets($file);
  }
  
  // close the file
  fclose($file);
  }
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Moving the pointer</title>
</head>

<body>
<?php
if (isset($readRest)) {
  echo "<p><strong>Read after first write operation:</strong> $readRest</p>";
  echo "<p><strong>Read after rewinding pointer:</strong> $readAll</p>";
  echo "<p><strong>Read after second write operation:</strong> $readAgain</p>";
  }
?>
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
