<?php
    require_once "ac-edit-script.php";

    $fetchData= fetch_data($conn);

// fetch query
function fetch_data($conn){
  $query="SELECT article.*, article_type.*, quality_level.*

  FROM article

  INNER JOIN article_type ON article.ref_art_type_id = article_type.article_type_id
  INNER JOIN quality_level ON  article.ref_quality_level_id = quality_level.quality_level_id
  
  ORDER BY art_id ASC";

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

$query_as = "SELECT * FROM ac_aut_status";
$result_as = mysqli_query($conn, $query_as);

$query_at = "SELECT * FROM article_type";
$result_at = mysqli_query($conn, $query_at);

$query_ql = "SELECT * FROM quality_level";
$result_ql = mysqli_query($conn, $query_ql);

$new_query_article = "SELECT *  FROM article_author 
INNER JOIN article ON article_author.ref_art_id = article.art_id
INNER JOIN tbl_user ON article_author.ref_user_id = tbl_user.user_id
INNER JOIN ac_aut_status ON article_author.ref_aut_status_id = ac_aut_status.aut_status_id

WHERE ref_art_id = {$editData['art_id']}";
$new_result_article = mysqli_query($conn, $new_query_article);

$query_tbl = "SELECT u.*, np.*, b.*, ul.*
FROM tbl_user as u
INNER JOIN nameprefix as np ON u.ref_nameprefix_id = np.nameprefix_id
INNER JOIN branch as b ON  u.ref_branch_id = b.branch_id
INNER JOIN userlevel as ul ON u.ref_userlevel_id = ul.userlevel_id";
$result_tbl = mysqli_query($conn, $query_tbl);

$data_user_article = NULL;
if(mysqli_num_rows($new_result_article)>0){

  $data_user_article= mysqli_fetch_all($new_result_article, MYSQLI_ASSOC);  
}

$query_public = "SELECT publicuser.* , nameprefix.*
FROM publicuser 
INNER JOIN article ON publicuser.ref_art_id = article.art_id
INNER JOIN nameprefix ON publicuser.nameprefix_id = nameprefix.nameprefix_id
WHERE ref_art_id = '{$editData['art_id']}'";
$result_public = mysqli_query($conn, $query_public);

$data_public_article = NULL;
if(mysqli_num_rows($result_public)>0){

  $data_public_article= mysqli_fetch_all($result_public, MYSQLI_ASSOC);  
}
// print_r($data_public_article);

// $result_test = mysqli_fetch_array($new_result_article);
// echo json_encode($result_test);
//print_r($result_test);
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
    <form action="ac-edit-form.php?edit= <?php echo $editData['art_id']; ?>" method="post">
      <div class="input-group">
      <input hidden type="text" name="art_id" value="<?php echo isset($editData) ? $editData['art_id'] : '' ?>" disabled>
        <span class="input-group-text">ชื่อผลงาน</span>
        <input type="text" name="art_name" aria-label="art_name" class="form-control" value="<?php echo isset($editData) ? $editData['art_name'] : '' ?>" required>
      </div>
      <br>


      <?php
        $num = 0;
        foreach($data_user_article as $items) {
          
      
      ?>
      <!-------------------------------------------------------->
      <div class="input-group">
        <input hidden type="text" name="ref_art_id<?php echo $num;?>" value="<?php echo isset($editData) ? $items['ref_art_id'] : '' ?>">
        <span class="input-group-text">ผู้รับผิดชอบโครงการ</span>
        <select class="form-select" aria-label="Default select example" name="ref_nameprefix_id<?php echo $num;?>" >
        <option value="">--Choose--</option>
            <?php foreach ($result_np as $results) : ?>
                <option value="<?= $results['nameprefix_id'] ?>"<?= $items['ref_nameprefix_id'] == $results['nameprefix_id'] ? 'selected' : ''?>><?= $results['nameprefix'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="firstname<?php echo $num;?>" aria-label="First name" class="form-control" value="<?php echo isset($items) ? $items['firstname'] : '' ?>" >
        <input type="text" name="lastname<?php echo $num;?>" aria-label="Last name" class="form-control" value="<?php echo isset($items) ? $items['lastname'] : '' ?>" >
        <label> &nbsp;&nbsp;&nbsp;&nbsp; </label>
        <span class="input-group-text">สถานะผู้รับผิดชอบ</span>
        <select class="form-select" aria-label="Default select example" name="ref_aut_status_id<?php echo $num; ?>" >
          <option value="">--Choose--</option>
          <?php foreach ($result_as as $results) : ?>
            <option value="<?= $results['aut_status_id'] ?>"<?= $items['ref_aut_status_id'] == $results['aut_status_id'] ? 'selected' : ''?>><?= $results['aut_status'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <br>
      <?php $num++; } //ขึ้น session บุคคลทั่วไป ?> 

      <?php
        foreach($data_public_article as $items) {
          
      
      ?>
      <!-------------------------------------------------------->
      <div class="input-group">
        <input hidden type="text" name="ref_art_id<?php echo $num;?>" value="<?php echo isset($editData) ? $items['ref_art_id'] : '' ?>">
        <span class="input-group-text">ผู้รับผิดชอบโครงการ</span>
        <select class="form-select" aria-label="Default select example" name="nameprefix_id<?php echo $num;?>" >
        <option value="">--Choose--</option>
            <?php foreach ($result_np as $results) : ?>
                <option value="<?= $results['nameprefix_id'] ?>"<?= $items['nameprefix_id'] == $results['nameprefix_id'] ? 'selected' : ''?>><?= $results['nameprefix'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="fname<?php echo $num;?>" aria-label="First name" class="form-control" value="<?php echo isset($items) ? $items['fname'] : '' ?>" >
        <input type="text" name="lname<?php echo $num;?>" aria-label="Last name" class="form-control" value="<?php echo isset($items) ? $items['lname'] : '' ?>" >
        <label> &nbsp;&nbsp;&nbsp;&nbsp; </label>
        <span class="input-group-text">สถานะผู้รับผิดชอบ</span>
        <select class="form-select" aria-label="Default select example" name="ref_art_status_id<?php echo $num; ?>" >
          <option value="">--Choose--</option>
          <?php foreach ($result_as as $results) : ?>
            <option value="<?= $results['aut_status_id'] ?>"<?= $items['ref_art_status_id'] == $results['aut_status_id'] ? 'selected' : ''?>><?= $results['aut_status'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <br>
      <?php $num++; } ?>

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
        <select class="form-select" aria-label="Default select example" name="ref_art_type_id" >
          <option value=""><?php echo $data['article_type']?></option>
                            <?php foreach ($result_at as $results) : ?>
                                <option value="<?= $results['article_type_id'] ?>"<?= $editData['ref_art_type_id'] == $results['article_type_id'] ? 'selected' : ''?>><?= $results['article_type'] ?></option>
                            <?php endforeach; ?>
                        </select>
        <!--------------------------------------->
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-text">ปี พ.ศ. ที่เผยแพร่</span>
        <input type="number" name="art_year" aria-label="art_year" class="form-control" value="<?php echo isset($editData) ? $editData['art_year'] : '' ?>" >
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-text">ช่องทางการเผยแพร่</span>
        <input type="text" name="art_publicity" aria-label="art_publicity" class="form-control" value="<?php echo isset($editData) ? $editData['art_publicity'] : '' ?>" >
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-text">ฉบับที่</span>
        <input type="text" name="issue" aria-label="issue" class="form-control" value="<?php echo isset($editData) ? $editData['issue'] : '' ?>" >
        <span class="input-group-text">หน้า</span>
        <input type="number" name="start_page" aria-label="start_page" class="form-control" value="<?php echo isset($editData) ? $editData['start_page'] : '' ?>" >
        <span class="input-group-text">ถึง</span>
        <input type="number" name="end_page" aria-label="end_page" class="form-control" value="<?php echo isset($editData) ? $editData['end_page'] : '' ?>" >
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-text">ระดับคุณภาพผลงานทางวิชาการ</span>
        <!--------------------------------------->
        <select class="form-select" aria-label="Default select example" name="ref_quality_level_id" >
          <option value=""><?php echo $data['quality_level']?></option>
                            <?php foreach ($result_ql as $results) : ?>
                                <option value="<?= $results['quality_level_id'] ?>"<?= $editData['ref_quality_level_id'] == $results['quality_level_id'] ? 'selected' : ''?>><?= $results['quality_level_score'] ?> : <?= $results['quality_level'] ?></option>
                            <?php endforeach; ?>
                        </select>
        <!--------------------------------------->
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