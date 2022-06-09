<?php
session_start();

require_once "../database.php";
# get ค่าจากลิ้งที่ส่งมา
if(isset($_GET['edit'])){
    $art_id= $_GET['edit'];
    $editData= edit_data($conn, $art_id);
}
$test_text = 'edit';
# เช็คอัพเดท ว่ามีการ edit ใหม
if(isset($_POST['update'])){
 $user_id= $_GET[$test_text];
    update_data($conn,$art_id);
    update_dataArticle($conn,$art_id);
} 


function edit_data($conn, $art_id)
{

    $article_check = "SELECT * FROM article WHERE art_id = '$art_id'";
    $rs = mysqli_query($conn,$article_check);
    $article = mysqli_fetch_array($rs);
    return $article;

}

// update data query
function update_data($conn, $art_id)
{
    //$user_id= legal_input($_POST['user_id']);
    $art_name= legal_input($_POST['art_name']);
    // $p_id= legal_input($_POST['art_id']);
    $ref_art_type_id= legal_input($_POST['ref_art_type_id']);
    $art_year = legal_input($_POST['art_year']);
    $art_publicity = legal_input($_POST['art_publicity']);
    $issue = legal_input($_POST['issue']);
    $start_page = legal_input($_POST['start_page']);
    $end_page = legal_input($_POST['end_page']);
    $ref_quality_level_id = legal_input($_POST['ref_quality_level_id']);

    $query="UPDATE article 
            SET art_name='$art_name',
                art_id='$art_id', 
                ref_art_type_id='$ref_art_type_id', 
                art_year='$art_year', 
                art_publicity='$art_publicity', 
                issue='$issue', 
                start_page='$start_page', 
                end_page='$end_page',
                ref_quality_level_id='$ref_quality_level_id' WHERE art_id=$art_id";
    $result = mysqli_query($conn, $query);
    update_dataArticle($conn,$art_id);    
    update_dataPublic($conn,$art_id);
    if($result= mysqli_query($conn,$query)){
        
        header('location:ac-list-form.php'); #redirect change path

    }else{
        $msg= "Error: " . $query . "<br>" . mysqli_error($conn);
        echo $msg;  
    }
}
function update_dataArticle($conn,$art_id)
{
    $new_query_article = "SELECT *  FROM article_author 
    INNER JOIN article ON article_author.ref_art_id = article.art_id
    INNER JOIN tbl_user ON article_author.ref_user_id = tbl_user.user_id
    INNER JOIN ac_aut_status ON article_author.ref_aut_status_id = ac_aut_status.aut_status_id

    WHERE ref_art_id = {$art_id}";
    $new_result_article = mysqli_query($conn, $new_query_article);
    $data_user_article = NULL;
    if(mysqli_num_rows($new_result_article)>0){

    $data_user_article= mysqli_fetch_all($new_result_article, MYSQLI_ASSOC);  
    }
    $text_ref_art_id='ref_art_id';
    $text_ref_aut_status_id = 'ref_aut_status_id';
    $num = 0;
    foreach($data_user_article as $items) {
        $text_ref_art_idNum=$text_ref_art_id.$num;
        $text_ref_aut_status_idNum =$text_ref_aut_status_id.$num;

        $queryUpdateArticle="UPDATE article_author SET ref_aut_status_id={$_POST[$text_ref_aut_status_idNum]} WHERE ref_art_id ={$_POST[$text_ref_art_idNum]} AND ref_user_id ={$items['ref_user_id']}";
        $resultUpdateArticle = mysqli_query($conn, $queryUpdateArticle);
        echo "success";
        if($resultUpdateArticle= mysqli_query($conn,$queryUpdateArticle)){
            

        }else{
            $msg= "Error: " . $queryUpdateArticle. "<br>" . mysqli_error($conn);
            echo $msg;  
        }
        $num++;
    }
}

function update_dataPublic($conn,$art_id)
{
    $checkuserhave_id="SELECT ref_user_id FROM article_author WHERE ref_art_id = '{$art_id}'";
    $qr_checkuserhave_id = mysqli_query($conn, $checkuserhave_id);
    $countuser=mysqli_num_rows($qr_checkuserhave_id);
    $index=0;
    if($countuser!=0){
        $index=$countuser;
    }

    $new_query_public = "SELECT publicuser.* , nameprefix.*
    FROM publicuser 
    INNER JOIN article ON publicuser.ref_art_id = article.art_id
    INNER JOIN nameprefix ON publicuser.nameprefix_id = nameprefix.nameprefix_id
    WHERE ref_art_id = '{$art_id}'";

    $new_result_public = mysqli_query($conn, $new_query_public);
    $data_public_article = NULL;
    if(mysqli_num_rows($new_result_public)>0){

    $data_public_article= mysqli_fetch_all($new_result_public, MYSQLI_ASSOC);  
    }
    $text_ref_art_id='ref_art_id';
    $text_nameprefix_id='nameprefix_id';
    $text_fname='fname';
    $text_lname='lname';
    $text_ref_aut_status_id = 'ref_art_status_id';
    $num = 0+$index;
    

    foreach($data_public_article as $items) {
        $queryidname = "SELECT * FROM tbl_user WHERE firstname='{$_POST[$text_fname]}' AND lastname='{$_POST[$text_lname]}'";
        $execid = mysqli_query($conn,$queryidname);
        if(mysqli_num_rows($execid)>0){
            // ลบ old data ข้อมูลเก่า
            $queryDeleteArticle="DELETE FROM publicuser WHERE id={$items['id']}";
            $resultDeleteArticle = mysqli_query($conn, $queryDeleteArticle);
            // Add USER
            $text_ref_art_idNum=$text_ref_art_id.$num;
            $text_ref_aut_status_idNum =$text_ref_aut_status_id.$num;

            $cidname = mysqli_fetch_assoc($execid);
            $myid = $cidname['user_id'];

            $query2 = "INSERT INTO article_author (ref_art_id,ref_user_id,ref_aut_status_id,prefix_id,firstname,lastname)
            VALUE ('$art_id', '$myid','{$_POST[$text_ref_aut_status_idNum]}','{$_POST[$text_nameprefix_id]}','{$_POST[$text_fname]}','{$_POST[$text_lname]}')";  
            $exeq2 = mysqli_query($conn, $query2);
        }else{
            
            $text_ref_art_idNum=$text_ref_art_id.$num;
            $text_ref_aut_status_idNum =$text_ref_aut_status_id.$num;
            $text_fname_idNum=$text_fname.$num;
            $text_lname_idNum =$text_lname.$num;
            $text_prefix_id_idNum =$text_nameprefix_id.$num;
    
            $queryUpdateArticle="UPDATE publicuser SET nameprefix_id={$_POST[$text_prefix_id_idNum]}, fname='{$_POST[$text_fname_idNum]}', lname='{$_POST[$text_lname_idNum]}', ref_art_status_id={$_POST[$text_ref_aut_status_idNum]} WHERE ref_art_id ={$_POST[$text_ref_art_idNum]} AND id ={$items['id']}";
            $resultUpdateArticle = mysqli_query($conn, $queryUpdateArticle);
            echo "success";
            if($resultUpdateArticle= mysqli_query($conn,$queryUpdateArticle)){
                
    
            }else{
                $msg= "Error: " . $queryUpdateArticle. "<br>" . mysqli_error($conn);
                echo $msg;  
            }
            $num++;
        }

    }
}

// convert illegal input to legal input
function legal_input($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}
?>