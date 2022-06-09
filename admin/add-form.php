<?php 

session_start();

require_once "../database.php";

if (isset($_POST['submit'])) {

    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];    
    $ref_nameprefix_id = $_POST['ref_nameprefix_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $ref_branch_id = $_POST['ref_branch_id'];
    $ref_userlevel_id = $_POST['ref_userlevel_id'];

    $user_check = "SELECT * FROM tbl_user WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $user_check);
    $user = mysqli_fetch_assoc($result);

    if ($user['username'] == $username) {
        echo "<script>alert('Username already exists');</script>";
        echo "<script>document.location = 'list-form.php'</script>";
    } else {
        $passwordenc = $password;

        $query = "INSERT INTO tbl_user (user_id, username, password, ref_nameprefix_id, firstname, lastname, ref_branch_id, ref_userlevel_id)
                    VALUE ('$user_id', '$username', '$passwordenc', '$ref_nameprefix_id', '$firstname', '$lastname', '$ref_branch_id', '$ref_userlevel_id')";
        $result = mysqli_query($conn, $query);

        if ($result) {   
            echo "<script>alert('Insert User successfully');</script>";    
            $_SESSION['success'] = "Insert user successfully";
            echo "<script>document.location = 'list-form.php'</script>";
          
        } else {
            $_SESSION['error'] = "Something went wrong";
            header("Location: add-user.php");
        }
    }
}
$query_np = "SELECT * FROM nameprefix";
$result_np = mysqli_query($conn, $query_np);

$query_b = "SELECT * FROM branch";
$result_b = mysqli_query($conn, $query_b);

$query_ul = "SELECT * FROM userlevel";
$result_ul = mysqli_query($conn, $query_ul);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add User</title>
  <link rel="icon" type="../image/x-icon" href="../BA.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .navbar {
      background-color: #01143f;
      padding: 10px;
    }
    .btn {
      background-color: #01143f;
      color: white;
    }
    .container {
      margin-bottom: 100px;
    }
    footer {
      margin-top: 300px; background-color: #01143f; color: white; text-align: center;position: fixed;
      padding: 10px 10px 0px 10px;
      bottom: 0;
      width: 100%;
      height: 40px;
    }
  </style>
</head>
<body>
  <div style="background-color: #01143f; color: white; text-align: center;">
      <img class="img-fluid" src="../Banner.png" alt="Banner">  
  </div>

  <nav class="navbar navbar-expand-sm navbar-dark">
    <div class="container-fluid">
      <img class="img-fluid" src="../BA02.png" alt="Logo" width="50px">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="home-form.php">หน้าหลัก</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">การจัดการข้อมูลผู้ใช้งาน</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="add-form.php">เพิ่มข้อมูลผู้ใช้งาน</a></li>
              <li><a class="dropdown-item" href="list-form.php">แก้ไขข้อมูลผู้ใช้งาน</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="search-form.php">ค้นหารายชื่อ</a>
          </li>
        </ul>
      </div>
      <form class="d-flex">
          <a href="uim.php" class="btn btn-primary" role="button">User Information Management</a>
          <label> &nbsp;&nbsp;&nbsp;&nbsp; </label>
          <a href="change-password.php" class="btn btn-primary" role="button">Change Password</a>
          <label> &nbsp;&nbsp;&nbsp;&nbsp; </label>
          <a href="../logout.php" class="btn btn-primary" role="button">Logout</a>
        </form>
    </div>
  </nav>

  <div class="container mt-5 text-center">
    <p class="h1"><strong>เพิ่มข้อมูลผู้ใช้</strong></p> <br><br>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="input-group">
        <span class="input-group-text">ID</span>
        <input type="text" name="user_id" aria-label="user_id" class="form-control" placeholder="รหัสประจำตัวบุคลากร" required>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-text">Username & Password</span>
        <input type="text" name="username" aria-label="username" class="form-control" placeholder="username" required>
        <input type="text" name="password" aria-label="password" class="form-control" placeholder="password" required>
      </div>
      <br>                    
      <div class="input-group">
        <span class="input-group-text">ชื่อ-นามสกุล ผู้ใช้</span>
        <!--------------------------------------->
        <select class="form-select" aria-label="Default select example" name="ref_nameprefix_id" required>
          <option value="">--Choose--</option>
                            <?php foreach ($result_np as $results) : ?>
                                <option value="<?= $results['nameprefix_id'] ?>"><?= $results['nameprefix'] ?></option>
                            <?php endforeach; ?>
                        </select>
        <!--------------------------------------->
        <input type="text" name="firstname" aria-label="First name" class="form-control" placeholder="ชื่อ" required>
        <input type="text" name="lastname" aria-label="Last name" class="form-control" placeholder="นามสกุล" required>
      </div>
      <br>                    
      <div class="input-group">
        <span class="input-group-text">สาขา</span>
        <!--------------------------------------->
        <select class="form-select" aria-label="Default select example" name="ref_branch_id" required>
          <option value="">--Choose--</option>
                            <?php foreach ($result_b as $results) : ?>
                                <option value="<?= $results['branch_id'] ?>"><?= $results['branch'] ?></option>
                            <?php endforeach; ?>
                        </select>
        <!--------------------------------------->
      </div>
      <br>                    
      <div class="input-group">
        <span class="input-group-text">สิทธิ์การเช้าใช้งาน</span>
        <!--------------------------------------->
        <select class="form-select" aria-label="Default select example" name="ref_userlevel_id" required>
          <option value="">--Choose--</option>
                            <?php foreach ($result_ul as $results) : ?>
                                <option value="<?= $results['userlevel_id'] ?>"><?= $results['userlevel'] ?></option>
                            <?php endforeach; ?>
                        </select>
        <!--------------------------------------->
      </div>
      <br>
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn" type="submit" name="submit">บันทึก</button>
      </div>
    </form>
  </div>

  <footer>
    <p>Copyright © 2020 by Faculty of Business Administrations Tel : +66 - 098 7763315</p>
  </footer>
</body>
</html>

<script>
    var people = 1;
function add_fields() {
    people++;
    var objTo = document.getElementById('people_num')
    var divtest = document.createElement("div");
    divtest.innerHTML = '<div><u> คนที่ ' + people +':</u></div><br>'
    +'<div class="content">'
                 + '<h5 for="sources">เลขประจำตัวบุคลากร</h5>'
                        + '<input type="text" class="form-control"  placeholder="เลขประจำตัวบุคลากร" name="id" required>'
                   +' <br><br> '
                 +' <h5 for="sources">ชื่อ</h5>'
                        +'<input type="text" class="form-control"  placeholder="ชื่อ" name="firstname" required>'
                   +' <br><br>' 
                    +'<h5 for="sources">นามสกุล</h5>'
                        +'<input type="text" class="form-control"  placeholder="นามสกุล" name="lastname" required>'
                    +'<br><br>'
                 +'</div>';

    objTo.appendChild(divtest)
}
</script>

<?php 
mysqli_close($conn);
?>