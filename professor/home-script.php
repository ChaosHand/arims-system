<?php
include('../database.php');

$fetchData= fetch_data($conn);

// fetch query
function fetch_data($conn){
  $query="SELECT * from user ORDER BY id ASC";
  $result=mysqli_query($conn, $query);
  if(mysqli_num_rows($result)>0){

    $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $row;  
        
  }else{
    return $row=[];
  }
}
?>