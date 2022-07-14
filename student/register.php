<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MediGrab</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>
</head>

<body   onload="myFunction()" class="bg-info">

  <div class="container" >

    <div class="card o-hidden border-0 shadow-lg my-5" 
	>
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block" style="border-right:1px black solid;"><center>
		  <img src="../img/medilogo.png" style="margin-top:150px;width:150px;"></center></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-white-900 mb-4" >Create an Account</h1>
              </div>
              <form class="user"  method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype = "multipart/form-data" autocomplete="off">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
				  <label>Business Name</label>
                    <input type="text" class="form-control"   style=" text-transform:capitalize;"required = "required" name = "lname" >
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0"><label>Company Logo </label>
                    <input type="file" class="form-control"	 required = "required" name = "mname" >
				  
                  </div>
                </div>
                <div class="form-group row">
					<div class="col-sm-6 mb-3 mb-sm-0">
					    <label>Barangay </label>
                    <input type="text" class="form-control"	style=" text-transform:capitalize;"required = "required" name = "brgy">
					
					</div>
					<div class="col-sm-6 mb-3 mb-sm-0">
					    <label>City </label>
                    <input type="text" class="form-control"	style=" text-transform:capitalize;"required = "required" name = "city">
					
					</div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6  mb-3 mb-sm-0">
					<input type="email" class="form-control"  required = "required"name="email2" id="email2" placeholder="Email Address">
					<div id="status2"></div>
				  </div>
				  <div class="col-sm-6  mb-sm-0">
						<input type="text" class="form-control "required = "required" name="username2" id="username2" placeholder="User Name">
						<div id="status"></div>
				  </div>
				</div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control"  required = "required" placeholder="Password" name = "password2" id="password2" onkeyup='check();' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
						<div id="err" ></div>
						<div id="err2"></div>
                  </div>
                  <div class="col-sm-6 mb-sm-0">
                    <input type="password" class="form-control" required = "required" name = "confirm_password" id="confirm_password" placeholder="Repeat Password" onkeyup='check();'>
                  </div>
                </div>
                <button  class = "btn btn-primary btn-user btn-block" name="register"  id="register" ><span class = "glyphicon glyphicon-save"></span> Save</button>
				<hr>
              </form>
              <div class="text-center">
              </div>
              <div class="text-center">
					  <a href="index.php" class="btn btn-success btn-user btn-block">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
</body>
<script>
var check = function() {
  if (document.getElementById('password2').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('password2').style.border = 'green 2px solid';
    document.getElementById('confirm_password').style.border = 'green 2px solid';
    document.getElementById('err2').innerHTML = '<br><span style="color:green;" > </span> Password confirm';
  } else {
    document.getElementById('password2').style.border = 'red 2px solid';
    document.getElementById('confirm_password').style.border = 'red 2px solid';
    document.getElementById('err2').innerHTML = '<br><span style="color:red;" > </span> Password and confirm password is not match';
  }
}
</script>
</html>
<?php

// Include config file
require_once "../connect.php";

// Define variables and initialize with empty values
$username = $email =$fname=$mname=$lname = $password = $confirm_password = "";
$username_err = $email_err =$fname_err =$mname_err =$lname_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if(isset($_POST['register'])){
  $city = $_POST['city'];
  $brgy = $_POST['brgy'];
  
	date_default_timezone_set('Asia/Manila'); 
	$rtransdate = date('m/d/Y h:i:s a', time());
	$cur_date = date('d').date('m').date('y');
	$brand = "LOGO";
	$invoice = $brand.$cur_date;
	$customer_id = rand(00000 , 99999);
	$uRefNo = $invoice.'-LESSON-'.$customer_id;
     
    $tmp=$_FILES["mname"]["tmp_name"];
    $extension = explode("/", $_FILES["mname"]["type"]);
    $name=$uRefNo.".".$extension[1];
     
    move_uploaded_file($tmp, "img/" . $uRefNo.".".$extension[1]);
  $lname = $_POST['lname'];
  $position = "Pharmacy";
    // Validate username
    if(empty(trim($_POST["username2"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT u_id FROM user_account WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username2"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username2"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
	if(empty(trim($_POST["email2"]))){
        $email_err = "Please enter a email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT u_id FROM user_account WHERE email = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email2"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email2"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Validate password
    if(empty(trim($_POST["password2"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password2"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password2"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user_account (username,email,password,fname,mname,lname,position,user_id_number,status,brgy,city,ref) VALUES (?,?,?,'','$name','$lname','$position','','Approve','$brgy','$city','')";
        $date23 = date('m/d/Y h:i:s a', time());
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username,$param_email, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
               echo '<script>
									function myFunction() {
										swal({
										title: "Success!",
										text: "Your Account Successfully Recorded",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "index.php";
									  });}
									
									</script>';
            } else{
                echo '<script>
									function myFunction() {
									swal({
									title: "Failed!",
									text: "Please Try Again",
									icon: "error",
									button: "Ok",
									});}
									</script>';
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>