<?php

require_once "ac-add-script.php";

$query_np = "SELECT * FROM nameprefix";
$result_np = mysqli_query($conn, $query_np);

$query_as = "SELECT * FROM ac_aut_status";
$result_as = mysqli_query($conn, $query_as);

$query_at = "SELECT * FROM article_type";
$result_at = mysqli_query($conn, $query_at);

$query_ql = "SELECT * FROM quality_level";
$result_ql = mysqli_query($conn, $query_ql);

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
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
          <a href="uim.php" class="btn btn-primary" role="button">User Information Management</a>
          <label> &nbsp;&nbsp;&nbsp;&nbsp; </label>
          <a href="change-password.php" class="btn btn-primary" role="button">Change Password</a>
          <label> &nbsp;&nbsp;&nbsp;&nbsp; </label>
          <a href="../logout.php" class="btn btn-primary" role="button">Logout</a>
        </form>
    </div>
  </nav>

  <div class="container mt-5 text-center">
    <p class="h1"><strong>เพิ่มข้อมูลผลงานวิชาการ</strong></p> <br><br>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="input-group">
        <span class="input-group-text">ชื่อผลงาน</span>
        <input type="text" name="art_name" aria-label="art_name" class="form-control" placeholder="ชื่อผลงาน" required>
      </div>
      <br>
      <!-------------------------------------------------------->
      <div class="input-group">
        <input hidden type="text" name="pro_id" value="<?php echo(rand());?>">
        <span class="input-group-text">ผู้รับผิดชอบโครงการ</span>
        <select class="form-select" aria-label="Default select example" name="nameprefix_id[]" required>
          <option value="">--Choose--</option>
          <?php foreach ($result_np as $results) : ?>
            <option value="<?= $results['nameprefix_id'] ?>"><?= $results['nameprefix'] ?></option>
          <?php endforeach; ?>
        </select>
        <input type="text" name="firstname[]" aria-label="First name" class="form-control" placeholder="ชื่อ" required>
        <input type="text" name="lastname[]" aria-label="Last name" class="form-control" placeholder="นามสกุล" required>
        <label> &nbsp;&nbsp;&nbsp;&nbsp; </label>
        <span class="input-group-text">สถานะผู้รับผิดชอบ</span>
        <select class="form-select" aria-label="Default select example" name="ref_aut_status_id[]" required>
          <option value="">--Choose--</option>
          <?php foreach ($result_as as $results) : ?>
            <option value="<?= $results['aut_status_id'] ?>"><?= $results['aut_status'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div id="dynamic_field">
        <br>
        <input style="float:right;" class="btn" type="button" id="add" value="Add More" />
        <br><br>
      </div>
      <br>
      <br><br><br>
      <!--------------------------------------------------------------->
      <div class="input-group">
        <span class="input-group-text">ประเภทบทความ</span>
        <!--------------------------------------->
        <select class="form-select" aria-label="Default select example" name="ref_art_type_id" required>
          <option value="">--Choose--</option>
          <?php foreach ($result_at as $results) : ?>
            <option value="<?= $results['article_type_id'] ?>"><?= $results['article_type'] ?></option>
          <?php endforeach; ?>
        </select>
        <!--------------------------------------->
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-text">ปี พ.ศ. ที่เผยแพร่</span>
        <input type="number" name="art_year" aria-label="art_year" class="form-control" placeholder="เช่น '2565'" required>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-text">ช่องทางการเผยแพร่</span>
        <input type="text" name="art_publicity" aria-label="art_publicity" class="form-control" placeholder="ช่องทางการเผยแพร่" required>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-text">ฉบับที่</span>
        <input type="text" name="issue" aria-label="issue" class="form-control" placeholder="ฉบับที่" required>
        <span class="input-group-text">หน้า</span>
        <input type="number" name="start_page" aria-label="start_page" class="form-control" placeholder="หน้าแรก" required>
        <span class="input-group-text">ถึง</span>
        <input type="number" name="end_page" aria-label="end_page" class="form-control" placeholder="หน้าสุดท้าย" required>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-text">ระดับคุณภาพผลงานทางวิชาการ</span>
        <!--------------------------------------->
        <select class="form-select" aria-label="Default select example" name="ref_quality_level_id" required>
          <option value="">--Choose--</option>
          <?php foreach ($result_ql as $results) : ?>
            <option value="<?= $results['quality_level_id'] ?>"><?= $results['quality_level_score'] ?> : <?= $results['quality_level'] ?></option>
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
<script>
  $(document).ready(function() {
    var i = 1;
    $('#add').click(function() {
      i++;
      $('#dynamic_field').append('<tr id="row' + i + '"><td><br> <div class="input-group"> <span class="input-group-text">ผู้รับผิดชอบโครงการ</span> <select class="form-select" aria-label="Default select example" name="nameprefix_id[]" required> <option value="">--Choose--</option> <?php foreach ($result_np as $results) : ?> <option value="<?= $results['nameprefix_id'] ?>"><?= $results['nameprefix'] ?></option> <?php endforeach; ?> </select> <input type="text" name="firstname[]" aria-label="First name" class="form-control" placeholder="ชื่อ" required> <input type="text" name="lastname[]" aria-label="Last name" class="form-control" placeholder="นามสกุล" required> <label> &nbsp;&nbsp;&nbsp;&nbsp; </label> <span class="input-group-text">สถานะผู้รับผิดชอบ</span> <select class="form-select" aria-label="Default select example" name="ref_aut_status_id[]" required> <option value="">--Choose--</option> <?php foreach ($result_as as $results) : ?> <option value="<?= $results['aut_status_id'] ?>"><?= $results['aut_status'] ?></option> <?php endforeach; ?> </select> </div> </td> <td> <br> <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
    });

    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove();
    });

    $('#submit').click(function() {
      $.ajax({
        url: "name.php",
        method: "POST",
        data: $('#add_name').serialize(),
        success: function(data) {
          alert(data);
          $('#add_name')[0].reset();
        }
      });
    });

  });
