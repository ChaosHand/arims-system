<?php
include('../database.php');
if(isset($_GET['delete'])){
    $id= $_GET['delete'];
  delete_data($conn, $id);
  
}

// delete data query
function delete_data($conn, $id){
    $query="DELETE from tbl_user WHERE user_id=$id";
    $result= mysqli_query($conn,$query);

    if($result){
      header('location:list-form.php');
    }else{
        $msg= "Error: " . $query . "<br>" . mysqli_error($conn);
      echo $msg;
    }
}
?>