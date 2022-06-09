<?php 
    session_start();
    include('database.php');

    if (isset($_POST['uname']) && isset($_POST['password'])) {

        $uname = $_POST['uname'];
        $password = $_POST['password'];
        $passwordenc = md5($password);

        $query="SELECT u.*, np.*, b.*, ul.*

        FROM tbl_user as u
      
        INNER JOIN nameprefix as np ON u.ref_nameprefix_id = np.nameprefix_id
        INNER JOIN branch as b ON  u.ref_branch_id = b.branch_id
        INNER JOIN userlevel as ul ON u.ref_userlevel_id = ul.userlevel_id
        
        WHERE username = '$uname' AND password = '$password'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {

            $row = mysqli_fetch_array($result);

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['nameprefix'] = $row['nameprefix'];
            $_SESSION['user'] = $row['firstname'] . " " . $row['lastname'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['branch'] = $row['branch'];
            $_SESSION['userlevel'] = $row['userlevel'];
            $_SESSION['birthday'] = $row['birthday'];
            $_SESSION['email'] = $row['email'];

            if ($_SESSION['userlevel'] == 'admin') {
                header("Location: admin\home-form.php");
            }

            if ($_SESSION['userlevel'] == 'ผู้บริหาร') {
                header("Location: board\home-form.php");
            }
            if ($_SESSION['userlevel'] == 'หัวหน้าสาขา') {
                header("Location: head\home-form.php");
            }
            if ($_SESSION['userlevel'] == 'อาจารย์') {
                header("Location: professor\home-form.php");
            }
            if ($_SESSION['userlevel'] == 'hide') {
                echo "<script>alert('User Not Found');</script>";    
                echo "<script>document.location = 'login-form.php'</script>";
            }
        } else {
            echo "<script>";
                        echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
                        echo "window.history.back()";
                    echo "</script>";
        }

    } else {
        header("Location: login-form.php");
    }
?>