<?php 
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
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
    .card-main{
      justify-items: center;
      align-items: center;
      justify-content: center;
      width: 1300px;
      height: 500px;
      align-content: center;
      margin-left: auto;
      margin-right: auto;
    }
    .error {
   background: #F2DEDE;
   color: #A94442;
   padding: 10px;
   width: 95%;
   border-radius: 5px;
   margin: 20px auto;
}

.success {
   background: #D4EDDA;
   color: #40754C;
   padding: 10px;
   width: 95%;
   border-radius: 5px;
   margin: 20px auto;
}
body {
	justify-content: center;
	align-items: center;
}
input {
	display: block;
	border: 2px solid #ccc;
	width: 95%;
	padding: 5px;
	border-radius: 5px;
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
          <a href="change-password-form.php" class="btn btn-primary" role="button">Change Password</a>
          <label> &nbsp;&nbsp;&nbsp;&nbsp; </label>
          <a href="../logout.php" class="btn btn-primary" role="button">Logout</a>
        </form>
    </div>
  </nav>

<form action='change-password-script.php' method='post'>
  <div class="container mt-5 mb-5 text-center">
  <div class="card-header">
    <p class="h1"><strong>เปลี่ยนรหัสผ่าน</strong></p> <br><br>
  </div>
    <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>
  <div class="card-main">
  <div class="card" >
  <div class="card-body">
    
		<label>Old password</label>
		<input type="text" name="oldpassword" placeholder="Old password"></input><br><br>   

		<label>New password</label>
		<input type="password" name="password1" placeholder="New password"></input><br><br>

		<label>Confirm password</label>
		<input type="password" name="password2"placeholder="Confirm password"></input><br><br>
        
			<div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn" type="submit" >บันทึก</button>
  </div>
  </div>
</div>
      </div>
	</form>
</div>
  

<footer>
  <p>Copyright © 2020 by Faculty of Business Administrations Tel : +66 - 098 7763315</p>
  </footer>

</body>
</html>

<?php 
}else{
   header("Location: index.php");
    exit();
}
 ?>