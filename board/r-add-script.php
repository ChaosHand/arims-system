<?php 

session_start();

include "../database.php";

if (isset($_POST['submit'])) {

// from form add more
$p_id = $_POST['pro_id'];
////////////// first q 
$r_name = $_POST['r_name'];
$r_contract_id = $_POST['r_contract_id'];   
$r_year = $_POST['r_year'];
$ref_research_details_id = $_POST['ref_research_details_id'];   
$r_fund = $_POST['r_fund'];  






$research_check = "SELECT * FROM research WHERE r_name = '$r_name'";
$result = mysqli_query($conn, $research_check);
$research = mysqli_fetch_array($result);



//////////check name
if ($research == null){
  $research['r_name'] ='data not found';
}
if ($research['r_name'] == $r_name) {
    echo "<script>alert('Research name already exists');</script>";
    echo "<script>document.location = 'r-add-form.php'</script>";
} else {

    /////////////////////q1
    $query = "INSERT INTO research (r_id, r_contract_id, r_year, r_name, ref_research_details_id, r_fund)
                VALUE ('$p_id', '$r_contract_id', '$r_year', '$r_name', '$ref_research_details_id', '$r_fund')";
    $result = mysqli_query($conn, $query);
  
    ///////////////q2 in q1
    $nameprefix_id = $_POST['nameprefix_id'];
    $firstname = $_POST['firstname']; 
    ///////// like f and l
    $lastname = $_POST['lastname'];
    $aut_status = $_POST['ref_aut_status_id'];
    $research_author_percent = $_POST['research_author_percent'];    
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
        $query2 = "INSERT INTO research_author (ref_r_id,ref_r_contract,ref_user_id,ref_aut_status_id,research_author_percent,nameprefix_id,fname,lname)
        VALUE ('$p_id','$r_contract_id', '$myid','$aut_status[$numberlist]','$research_author_percent[$numberlist]','$nameprefix_id[$numberlist]','$firstname[$numberlist]','$lastname[$numberlist]')";  
        $numberlist ++;      
        $exeq2 = mysqli_query($conn, $query2);
   
     ///// insert q2
    }else{
       // echo "<script>alert('ไม่พบชื่อผู้รับผิดชอบโครงการ กรุณาตรวจสอบใหม่อีกครั้ง');</script>";    
          // $_SESSION['success'] = "Wrong name";
          //$numberlist = 0;
          $querypublicuser = "INSERT INTO r_publicuser (ref_r_id,nameprefix_id,fname,lname,ref_art_status_id,r_public_percent)
          VALUE ('$p_id','$nameprefix_id[$numberlist]','$firstname[$numberlist]','$lastname[$numberlist]','$aut_status[$numberlist]','$research_author_percent[$numberlist]')";
          $numberlist ++;  
          $querycomandpublicuser = mysqli_query($conn, $querypublicuser);
          // echo "<script>document.location = 'r-add-form.php'</script>";
      
    }
    
    echo "<script>alert('การเพิ่มผลงานวิจัยสำเร็จ!');</script>";    
    $_SESSION['success'] = "success";
    echo "<script>document.location = 'r-add-form.php'</script>";

}        

}   
?>
<?php } ?>