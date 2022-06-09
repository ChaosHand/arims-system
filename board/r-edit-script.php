<?php
session_start();

require_once "../database.php";
# get ค่าจากลิ้งที่ส่งมา
if(isset($_GET['edit'])){
    $r_id= $_GET['edit'];
    $editData= edit_data($conn, $r_id);
}

# เช็คอัพเดท ว่ามีการ edit 
if(isset($_POST['update'])){
 $r_id= $_GET['edit'];
    update_data($conn,$r_id);
} 

function edit_data($conn, $r_id)
{

    $research_check = "SELECT * FROM research WHERE r_id = '$r_id'";
    $rs = mysqli_query($conn,$research_check);
    $research = mysqli_fetch_array($rs);
    return $research;
    
}

// update data query
function update_data($conn, $r_id)
{
    //$user_id= legal_input($_POST['user_id']);    
    $r_name = $_POST['r_name'];
    // $p_id= legal_input($_POST['r_id']);
    $r_contract_id = $_POST['r_contract_id'];   
    $r_year = $_POST['r_year'];
    $ref_research_details_id = $_POST['ref_research_details_id'];   
    $r_fund = $_POST['r_fund'];  




    $query="UPDATE research 
            SET r_name='$r_name',
                r_id='$r_id', 
                r_contract_id='$r_contract_id', 
                r_year='$r_year', 
                ref_research_details_id='$ref_research_details_id', 
                r_fund='$r_fund', WHERE r_id=$r_id";
    $result = mysqli_query($conn, $query);

    if($result= mysqli_query($conn,$query)){
        header('location:r-list-form.php'); #redirect change path

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