</script>
</html>
<!-- <?php 

// if (isset($_POST['file_name'])) {
//     require_once '../database.php';
     //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    // $date1 = date("Ymd_His");
    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    // $numrand = (mt_rand());
    // $art_file = (isset($_POST['art_file']) ? $_POST['art_file'] : '');
    // $upload=$_FILES['art_file']['name'];

    //มีการอัพโหลดไฟล์
    // if($upload !='') {
    //ตัดขื่อเอาเฉพาะนามสกุล
    // $typefile = strrchr($_FILES['art_file']['name'],".");

    //สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
    // if($typefile =='.pdf'){

    //โฟลเดอร์ที่เก็บไฟล์ **สร้างไฟล์ index.php หรือ index.html (ไม่ต้องมี code) ไว้ในโฟลเดอร์ด้วยนะครับจะได้ป้องกันการเข้าถึงทุกไฟล์ในโฟลเดอร์
    // $path="docs/";
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    // $newname = 'doc_'.$numrand.$date1.$typefile;
    // $path_copy=$path.$newname;
    //คัดลอกไฟล์ไปยังโฟลเดอร์
    // move_uploaded_file($_FILES['art_file']['tmp_name'],$path_copy); 

     //ประกาศตัวแปรรับค่าจากฟอร์ม
    // $file_name = $_POST['file_name'];
    
    //sql insert
    // $stmt = $conn->prepare("INSERT INTO article (file_name, art_file)
    // VALUES (:file_name, '$newname')");
    // $stmt->bindParam(':file_name', $file_name, PDO::PARAM_STR);
    // $result = $stmt->execute();
    // $conn = null; //close connect db
    //เงื่อนไขตรวจสอบการเพิ่มข้อมูล
            // if($result){
            //     echo '<script>
            //          setTimeout(function() {
            //           swal({
            //               title: "อัพโหลดไฟล์เอกสารสำเร็จ",
            //               type: "success"
            //           }, function() {
            //               window.location = "upload_pdf.php"; //หน้าที่ต้องการให้กระโดดไป
            //           });
            //         }, 1000);
            //     </script>';
            // }else{
            //    echo '<script>
            //          setTimeout(function() {
            //           swal({
            //               title: "เกิดข้อผิดพลาด",
            //               type: "error"
            //           }, function() {
            //               window.location = "upload_pdf.php"; //หน้าที่ต้องการให้กระโดดไป
            //           });
            //         }, 1000);
            //     </script>';
            // } //else ของ if result

        
        // }else{ //ถ้าไฟล์ที่อัพโหลดไม่ตรงตามที่กำหนด
            // echo '<script>
            //              setTimeout(function() {
            //               swal({
            //                   title: "คุณอัพโหลดไฟล์ไม่ถูกต้อง",
            //                   type: "error"
            //               }, function() {
            //                   window.location = "upload_pdf.php"; //หน้าที่ต้องการให้กระโดดไป
            //               });
            //             }, 1000);
            //         </script>';
        // } //else ของเช็คนามสกุลไฟล์
   
    // } // if($upload !='') {

    // } //isset
// ?> -->
<?php
mysqli_close($conn);
?>