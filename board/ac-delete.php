<?php
    
    include('../database.php');

    if (isset($_GET['delete']))
    {
        $art_id=$_GET['delete'];
        delete_data($conn,$art_id);
    }

//delete data query
function delete_data($conn,$art_id)
{
    $query = "DELETE from article_author WHERE ref_art_id=$art_id";
    $result = mysqli_query($conn,$query);
     
    if ($result)
    {

        $query2 = "DELETE from article WHERE art_id=$art_id";
        $result2 = mysqli_query($conn,$query2);

        if ($result2) {

        echo "<script>alert('คุณต้องการจะลบข้อมูลผู้ใช้งาน หรือไม่!');</script>";    
            $_SESSION['success'] = "Insert user successfully";
            echo "<script>document.location = 'ac-list-form.php'</script>";
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
