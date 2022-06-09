<?php
session_start();

require_once "../database.php";
# get ค่าจากลิ้งที่ส่งมา
if(isset($_GET['edit'])){
    $user_id= $_GET['edit'];
    $editData= edit_data($conn, $user_id);
}

# เช็คอัพเดท ว่ามีการ edit ใหม
if(isset($_POST['update'])){
 $user_id= $_GET['edit'];
    update_data($conn,$user_id);
} 

function edit_data($conn, $user_id)
{
    $query="SELECT u.*, np.*, b.*, ul.*

    FROM tbl_user as u

    INNER JOIN nameprefix as np ON u.ref_nameprefix_id = np.nameprefix_id
    INNER JOIN branch as b ON  u.ref_branch_id = b.branch_id
    INNER JOIN userlevel as ul ON u.ref_userlevel_id = ul.userlevel_id
    
    WHERE user_id= $user_id";
    $result = mysqli_query($conn, $query);
    //$row = mysqli_fetch_all($result);
    $row=mysqli_fetch_assoc($result);
    return $row;

    
}

// update data query
function update_data($conn, $user_id)
{
    //$user_id= legal_input($_POST['user_id']);
    $ref_nameprefix_id= legal_input($_POST['ref_nameprefix_id']);
    $firstname= legal_input($_POST['firstname']);
    $lastname= legal_input($_POST['lastname']);
    $ref_branch_id = legal_input($_POST['ref_branch_id']);
    $ref_userlevel_id = legal_input($_POST['ref_userlevel_id']);

    $query="UPDATE tbl_user
        SET user_id='$user_id',
            ref_nameprefix_id='$ref_nameprefix_id',
            firstname='$firstname',
            lastname='$lastname',
            ref_branch_id='$ref_branch_id',
            ref_userlevel_id='$ref_userlevel_id' WHERE user_id=$user_id";

    if($result= mysqli_query($conn,$query)){
        header('location:list-form.php'); #redirect change path

    }else{
        $msg= "Error: " . $query . "<br>" . mysqli_error($conn);
        echo $msg;  
    }
}

// convert illegal input to legal input
function legal_input($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}
?>