<?php
include('../database.php');

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
    table, td, th {  
    border: 1px solid #ddd;
    text-align: left;
  }
  
  table {
    border-collapse: collapse;
    max-width: 100%;
    width: 100%;

  }
  .table-head {
    background-color: lightgray;
  }
  .table-data{
    
    width:65%;
    float: left;
  }
  th, td {
    padding: 15px;
  }
  tr:hover {background-color: rgb(90, 142, 253);}
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

  <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-md-8 py-4 mt-5">
        <form class="row" method="POST">
          <div class="col col-lg-2">
            <select class="form-select" name="select" required>
              <option value="" selected disabled> -- เลือกข้อมูล -- </option>
              
              <option value="nameprefix" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'nameprefix') {echo 'selected';}} ?>>คำนำหน้า</option>
              <option value="firstname" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'firstname') {echo 'selected';}} ?>>ชื่อ</option>
              <option value="branch" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'branch') {echo 'selected';}} ?>>สาขา</option>
              <option value="userlevel" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'userlevel') {echo 'selected';}} ?>>ตำแหน่งการเข้าใช้งาน</option>
            </select>
          </div>
          <div class="col">
            <input type="text" class="form-control" name="value" value="<?php if (isset($_POST['value'])) {echo $_POST['value'];} ?>" required/>
          </div>
          <div class="col-md-auto">
            <button type="submit" name="submit" class="btn btn-success">ค้นหา</button>
          </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
          $num = 1;
          $sql = "SELECT u.*, np.*, b.*, ul.*

          FROM tbl_user as u
        
          INNER JOIN nameprefix as np ON u.ref_nameprefix_id = np.nameprefix_id
          INNER JOIN branch as b ON  u.ref_branch_id = b.branch_id
          INNER JOIN userlevel as ul ON u.ref_userlevel_id = ul.userlevel_id
          
          WHERE ".$_POST['select']." LIKE '".$_POST['value']."%'";
          $query = mysqli_query($conn,$sql);
          $check_data = mysqli_num_rows($query);
          if ($check_data == 0) {
            echo '<p class="text-center py-4"><span class="badge bg-danger" style="font-size: 20px;">ไม่พบข้อมูล</span></p>';
          }else{
            ?>
            <table class="table table-bordered mt-4">
              <thead class="table-secondary">
                <tr>
                <th>รหัส</th>
                <th>คำนำหน้า</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>                
                <th>สาขา</th>
                <th>ตำแหน่ง</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($result = mysqli_fetch_array($query)) {
                  ?>
                  <tr>
                  <td><?php echo $result['user_id'] ?></td>
                  <td><?php echo $result['nameprefix'] ?></td>
                  <td><?php echo $result['firstname'] ?></td>
                  <td><?php echo $result['lastname'] ?></td>
                  <td><?php echo $result['branch'] ?></td>
                  <td><?php echo $result['userlevel'] ?></td></tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
            <?php
          }
        }
        ?>
      </div>
    </div>
  </div>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <?php mysqli_close($conn);?>




  <div class="container mt-5 text-center">
    <p class="h1"><strong>ข้อมูลผู้ใช้</strong></p> <br><br>
    <table class="table table-bordered mt-4">
            <tr class="table-head">
                <!--Head data table-->
                <th>รหัส</th>
                <th>คำนำหน้า</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>                
                <th>สาขา</th>
                <th>ตำแหน่ง</th>
            </tr>
            <?php
                if(count($fetchData)>0)
                {
                    $no = 1;
                    foreach($fetchData as $data)
                {
            ?>
            <tr>
                <td><?php echo $data['user_id'] ?></td>
                <td><?php echo $data['nameprefix'] ?></td>
                <td><?php echo $data['firstname'] ?></td>
                <td><?php echo $data['lastname'] ?></td>
                <td><?php echo $data['branch'] ?></td>
                <td><?php echo $data['userlevel'] ?></td>
              </tr>
            <?php 
                $no++;              
                }
                }
                else
                { ?>
                    <tr><td colspan ="7"> No data found</td></tr>
                <?php
                }
            ?>
            <tr>

            </tr>
        </table>
  </div>

  <footer>
    <p>Copyright © 2020 by Faculty of Business Administrations Tel : +66 - 098 7763315</p>
  </footer>
</body>
</html>