<?php
  
// Store the file name into variable
$file = 'http://localhost/arims-system/files/'.$_POST['fileName'];
$filename = 'HOME.pdf';
  
/*// Header content type
header('Content-type: application/pdf');
  
header('Content-Disposition: inline; filename="' . $filename . '"');
  
header('Content-Transfer-Encoding: binary');
  
header('Accept-Ranges: bytes');*/
header("Content-type: application/pdf");
  
header("Content-Length: " . filesize($file));
  
// Send the file to the browser.
readfile($file);
// Read the file
//@readfile($file);
  
?>