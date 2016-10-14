<?php
// store the pathname of the file
$filename = 'C:/private/filetest_02.txt';
// open the file in read-only mode
$file = fopen($filename, 'r');
// read the file and store its contents
$contents = fread($file, filesize($filename));
// close the file
fclose($file);
// display the contents
echo nl2br($contents);