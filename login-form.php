<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
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
  </style>
</head>
<body>
<?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <?php 
                    echo $_SESSION['success'];
                ?>
            </div>
        <?php endif; ?>


        <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <?php 
                    echo $_SESSION['error'];
                ?>
            </div>
        <?php endif; ?>
<div style="background-color: #01143f; color: white; text-align: center;">
    <img class="img-fluid" src="Banner.png" alt="Banner">  
</div>
   
    
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
                <p class="h1"><strong>LOGIN</strong></p>   
			      		</div>
			      	</div>
							<form action="login-script.php" method="post" class="signin-form">
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Username</label>
			      			<input type="text" name="uname" class="form-control" placeholder="Username" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" name="password" class="form-control" placeholder="Password" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" name="submit" class="form-control btn rounded submit px-3">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
                  <a href="forgot-password.php">Forgot Password</a>
									</div>
		            </div>
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

<div style="margin-top: 300px; background-color: #01143f; color: white; text-align: center;position: fixed;
padding: 10px 10px 0px 10px;
bottom: 0;
width: 100%;
height: 40px;">
 <p>Copyright © 2020 by Faculty of Business Administrations Tel : +66 - 098 7763315</p>
</div>  
	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</body>
</html>

<?php 

    if (isset($_SESSION['success']) || isset($_SESSION['error'])) {
        session_destroy();
    }

?>
