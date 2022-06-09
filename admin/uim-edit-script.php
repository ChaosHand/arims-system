<?php
require_once "../database.php";
//session_start();
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
    $birthday = legal_input($_POST['birthday']);
    $email = legal_input($_POST['email']);

    $query="UPDATE tbl_user
        SET user_id='$user_id',
            ref_nameprefix_id='$ref_nameprefix_id',
            firstname='$firstname',
            lastname='$lastname',
            ref_branch_id='$ref_branch_id',
            ref_userlevel_id='$ref_userlevel_id',
            birthday='$birthday',
            email='$email'
            
            WHERE user_id=$user_id";

    if($result= mysqli_query($conn,$query)){
        $query_np = "SELECT * FROM nameprefix WHERE nameprefix_id={$ref_nameprefix_id}";
        $result_np = mysqli_query($conn, $query_np);
        $row1=mysqli_fetch_assoc($result_np);

        $query_b = "SELECT * FROM branch WHERE branch_id={$ref_branch_id}";
        $result_b = mysqli_query($conn, $query_b);
        $row2=mysqli_fetch_assoc($result_b);

        $query_ul = "SELECT * FROM userlevel WHERE userlevel_id={$ref_userlevel_id}";
        $result_ul = mysqli_query($conn, $query_ul);
        $row3=mysqli_fetch_assoc($result_ul);

        $_SESSION['nameprefix'] = $row1['nameprefix'];
        $_SESSION['user'] = $_POST['firstname'] . " " . $_POST['lastname'];
        $_SESSION['firstname'] = $_POST['firstname'];
        $_SESSION['lastname'] = $_POST['lastname'];
        $_SESSION['branch'] = $row2['branch'];
        $_SESSION['userlevel'] = $row3['userlevel'];
        $_SESSION['birthday'] = $_POST['birthday'];
        $_SESSION['email'] = $_POST['email'];
        header('location:uim.php'); #redirect change path

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