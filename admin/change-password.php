<?php
include("home-script.php");
session_start();

    if (!$_SESSION['userid']) {
        header("Location: index.php");
    } else {
	
	if ($_POST['submit']) {
       $password = $_POST['oldpassword'];
	   $newpassword = $_POST['newpassword'];
	   $repreatnewpassword = $_POST['repeatnewpassword'];

	   
	}
	else{

	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <link rel="icon" type="../image/x-iconn" href="../BA.png">
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
      margin-top: 300px; 
      background-color: #01143f; 
      color: white; 
      text-align: center;
      position: fixed;
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

  <div class="container mt-5 mb-5 text-center">
    <p class="h1"><strong>เปลี่ยนรหัสผ่าน <?php echo $_SESSION['userlevel']; ?> </strong></p> <br><br>
    <form action='change-password.php' method='POST'>
		<label>Old password</label>
		   <input type="text" name="oldpassword"></input><br><br>
		<label>New password</label>
		    <input type="text" name="newpassword"></input><br><br>
		<label>Repeat New password</label>
		    <input type="text" name="repeatnewpassword"></input><br><br>
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

<?php } ?>