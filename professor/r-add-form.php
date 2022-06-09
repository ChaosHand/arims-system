<?php 

session_start();

require_once "../database.php";

if (isset($_POST['submit'])) {

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

  $academic_check = "SELECT * FROM reserch WHERE ac_name = '$ac_name' LIMIT 1";
  $result = mysqli_query($conn, $academic_check);
  $academic = mysqli_fetch_assoc($result);

  if ($academic['ac_name'] === $ac_name) {
      echo "<script>alert('Academic name already exists');</script>";
  } else {

      $query = "INSERT INTO academic ( name_prefix, firstname, lastname, article_type, ac_name, ac_year, ac_publicity, issue, start_page, end_page )
                  VALUE ('$name_prefix', '$firstname', '$lastname', '$article_type', '$ac_name', '$ac_year', '$ac_publicity', '$issue', '$start_page', '$end_page')";
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

$query_rd = "SELECT * FROM r_details";
$result_rd = mysqli_query($conn, $query_rd);
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
    <p class="h1"><strong>เพิ่มข้อมูลผลงานวิจัย</strong></p> <br><br>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
      <div class="input-group">
        <span class="input-group-text">เลขที่สัญญา</span>
        <input type="text" name="r_contract" aria-label="r_contract" class="form-control" placeholder="เลขที่สัญญา" required>
        <label> &nbsp;&nbsp;&nbsp;&nbsp; </label>
        <span class="input-group-text">ปี พ.ศ. ที่ทำสัญญา</span>
        <input type="text" name="r_year" aria-label="r_year" class="form-control" placeholder="เช่น '2565'" required>
      </div>  
      <br> 
      <div class="input-group">
        <span class="input-group-text">ชื่อผลงานวิจัย</span>
        <input type="text" name="r_name" aria-label="r_name" class="form-control" placeholder="ชื่อผลงานวิจัย" required>
      </div>  
      <br>
      <div class="input-group">
        <span class="input-group-text">รายละเอียดทุนวิจัยและงานสร้างสรรค์</span>
        <select class="form-select" name="r_details" required>
          <option value="">-Choose-</option>
          <?php foreach($result_rd as $results){?>
          <option value="<?php echo $results["r_details"];?>">
          <?php echo $results["r_details"]; ?>
          </option>
          <?php } ?>
      </select>
      </div>
      <br>    
      <div class="input-group">
        <span class="input-group-text">หัวหน้าโครงการ</span>
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
      <div id="people_num">
        <div class="input-group">
          <span class="input-group-text">ผู้ร่วมวิจัย</span>
          <select class="form-select" aria-label="Default select example" name="name_prefix" >
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
      </div>
      <br>
      <input style="float:right;" class="btn" type="button" id="more_fields" onclick="add_fields();" value="Add More" />  
      <br><br><br>    
      <div class="input-group mb-3">
        <span class="input-group-text">เปอร์เซ็นการรับผิดชอบโครงการ</span>
        <input type="text" name="r_percent" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="1 - 100" required>
        <span class="input-group-text">%</span>
      </div>
      <br>    
      <div class="input-group mb-3">
        <span class="input-group-text">จำนวนทุนวิจัย</span>
        <input type="text" name="r_amount" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="ทุนวิจัยเต็มของโครงการ" required>
        <span class="input-group-text">บาท</span>
        <label> &nbsp;&nbsp;&nbsp;&nbsp; </label>
        <span class="input-group-text">จำนวนทุนวิจัยตามสัดส่วนที่ได้รับ</span>
        <input type="text" name="r_amounted" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="ทุนวิจัยเต็มของโครงการ * เปอร์เซ็นการรับผิดชอบโครงการ" required>
        <span class="input-group-text">บาท</span>
      </div>   
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

<script>
    var people = 1;
function add_fields() {
    people++;
    var objTo = document.getElementById('people_num')
    var divtest = document.createElement("div");
    divtest.innerHTML = '<br><div class="input-group">'
          +'<span class="input-group-text">ผู้ร่วมวิจัย</span>'
          +'<select class="form-select" aria-label="Default select example" name="name_prefix" >'
            +'<option value="">-Choose-</option>'
            +'<?php foreach($result_np as $results){?>'
            +'<option value="<?php echo $results["name_prefix"];?>">'
            +'<?php echo $results["name_prefix"]; ?>'
            +'</option>'
            +'<?php } ?>'
          +'</select>'
          +'<input type="text" name="firstname" aria-label="First name" class="form-control" placeholder="ชื่อ" >'
          +'<input type="text" name="lastname" aria-label="Last name" class="form-control" placeholder="นามสกุล" >'
        +'</div>';

    objTo.appendChild(divtest)
}
</script>