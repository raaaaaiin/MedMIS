<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
// Include config file
require_once "../connect.php";

?>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SRNHS</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
	<link rel = "stylesheet" type = "text/css" href = "../css/style-add.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/style.css" />
		<style>
	
.bg {
  /* The image used */
  background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwr3948AbA6QSmAWd5uXBH7XdsN5-zW-CTOw&usqp=CAU);

  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
	</style>
</head>

<body onload="myFunction()" class="bg-info">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center" >

      <div class="col-lg-5">

        <div class="card o-hidden border-0 shadow-lg my-5" >
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->

             
              <div class="col-lg-12" style="background:url('img/binary.png') ">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">
					<img src="../img/medilogo.png" style="width:150px;margin-bottom:50px;" autofill="off"></h1>
                  </div>
                    <form class="user"  method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype = "multipart/form-data" autocomplete="off" style="margin-top:100px;">
                    <div class = "form-group"  <?php echo (!empty($username_err)) ? 'has-error' : ''; ?> style="margin-top:-100px;">
									<input type="text" class="form-control form-control-user"name = "email"  id="exampleInputUser" aria-describedby="emailHelp" placeholder="Enter Email..." autofocus>
                      <span class="help-block"  style="color:#DC143C;"><?php echo $username_err; ?></span>
								</div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                      </div>
					 
                    </div>
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Verify Passwor Now" name="forgot"/>
                    <hr>
                    
                  </form>
                  <div class="text-center">
				  <a href="index.php">Back to Login</registration>
                  </div>
                </div>
                <?php 
                if(isset($_POST['forgot'])){
                        $email = $_POST['email'];
						$sql1="SELECT count(*) AS total1 FROM `user_account` WHERE `email` = '$email' ";
						$result1=mysqli_query($conn,$sql1);
						$data1=mysqli_fetch_assoc($result1);
						if($data1['total1']>=1){
					$password = date("yhmisd",time());
					$param_password = password_hash($password, PASSWORD_DEFAULT);	    
				    $update_module = $conn->query("UPDATE user_account SET password='$param_password' WHERE `email` = '$email'");
				    if ($update_module) {
					$to =     $email;
      $subject = 'Temporary Password';
      $from = 'noreply@email.combase.com';
 
// To send HTML mail, the Content-type header must be set
   $headers .= 'Medigrab.'."\r\n";
   $headers  = 'MIME-Version: 1.0' . "\r\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $headers .= 'X-Priority: 3'."\r\n";
   $headers .= 'X-Mailer: PHP". phpversion() .'."\r\n";
    // Compose a simple HTML email message    
    $message = '<html><body>';
    $message .= '<center><div style="width:570px;">';
    $message .= '</br>';
    $message .= '<p style="text-transform:capitalize;font-family:calibri;text-align:left;"><b>MediGrab</b></p><br>';
    $message .= '<p style="text-transform:capitalize;font-family:calibri;text-align:left;"><b>Hi '.$to.'</b></p><br>';
    $message .= '<p style="text-transform:capitalize;font-family:calibri;text-align:left;">We reset your password temporary<br>'; 
    $message .= ' please update your password once you login.  <br>'; 
    $message .= '<p style="text-transform:capitalize;font-family:calibri;text-align:left;"><b>Use this Password:'.$password.'</b></p>'; 
    $message .= '</div></center>';                                                   
    $message .= '</body></html>';
    if(mail($to, $subject, $message, $headers)){}	    
						    	echo '<script>
								function myFunction() {
								swal({
								title: "Successfully Verified",
								text: "We Sent a Temporary Password to Your Email",
								icon: "success",
								button: "Ok",
								});}
							   </script>';
				    }else{
				        
				    }
						    
						}else{
						         echo '<script>
								function myFunction() {
								swal({
								title: "Sorry",
								text: "We Hit the Zero Quantity of this Product",
								icon: "error",
								button: "Ok",
								});}
							   </script>';

						}
                }
                ?>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<script src="../js/three.r92.min.js"></script>
<script src="../js/vanta.birds.min.js"></script>

  <!-- Custom scripts for all pages-->
</body>

</html>
