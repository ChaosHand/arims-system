<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once('database.php');
include('config.php');
  if(isset($_POST) & !empty($_POST)){
    $input = $_POST['input'];
    $sql = "SELECT * FROM `tbl_user` WHERE ";

      if(filter_var($input, FILTER_VALIDATE_EMAIL)){
        $sql .= "email='$input'";
      }else{
        $sql .= "username='$input'";
      }
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count == 1){

      $r = mysqli_fetch_assoc($res);
      $username = $r['username'];
      $password = $r['password'];
      
      require_once "PHPMailer/PHPMailer.php";
      require_once "PHPMailer/SMTP.php";
      require_once "PHPMailer/Exception.php";

      $mail = new PHPMailer();
      //Tell PHPMailer to use SMTP
      $mail->isSMTP();
      //Enable SMTP debugging
      // 0 = off (for production use)
      // 1 = client messages
      // 2 = client and server messages
      $mail->SMTPDebug = 0;
      //Ask for HTML-friendly debug output
      $mail->Debugoutput = 'html';
      //Set the hostname of the mail server
      $mail->Host = "smtp-mail.outlook.com";
      //Set the SMTP port number - likely to be 25, 465 or 587
      $mail->Port =  587;
      //Set the encryption system to use - ssl (deprecated) or tls
      $mail->SMTPSecure = 'STARTTLS';
      //Whether to use SMTP authentication
      $mail->SMTPAuth = true;
      //Username to use for SMTP authentication
      $mail->Username = "sendingbot123@hotmail.com";
      //Password to use for SMTP authentication
      $mail->Password = "Send.Bot321";
      //Set who the message is to be sent from
      $mail->setFrom('sendingbot123@hotmail.com', 'Admin');
      //Set who the message is to be sent to
      $mail->addAddress($input);
      //Set the subject line
      $mail->Subject = 'Your User';
      $mail->Body    = "ํYour username is $username <br></br>  
                        Your Password is $password";
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo '<script>alert("Message has been sent")</script>';
        }
    }

  }
?>

<!DOCTYPE html>
<html lang="en">
<title>Forgot Password Script in PHP & MySQL</title>
<link rel="icon" type="image/x-icon" href="BA.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">	
	<link rel="stylesheet" href="css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .btn {
    background: #01143f;
    color: white;
  }
  strong {
    color: #01143f;
  }
  .container{
    height: 150px;
    width: 1200px;
  }
  .login{
    font-size: 20px;
    text-align: right;
  }
  </style>

</head>
<body>
<div style="background-color: #01143f; color: white; text-align: center;">
    <img class="img-fluid" src="Banner.png" alt="Banner">  
</div>
	<div class="container">
  <section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(BA.png);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      		</div>
			      	</div>

      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>


      <form class="login-script.php" method="POST" class="signin-form">
      <div class="form-group mb-3">
        <h2 class="form-signin-heading">Enter your Email</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" name="input" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        </div>
        <div>
        <button type="submit" class="form-control btn rounded submit px-3">Submit<br></br></button>
        </div>     
      </form>
      <div>
        <a class="login" href="login-form.php">login</a>
      </div>
</div>
</body>
</html>