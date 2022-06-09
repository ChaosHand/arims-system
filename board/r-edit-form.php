<?php
    require_once "r-edit-script.php";

    $fetchData= fetch_data($conn);

// fetch query
function fetch_data($conn){
  $query="SELECT r.*, ra.*, rd.*

  FROM research as r

  INNER JOIN research_author as ra ON r.r_id = ra.ref_r_id
  INNER JOIN research_details as rd ON r.ref_research_details_id = rd.research_details_id
  
  ORDER BY r_id ASC";

  $result=mysqli_query($conn, $query);
  if(mysqli_num_rows($result)>0){

    $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $row;  
        
  }else{
    return $row=[];
  }
}
$query_np = "SELECT * FROM nameprefix";
$result_np = mysqli_query($conn, $query_np);

$query_rd = "SELECT * FROM research_details";
$result_rd = mysqli_query($conn, $query_rd);

$query_as = "SELECT * FROM aut_status";
$result_as = mysqli_query($conn, $query_as);
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

  <?php
                if(count($fetchData)>0)
                {
                    $no = 1;
                    foreach($fetchData as $data)
            ?>

  <div class="container mt-5 text-center">
    <p class="h1"><strong>แก้ไขข้อมูลผลงานวิชาการ</strong></p> <br><br>
    <form action="r-edit-form.php?edit= <?php echo $editData['r_id']; ?>" method="post">
      <div class="input-group">
        <span class="input-group-text">เลขที่สัญญา</span>
        <input type="number" name="r_contract_id" aria-label="r_contract_id" class="form-control" value="<?php echo isset($editData) ? $editData['r_contract_id'] : '' ?>" required>
        <label> &nbsp;&nbsp;&nbsp;&nbsp; </label>
        <span class="input-group-text">ปี พ.ศ. ที่ทำสัญญา</span>
        <input type="number" name="r_year" aria-label="r_year" class="form-control" value="<?php echo isset($editData) ? $editData['r_year'] : '' ?>" required>
      </div>
      <br>
      <!-------------------------------------------------------->
      <div class="input-group">
        <span class="input-group-text">ชื่อผลงานวิจัย</span>
        <input type="text" name="r_name" aria-label="r_name" class="form-control" value="<?php echo isset($editData) ? $editData['r_name'] : '' ?>" required>
      </div>
      <br>
      <!-------------------------------------------------------->
      <div class="input-group">
        <span class="input-group-text">รายละเอียดทุนวิจัยและงานสร้างสรรค์</span>
        <select class="form-select" aria-label="Default select example" name="ref_research_details_id" >
          <option value=""><?php echo $data['research_details']?></option>
                            <?php foreach ($result_rd as $results) : ?>
                                <option value="<?= $results['research_details_id'] ?>"<?= $editData['ref_research_details_id'] == $results['research_details_id'] ? 'selected' : ''?>><?= $results['research_details'] ?></option>
                            <?php endforeach; ?>
                        </select>
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-text">จำนวนทุนวิจัย</span>
        <input type="number" name="r_fund" aria-label="r_fund" class="form-control" value="<?php echo isset($editData) ? $editData['r_fund'] : '' ?>" required></div>
      <!--------------------------------------->
      <br>
      <div class="input-group">
        <input hidden type="text" name="pro_id" value="<?php echo(rand());?>">
        <span class="input-group-text">ผู้รับผิดชอบโครงการ</span>
        <select class="form-select" aria-label="Default select example" name="nameprefix_id[]" >
          <option value="">--Choose--</option>
          <?php foreach ($result_np as $results) : ?>
            <option value="<?= $results['nameprefix_id'] ?>"><?= $results['nameprefix'] ?></option>
          <?php endforeach; ?>
        </select>
        <input type="text" name="firstname[]" aria-label="First name" class="form-control" placeholder="ชื่อ" >
        <input type="text" name="lastname[]" aria-label="Last name" class="form-control" placeholder="นามสกุล" >
        <label> &nbsp;&nbsp;&nbsp;&nbsp; </label>
        <span class="input-group-text">สถานะผู้รับผิดชอบ</span>
        <select class="form-select" aria-label="Default select example" name="ref_aut_status_id[]" >
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
      <br><br>
      <!--------------------------------------------------------------->
      <div class="mb-3">
        <input class="form-control" type="file" id="formFile">
      </div>
      <br>
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn" type="submit" name="update">บันทึกการเปลี่ยนแปลง</button>
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

<?php
mysqli_close($conn);
?>

<?php } ?>