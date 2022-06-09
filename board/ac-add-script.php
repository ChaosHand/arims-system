<?php 

session_start();

include "../database.php";

if (isset($_POST['submit'])) {

// from form add more
$p_id = $_POST['pro_id'];
////////////// first q  
$art_name = $_POST['art_name'];
$ref_art_type_id = $_POST['ref_art_type_id'];   
$art_year = $_POST['art_year'];
$art_publicity = $_POST['art_publicity'];   
$issue = $_POST['issue'];  
$start_page = $_POST['start_page'];
$end_page = $_POST['end_page'];    
$ref_quality_level_id = $_POST['ref_quality_level_id'];  
// $file_name = $_POST['file_name'];  
// $art_file = $_POST['art_file'];  

$article_check = "SELECT * FROM article WHERE art_name = '$art_name'";
$rs = mysqli_query($conn,$article_check);
$article = mysqli_fetch_array($rs);

// print_r ($_POST['firstname']); 
// print_r ($_POST['lastname']); 
//////////check name
if ($article['art_name'] == null) {
  $article['art_name'] ='data not found';
}
if ($article['art_name'] == $art_name) {
    echo "<script>alert('Academic name already exists');</script>";
    echo "<script>document.location = 'ac-add-form.php'</script>";
} else {

    /////////////////////q1
    $query = "INSERT INTO article (art_name,art_id, ref_art_type_id, art_year, art_publicity, issue, start_page, end_page, ref_quality_level_id)
                VALUE ('$art_name','$p_id', '$ref_art_type_id', '$art_year', '$art_publicity', '$issue', '$start_page', '$end_page', '$ref_quality_level_id')";
    $result = mysqli_query($conn, $query);
  
    ///////////////q2 in q1
    $nameprefix_id = $_POST['nameprefix_id'];
    $firstname = $_POST['firstname']; 
    ///////// like f and l
    $lastname = $_POST['lastname'];
    $ref_aut_status_id = $_POST['ref_aut_status_id'];
    $checkuser = false ;
    $checknumberlist = 0;
    foreach($firstname as $dataid){ 
     
      //$queryidname = "SELECT * FROM tbl_user WHERE firstname  = '$dataid' AND lastname = '$lastname[numberlist]'"; SELECT * FROM `tbl_user` WHERE firstname='ธิดารัตน์' AND lastname='แซ่ยะ';
      $queryidname = "SELECT * FROM tbl_user WHERE firstname='{$firstname[$checknumberlist]}' AND lastname='{$lastname[$checknumberlist]}'";
      $execid = mysqli_query($conn,$queryidname);

     if(mysqli_num_rows($execid)<=0){
       $checkuser = true;
     } 
    }     
    if($checkuser){
      echo "<script>alert('ไม่พบชื่อผู้รับผิดชอบโครงการ กรุณาตรวจสอบใหม่อีกครั้ง');</script>";    
      $_SESSION['success'] = "Wrong name";
      echo "<script>document.location = 'ac-add-form.php'</script>";
    }
    /////////find id from name
    $numberlist = 0;
    
    foreach($firstname as $dataid){ 
     
        //$queryidname = "SELECT * FROM tbl_user WHERE firstname  = '$dataid' AND lastname = '$lastname[numberlist]'"; SELECT * FROM `tbl_user` WHERE firstname='ธิดารัตน์' AND lastname='แซ่ยะ';
        $queryidname = "SELECT * FROM tbl_user WHERE firstname='{$firstname[$numberlist]}' AND lastname='{$lastname[$numberlist]}'";
        $execid = mysqli_query($conn,$queryidname);
        // echo $firstname[$numberlist];
        // echo "<br>";
        // echo $lastname[$numberlist];
       if(mysqli_num_rows($execid)>0){
        //    $myid = array();
         $cidname = mysqli_fetch_assoc($execid);
        $myid = $cidname['user_id'];

        //////////done finding #myid
        $query2 = "INSERT INTO article_author (ref_art_id,ref_user_id,ref_aut_status_id,prefix_id,firstname,lastname)
        VALUE ('$p_id', '$myid','$ref_aut_status_id[$numberlist]','$nameprefix_id[$numberlist]','$firstname[$numberlist]','$lastname[$numberlist]')";
        $numberlist ++;   
     $exeq2 = mysqli_query($conn, $query2);

     ///// insert q2
      }else{
          // echo "<script>alert('ไม่พบชื่อผู้รับผิดชอบโครงการ กรุณาตรวจสอบใหม่อีกครั้ง');</script>";    
          // $_SESSION['success'] = "Wrong name";
          //$numberlist = 0;
          $querypublicuser = "INSERT INTO publicuser (ref_art_id,nameprefix_id,fname,lname,ref_art_status_id)
          VALUE ('$p_id','$nameprefix_id[$numberlist]','$firstname[$numberlist]','$lastname[$numberlist]','$ref_aut_status_id[$numberlist]')";
          $numberlist ++;  
          $querycomandpublicuser = mysqli_query($conn, $querypublicuser);
          // echo "<script>document.location = 'ac-add-form.php'</script>";
          
        }
        
        echo "<script>alert('การเพิ่มผลงานวิชาการสำเร็จ!');</script>";    
        $_SESSION['success'] = "success";
        echo "<script>document.location = 'ac-add-form.php'</script>";

    }        
  
  }   

?>
<?php } ?>