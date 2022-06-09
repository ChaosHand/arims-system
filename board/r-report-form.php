<?php
require_once('../database.php');

$fetchData= fetch_data($conn,'');

// fetch query
function fetch_data($conn,$request){

  $query="SELECT r.*, ra.*, rd.*, users.*, bra.*

  FROM research as r

  INNER JOIN research_author as ra ON r.r_id = ra.ref_r_id
  INNER JOIN research_details as rd ON r.ref_research_details_id = rd.research_details_id
  INNER JOIN tbl_user as users ON ra.ref_user_id = users.user_id
  INNER JOIN branch as bra ON users.ref_branch_id = bra.branch_id
  
  {$request}
  ORDER BY r_id ASC";

  $result2=mysqli_query($conn, $query);
  
  if(mysqli_num_rows($result2)>0){

    $row= mysqli_fetch_all($result2, MYSQLI_ASSOC);
    //$new = $row['article_type'];
    //print_r($row['article_type']);
  //return;
    return $row; 
        
  }else{
    return $row=[];
  }
}

function Search_filter_User($conn,$request){
 
//WHERE author.firstname LIKE '%ฉัตร%'
// WHERE ql.quality_level_score LIKE '%0.1%'
  $query="SELECT r.*, ra.*, rd.*, user.*, bra.*

  FROM research as r

  INNER JOIN research_author as ra ON r.r_id = ra.ref_r_id
  INNER JOIN research_details as rd ON r.ref_research_details_id = rd.research_details_id
  INNER JOIN tbl_user as users ON ra.ref_user_id = users.user_id
  INNER JOIN branch as bra ON users.ref_branch_id = bra.branch_id
  
  {$request}
  ORDER BY r_id ASC";
  $result2=mysqli_query($conn, $query);
  
  if(mysqli_num_rows($result2)>0){

    $row= mysqli_fetch_all($result2, MYSQLI_ASSOC);
    //$new = $row['article_type'];
    //print_r($row['article_type']);
  //return;
    return $row; 
        
  }else{
    return $row=[];
  }
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
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
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
  <div class="container mt-5 mb-5 text-center">
    <p class="h1"><strong>รายงานผลงานวิจัย</strong></p>
</div>
  <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-md-8 py-4">
        <form class="row" method="POST">
          <div class="col col-lg-2">
            <select class="form-select" name="select" required>
              <option value="" selected disabled> -- เลือกข้อมูล -- </option>
              <option value="r_year" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'r_year') {echo 'selected';}} ?>>ปี</option>
              <option value="firstname" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'firstname') {echo 'selected';}} ?>>เจ้าของผลงาน</option>
              <option value="branch" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'branch') {echo 'selected';}} ?>>สาขา</option>
              <option value="ref_research_details_id" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'ref_research_details_id') {echo 'selected';}} ?>>ประเภททุน</option>
            </select>
          </div>
          <div class="col">
            <input type="text" class="form-control" name="value" value="<?php if (isset($_POST['value'])) {echo $_POST['value'];} ?>" required/>
          </div>
          <div class="col-md-auto">
            <button type="submit" name="submit" class="btn btn-primary">ค้นหา</button>
          </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
          $num = 1;
          $sqlWhere = "";
          $sql = "SELECT * FROM research {$sqlWhere}";
          if($_POST['select']=='r_year'){
            $sqlWhere = "WHERE {$_POST['select']} LIKE '%{$_POST['value']}%'";
          }
          if($_POST['select']=='firstname'){
            $sqlWhere = "WHERE users.firstname LIKE '%{$_POST['value']}%'";
          }
          if($_POST['select']=='ref_research_details_id'){
            $sqlWhere = "WHERE rd.research_details LIKE '%{$_POST['value']}%'";
          }
          if($_POST['select']=='branch'){
            $sqlWhere = "WHERE bra.branch LIKE '%{$_POST['value']}%'";
          }
          echo $sqlWhere;
          $query = mysqli_query($conn,$sql);
          $check_data = mysqli_num_rows($query);
          if ($check_data == 0) {
            echo '<p class="text-center py-4"><span class="badge bg-danger" style="font-size: 20px;">ไม่พบข้อมูล</span></p>';
          }else{
            ?>
            <table class="table table-bordered mt-4">
            <tr class="table-head">
                <!--Head data table-->
                <th>ลำดับ</th>
                <th>ชื่อผลงาน</th>  
                <th>ผู้รับผิดชอบผลงาน</th>     
                <th>ประเภทบทความ</th>
                <th>ปีที่เผยแพร่</th>
                <th>จำนวนทุนวิจัยในโครงการ</th>
                <th>ไฟล์สัญญา</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
            <?php
                if(count($fetchData)>0)
                {
                    $num=1;
                    $no = 1;
                    foreach($fetchData as $data)
                {
            ?>
            <tr>
                <td><?php echo $num; ?></td>
                <td><?php echo $data['r_name'] ?></td>
<!--Query ตัวแปร--> 
                <td>
                  <?php
                  // ข้อมูลชุดที่ 1 หาข้อมูลหลัก แบบรีเลชั่น
                    $get = $data['r_id'];

                    $show = "SELECT tbl_user.*, research_author.*, nameprefix.*, branch.*, userlevel.*
                            from tbl_user

                            INNER JOIN research_author ON tbl_user.user_id = research_author.ref_user_id       
                            INNER JOIN nameprefix ON tbl_user.ref_nameprefix_id = nameprefix.nameprefix_id
                            INNER JOIN branch ON  tbl_user.ref_branch_id = branch.branch_id
                            INNER JOIN userlevel ON tbl_user.ref_userlevel_id = userlevel.userlevel_id

                            WHERE research_author.ref_r_id=$get";
                    $exec = mysqli_query($conn, $show);
                    $row2 = mysqli_fetch_all($exec,MYSQLI_ASSOC);

                    if (count($row2) > 0){
                      $no = 1;
                      foreach ($row2 as $data2) {
                        // ข้อมูลชุดที่ 2 หาข้อมูลสถานะของผู้เขียนโครงการ ตาม ID นั้นๆ
                        $get_research = "SELECT *
                                        from aut_status WHERE aut_status_id = {$data2['ref_aut_status_id']}";
                                        
                                        $query_research = mysqli_query($conn, $get_research);
                                        $items = mysqli_fetch_array($query_research,MYSQLI_ASSOC);

                         echo $data2['nameprefix']. " ", $data2['firstname']. " ", $data2['lastname']. "<br>", "<b>สถานะ : </b>". $items['aut_status'] , "( ". $data2['research_author_percent'], "% )";?><br><br>
                         
                  <?php
                      $num++;
                      $no++;
                      }
                    }
                  ?> 
                  <?php
                     $showpublic = "SELECT r_publicuser.* , nameprefix.*  FROM r_publicuser 
                     INNER JOIN nameprefix ON r_publicuser.nameprefix_id = nameprefix.nameprefix_id
                     WHERE ref_r_id = '{$get}'";
                     $execpublic = mysqli_query($conn, $showpublic);
                     $row3 = mysqli_fetch_all($execpublic,MYSQLI_ASSOC);
 
                     if (count($row3) > 0){
                       $nopublic = $no;
                       foreach ($row3 as $datapublic) {
                         // ข้อมูลชุดที่ 3 หาข้อมูลสถานะของผู้เขียนโครงการ ตาม ID นั้นๆ
                         $get_article = "SELECT *
                                         from aut_status WHERE aut_status_id = {$datapublic['ref_art_status_id']}";
                                         
                                         $query_article = mysqli_query($conn, $get_article);
                                         $items = mysqli_fetch_array($query_article,MYSQLI_ASSOC);
 
                          echo $datapublic['nameprefix']. " ", $datapublic['fname']. " ", $datapublic['lname']. "<br>", "<b>สถานะ : </b>". $items['aut_status'] ?><br><br>
                          
                   <?php
                       $nopublic++; }
                     }
                  ?>       
                </td>

                <td><?php echo $data['research_details'] ?></td>
                <td><?php echo $data['r_year'] ?></td>
                <td><?php echo $data['r_fund'] ?></td>
                <td><a href="docs/<?php echo $row['art_file'];?>" target="_blank" class="btn btn-info btn-sm"> เปิดดู </a></td>
                <td><a href="r-edit-form.php?edit=<?php echo $data['r_id'];?>">แก้ไข</a></td>
                <td><a href="r-delete.php?delete=<?php echo $data['r_id'];?>">ลบ</a></td>
            </tr>
            <?php 
                $no++;              
                }
                }
                else
                { ?>
                    <tr><td colspan ="10"> No data found</td></tr>
                <?php
                }
            ?>
            <tr>

            </tr>
        </table>
  </div>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <?php mysqli_close($conn);?>
</body>
<footer>
    <p>Copyright © 2020 by Faculty of Business Administrations Tel : +66 - 098 7763315</p>
  </footer>
</html>
<?php } ?>
<?php } ?>