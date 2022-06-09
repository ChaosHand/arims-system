<?php
    
    include('../database.php');

    if (isset($_GET['delete']))
    {
        $r_id=$_GET['delete'];
        delete_data($conn,$r_id);
    }

//delete data query
function delete_data($conn,$r_id)
{
    $query = "DELETE from research_author WHERE ref_r_id=$r_id";
    $result = mysqli_query($conn,$query);
     
    if ($result)
    {

        $query2 = "DELETE from research WHERE r_id=$r_id";
        $result2 = mysqli_query($conn,$query2);

        if ($result2) {

        echo "<script>alert('คุณต้องการจะลบข้อมูลผู้ใช้งาน หรือไม่!');</script>";    
            $_SESSION['success'] = "Insert user successfully";
            echo "<script>document.location = 'r-list-form.php'</script>";
        }
        else {
            $msg= "ERROR : ".$query."<br>".mysqli_error($conn);
            echo $msg;
        }
    }
    else
    {
        $msg= "ERROR : ".$query."<br>".mysqli_error($conn);
        echo $msg;
    }
}
?>
