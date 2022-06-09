<?php  
if(isset($_POST["submit"])) {
    $file_url = 'http://localhost/arims-system/files/'.$_POST['fileToUpload'];  
    header('Content-Type: application/octet-stream');  
    header("Content-Transfer-Encoding: Binary");   
    header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");   
    readfile($file_url);  
}
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="downloadfile.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="input" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
<form action="openfile.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="input" name="fileName" id="fileName">
  <input type="submit" value="Upload Image" name="submit">
</form>
</body>
</html>