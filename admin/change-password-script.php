<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    include ('../database.php');
    
    //if(isset($_POST['oldpassword']) && isset($_GET['password1']) && isset($_GET['password2'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
    } 
       $oldpassword = validate($_POST['oldpassword']);
	   $newpassword1 = validate($_POST['password1']);
	   $newpassword2 = validate($_POST['password2']);

       if(empty($oldpassword)){
        header("Location: change-password-form.php?error=Old Password is required");
        exit();
      }else if(empty($newpassword1)){
        header("Location: change-password-form.php?error=New Password is required");
        exit();
      }else if($newpassword1 !== $newpassword2){
        header("Location: change-password-form.php?error=The confirmation password  does not match");
        exit();
      }else {
        $id = $_SESSION['user_id'];
    
        //อัปเดตรหัส
        $sql = "SELECT password FROM tbl_user WHERE user_id='$id' AND password='$oldpassword'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
        	
        $sql_2 = "UPDATE tbl_user SET password='$newpassword1' WHERE user_id='$id'";
        mysqli_query($conn, $sql_2);
        header("Location: change-password-form.php?success=Your password has been changed successfully");
	    exit();

        }else {
        	header("Location: change-password-form.php?error=Incorrect password");
	        exit();
        }
      }
      
    //}else{
    //    header("Location: change-password-form.php");
    //    exit();
    //}
}else{
   header("Location: index.php");
    exit();
}
	
?>