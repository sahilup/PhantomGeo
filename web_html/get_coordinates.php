<?php
// Read the contents of the coordinates file
$fileContent = file_get_contents('coordinates.txt');

// Echo the file content
echo nl2br($fileContent);
?>
