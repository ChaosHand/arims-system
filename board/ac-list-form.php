<?php
include('../database.php');

$fetchData= fetch_data($conn);

// fetch query
function fetch_data($conn){
 

  $query="SELECT art.*, at.*, ql.*

  FROM article as art

  INNER JOIN article_type as at ON art.ref_art_type_id = at.article_type_id
  INNER JOIN quality_level as ql ON art.ref_quality_level_id = ql.quality_level_id";
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
  <title>Academic List</title>
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
          <a href="change-lastname.php" class="btn btn-primary" role="button">Change Password</a>
          <label> &nbsp;&nbsp;&nbsp;&nbsp; </label>
          <a href="../logout.php" class="btn btn-primary" role="button">Logout</a>
        </form>
    </div>
  </nav>

  <div class="container mt-5 text-center">
    <p class="h1"><strong>ข้อมูลผลงานวิชาการ</strong></p> <br><br>
    <table class="table table-bordered mt-4">
            <tr class="table-head">
                <!--Head data table-->
                <th scope="col">ลำดับที่</th>
                <th>ชื่อผลงาน</th>  
                <th>ผู้รับผิดชอบผลงาน</th>     
                <th>ประเภทบทความ</th>
                <th>ปีที่เผยแพร่</th>
                <th>แหล่งที่เผยแพร่</th>
                <th>ฐาน</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
            <?php
                if(count($fetchData)>0)
                {
                    $num = 1;
                    $no = 1;
                    foreach($fetchData as $data)
                {
            ?>
            <tr>
                <td><?php echo $num; ?></td>
                <td><?php echo $data['art_name'] ?></td>
<!--Query ตัวแปร--> 
                <td>
                  <?php
                  // ข้อมูลชุดที่ 1 หาข้อมูลหลัก แบบรีเลชั่น
                    $get = $data['art_id'];

                    $show = "SELECT tbl_user.*, article_author.*, nameprefix.*, branch.*, userlevel.*
                            from tbl_user

                            INNER JOIN article_author ON tbl_user.user_id = article_author.ref_user_id       
                            INNER JOIN nameprefix ON tbl_user.ref_nameprefix_id = nameprefix.nameprefix_id
                            INNER JOIN branch ON  tbl_user.ref_branch_id = branch.branch_id
                            INNER JOIN userlevel ON tbl_user.ref_userlevel_id = userlevel.userlevel_id

                            WHERE article_author.ref_art_id=$get
                            
                            ORDER BY article_author.ref_aut_status_id ASC";
                    $exec = mysqli_query($conn, $show);
                    $row2 = mysqli_fetch_all($exec,MYSQLI_ASSOC);

                    if (count($row2) > 0){
                      $no = 1;
                      foreach ($row2 as $data2) {
                        // ข้อมูลชุดที่ 2 หาข้อมูลสถานะของผู้เขียนโครงการ ตาม ID นั้นๆ
                        $get_article = "SELECT *
                                        from ac_aut_status WHERE aut_status_id = {$data2['ref_aut_status_id']}";
                                        
                                        $query_article = mysqli_query($conn, $get_article);
                                        $items = mysqli_fetch_array($query_article,MYSQLI_ASSOC);

                         echo $data2['nameprefix']. " ", $data2['firstname']. " ", $data2['lastname']. "<br>", "<b>สถานะ : </b>". $items['aut_status'] ?><br><br>
                         
                  <?php
                      $no++;
                      }
                    }
                  ?>     
                  <?php
                    $showpublic = "SELECT publicuser.* , nameprefix.*  FROM publicuser 
                    INNER JOIN nameprefix ON publicuser.nameprefix_id = nameprefix.nameprefix_id
                    WHERE ref_art_id = '{$get}'";
                    $execpublic = mysqli_query($conn, $showpublic);
                    $row3 = mysqli_fetch_all($execpublic,MYSQLI_ASSOC);

                    if (count($row3) > 0){
                      $nopublic = $no;
                      foreach ($row3 as $datapublic) {
                        // ข้อมูลชุดที่ 3 หาข้อมูลสถานะของผู้เขียนโครงการ ตาม ID นั้นๆ
                        $get_article = "SELECT *
                                        from ac_aut_status WHERE aut_status_id = {$datapublic['ref_art_status_id']}";
                                        
                                        $query_article = mysqli_query($conn, $get_article);
                                        $items = mysqli_fetch_array($query_article,MYSQLI_ASSOC);

                         echo $datapublic['nameprefix']. " ", $datapublic['fname']. " ", $datapublic['lname']. "<br>", "<b>สถานะ : </b>". $items['aut_status'] ?><br><br>
                         
                  <?php
                      $nopublic++; }
                    }
                  ?>   
                </td>

                <td><?php echo $data['article_type'] ?></td>
                <td><?php echo $data['art_year'] ?></td>
                <td><?php echo "<i>".$data['art_publicity']."</i>"."<br>", "<b>ฉบับที่ : </b>". $data['issue']."<b> หน้า </b>". $data['start_page']."<b> ถึง </b>". $data['end_page'] ?></td>
                <td><?php echo $data['quality_level_score'] ?></td>
                <!-- <td><a href="docs/<?php echo $row['art_file'];?>" target="_blank" class="btn btn-info btn-sm"> เปิดดู </a></td> -->
                <td><a href="ac-edit-form.php?edit=<?php echo $data['art_id'];?>">แก้ไข</a></td>
                <td><a href="ac-delete.php?delete=<?php echo $data['art_id'];?>">ลบ</a></td>
            </tr>
            <?php 
                $num++;
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

  <footer>
    <p>Copyright © 2020 by Faculty of Business Administrations Tel : +66 - 098 7763315</p>
  </footer>
</body>
</html>