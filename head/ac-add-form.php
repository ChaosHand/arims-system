<?php 

session_start();

require_once "../database.php";

if (isset($_POST['submit'])) {

  $id = $_POST['id'];
  $name_prefix = $_POST['name_prefix'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];  
  $article_type = $_POST['article_type']; 
  $ac_name = $_POST['ac_name'];
  $ac_year = $_POST['ac_year'];   
  $ac_publicity = $_POST['ac_publicity'];
  $issue = $_POST['issue'];   
  $start_page = $_POST['start_page'];
  $end_page = $_POST['end_page'];      

  $academic_check = "SELECT * FROM academic WHERE ac_name = '$ac_name' LIMIT 1";
  $result = mysqli_query($conn, $academic_check);
  $academic = mysqli_fetch_assoc($result);

  if ($academic['ac_name'] === $ac_name) {
      echo "<script>alert('Academic name already exists');</script>";
  } else {

      $query = "INSERT INTO academic ( id, name_prefix, firstname, lastname, article_type, ac_name, ac_year, ac_publicity, issue, start_page, end_page )
                  VALUE ('$id', '$name_prefix', '$firstname', '$lastname', '$article_type', '$ac_name', '$ac_year', '$ac_publicity', '$issue', '$start_page', '$end_page')";
      $result = mysqli_query($conn, $query);

      if ($result) {   
          echo "<script>alert('Insert Academic Article Successfully');</script>";    
          $_SESSION['success'] = "Insert Academic successfully";
          echo "<script>document.location = 'ac-add-form.php'</script>";
        
      } else {
          $_SESSION['error'] = "Something went wrong";
          header("Location: ac-add-form.php");
      }
  }
}
$query_np = "SELECT * FROM name_prefix";
$result_np = mysqli_query($conn, $query_np);

$query_at = "SELECT * FROM article_type";
$result_at = mysqli_query($conn, $query_at);

$query_bs = "SELECT * FROM base";
$result_bs = mysqli_query($conn, $query_bs);
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
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">ผลงานวิชาการ</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="ac-add-form.php">เพิ่มข้อมูล</a></li>
              <li><a class="dropdown-item" href="ac-list-form.php">แก้ไขข้อมูล</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">ผลงานวิจัย</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="r-add-form.php">เพิ่มข้อมูลผล</a></li>
              <li><a class="dropdown-item" href="r-list-form.php">แก้ไขข้อมูลผล</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">ออกรายงาน</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="ac-report-form.php">ผลงานวิชาการ</a></li>
              <li><a class="dropdown-item" href="r-report-form.php">ผลงานวิจัย</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <form class="d-flex">
          <a href="../uim.php" class="btn btn-primary" role="button">User Information Management</a>
          <label> &nbsp;&nbsp;&nbsp;&nbsp; </label>
          <a href="../change-password.php" class="btn btn-primary" role="button">Change Password</a>
          <label> &nbsp;&nbsp;&nbsp;&nbsp; </label>
          <a href="../logout.php" class="btn btn-primary" role="button">Logout</a>
        </form>
    </div>
  </nav>

  <div class="container mt-5 text-center">
    <p class="h1"><strong>เพิ่มข้อมูลผลงานวิชาการ</strong></p> <br><br>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">         
      <div class="input-group">
        <span class="input-group-text">ผู้รับผิดชอบโครงการ</span>
        <select class="form-select" aria-label="Default select example" name="name_prefix" required>
          <option value="">-Choose-</option>
          <?php foreach($result_np as $results){?>
          <option value="<?php echo $results["name_prefix"];?>">
          <?php echo $results["name_prefix"]; ?>
          </option>
          <?php } ?>
        </select>
        <input type="text" name="firstname" aria-label="First name" class="form-control" placeholder="ชื่อ" required>
        <input type="text" name="lastname" aria-label="Last name" class="form-control" placeholder="นามสกุล" required>
      </div>      
      <br>                    
      <div class="input-group">
        <span class="input-group-text">ประเภทบทความ</span>
        <select class="form-select" name="article_type" required>
          <option value="">-Choose-</option>
          <?php foreach($result_at as $results){?>
          <option value="<?php echo $results["article_type"];?>">
          <?php echo $results["article_type"]; ?>
          </option>
          <?php } ?>
      </select>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-text">ชื่อผลงาน</span>
        <input type="text" name="ac_name" aria-label="ac_name" class="form-control" placeholder="ชื่อผลงาน" required>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-text">ปี พ.ศ. ที่เผยแพร่</span>
        <input type="text" name="ac_year" aria-label="ac_year" class="form-control" placeholder="เช่น '2565'" required>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-text">ช่องทางการเผยแพร่</span>
        <input type="text" name="ac_publicity" aria-label="ac_publicity" class="form-control" placeholder="ช่องทางการเผยแพร่" required>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-text">ฉบับที่</span>
        <input type="text" name="issue" aria-label="issue" class="form-control" placeholder="ช่องทางการเผยแพร่" required>
        <span class="input-group-text">หน้า</span>
        <input type="text" name="start_page" aria-label="start_page" class="form-control" placeholder="หน้าแรก" required>
        <span class="input-group-text">ถึง</span>
        <input type="text" name="end_page" aria-label="end_page" class="form-control" placeholder="หน้าสุดท้าย" required>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-text">ระดับคุณภาพผลงานทางวิชาการ</span>
        <select class="form-select" name="base" required>
          <option value="">-Choose-</option>
          <?php foreach($result_bs as $results){?>
          <option value="<?php echo $results["base"];?>">
          <?php echo $results["base"]; ?>
          </option>
          <?php } ?>
      </select>
      </div>
      <br>
      <div class="mb-3">
        <input class="form-control" type="file" id="formFile">
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

<?php 
mysqli_close($conn);
?>