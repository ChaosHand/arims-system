<?php
    include("edit-script.php");

    $fetchData= fetch_data($conn);

// fetch query
function fetch_data($conn){
  $query="SELECT u.*, np.*, b.*, ul.*

  FROM tbl_user as u

  INNER JOIN nameprefix as np ON u.ref_nameprefix_id = np.nameprefix_id
  INNER JOIN branch as b ON  u.ref_branch_id = b.branch_id
  INNER JOIN userlevel as ul ON u.ref_userlevel_id = ul.userlevel_id
  
  ORDER BY user_id ASC";

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
          <a href="change-password-form.php" class="btn btn-primary" role="button">Change Password</a>
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
    <p class="h1"><strong>แก้ไขข้อมูลผู้ใช้</strong></p> <br><br>
    <form action="edit-form.php?edit= <?php echo $editData['user_id']; ?>" method="post">
      <div class="input-group">
        <span class="input-group-text">ID</span>
        <input type="text" name="user_id" aria-label="user_id" class="form-control" value="<?php echo isset($editData) ? $editData['user_id'] : '' ?>" disabled>
      </div>
      <br>                    
      <div class="input-group">
        <span class="input-group-text">ชื่อ-นามสกุล ผู้ใช้</span>
        <!--------------------------------------->
          <select class="form-select" aria-label="Default select example" name="ref_nameprefix_id" required>
          <option value=""><?php echo $data['nameprefix']?></option>
                            <?php foreach ($result_np as $results) : ?>
                                <option value="<?= $results['nameprefix_id'] ?>"<?= $editData['ref_nameprefix_id'] == $results['nameprefix_id'] ? 'selected' : ''?>><?= $results['nameprefix'] ?></option>
                            <?php endforeach; ?>
                        </select>
        <!--------------------------------------->
        <input type="text" name="firstname" aria-label="First name" class="form-control" value="<?php echo isset($editData) ? $editData['firstname'] : '' ?>" required>
        <input type="text" name="lastname" aria-label="Last name" class="form-control" value="<?php echo isset($editData) ? $editData['lastname'] : '' ?>" required>
      </div>
      <br>                    
      <div class="input-group">
        <span class="input-group-text">สาขา</span>        
        <!--------------------------------------->
        <select class="form-select" aria-label="Default select example" name="ref_branch_id" required>
          <option value=""><?php echo $data['branch']?></option>
                            <?php foreach ($result_b as $results) : ?>
                                <option value="<?= $results['branch_id'] ?>"<?= $editData['ref_branch_id'] == $results['branch_id'] ? 'selected' : ''?>><?= $results['branch'] ?></option>
                            <?php endforeach; ?>
                        </select>
        <!--------------------------------------->
      </div>
      <br>                    
      <div class="input-group">
        <span class="input-group-text">สิทธิ์การเช้าใช้งาน</span>
        <!--------------------------------------->
        <select class="form-select" aria-label="Default select example" name="ref_userlevel_id" required>
          <option value=""><?php echo $data['userlevel']?></option>
                            <?php foreach ($result_ul as $results) : ?>
                                <option value="<?= $results['userlevel_id'] ?>"<?= $editData['ref_userlevel_id'] == $results['userlevel_id'] ? 'selected' : ''?>><?= $results['userlevel'] ?></option>
                            <?php endforeach; ?>
                        </select>
        <!--------------------------------------->
      </div>
      <br>
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn" type="submit" name="update">Update</button>
      </div>
    </form>
  </div>
  <footer>
    <p>Copyright © 2020 by Faculty of Business Administrations Tel : +66 - 098 7763315</p>
  </footer>
</body>
</html>
<?php } ?>