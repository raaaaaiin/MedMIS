<?php
session_start();
 require_once "../connect.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

	date_default_timezone_set('Asia/Manila');
?>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Calendar -->
  
  <link rel="stylesheet" href="../plugins/fullcalendar/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-interaction/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-daygrid/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-timegrid/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-bootstrap/main.min.css">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
  <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
  @media print {
	#printPageButton {
    display: none;
  }
  .printPageButton{
	   display: none;
  }
  
  .printHeader1{
	   background:#fff;
  }
}
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed" onload="myFunction()">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home.php" class="nav-link">Home</a>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-danger elevation-4"  >
    <a href="#" class="brand-link">
      
      <span class="brand-text font-weight-dark"><center>PMS</center></span>
	  
    </a>
    <div class="sidebar" >
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        </div>
        <div class="info">
          <a href="#" class="d-block" data-toggle="modal" data-target="#editProfile" style="text-transform:capitalize;color:white;text-stroke:2px solid black;">
		  <?php  
							$username = htmlspecialchars($_SESSION["username"]);
							$q = $conn->query("SELECT * FROM `admin` WHERE `username` = '$username'") or die(msqli_error());
							$f = $q->fetch_array();
								$u_id=$f['admin_id'];
								$username1=$f['username'];
								$name = "".$f['fname']." ".$f['mname']." ".$f['lname']."";
									echo $name;
						?>
		 </a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="home.php" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="monitoring.php" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Patient Monitoring
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="user.php" class="nav-link active">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users Management
              </p>
            </a>
          </li>
          </li>
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#logoutModal">
              <i class="nav-icon ion ion-power" style="font-size:20px;"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          </li>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
       <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark printPageButton">User Registration</h1>
          </div><!-- /.col -->
           <!-- /.col -->
        </div>
        </div>
		
		<div class="container-fluid"> 
			<a href="#" class="btn-success btn-sm btn"  style="text-transform:capitalize;color:white;text-stroke:2px solid black;" data-toggle="modal" data-target="#addProduct"> 
			<i class="fas fa fa-wrench fa-sm text-white-100" style="font-size:15px;" title="Mail"></i> Add New Doctor
			</a> 
   <div class="card shadow mb-4"  style="margin-top:10px;">
			<div class='card-header py-3 bg-success'>
              <h6 class="m-0 font-weight-bold" style="color:black;" >Doctor List
              <b  style="color:black;float:right;"><?php echo date('M d,Y h:i:s a', time());?></b></h6>
            </div>
			
            <div class="card-body" >
              <div class="table-responsive" > 
					<table width="100%" class="display" cellspacing="0">
              
                  <thead>
				 
                    <tr class="btn-success"  >
                      <th>Doctors Name</th>
                      <th>Doctors User</th>
                      <th class="printPageButton">Action</th>
                    </tr>
                  </thead>
                 <tbody>		
	   <?php				
					$q_e = $conn->query("SELECT * FROM `admin` ") or die(mysqli_error());
					while($f_e=$q_e->fetch_array()){
										
						
	   ?>
					<tr>
						<td style="text-size:8px;"><?php echo $f_e['username'];?></td>	
						<td style="text-size:8px;"><?php echo $f_e['lname'].','.$f_e['fname'].' '.$f_e['mname'];?></td>			
						<td style="text-size:8px;" class="printPageButton">
						 
						<a href="user.php?product_id=<?php echo $f_e['admin_id'];?>&action=delete" class="btn-danger btn-sm btn"  style="text-transform:capitalize;color:white;text-stroke:2px solid black;" onclick="return confirm('Are You Sure You Want To Delete This?')"> 
							Delete
						</a> 
						</td>		
							
					</tr>
						<?php
						}	
						if(isset($_GET['action'])){
								$product_id=$_GET['product_id'];
								$result=$conn->query("DELETE FROM admin WHERE admin_id='$product_id'");
								if($result){
						date_default_timezone_set('Asia/Manila'); 
						$date23 = date('m/d/Y h:i:s a', time());	
								echo '	
									<script>
									  function myFunction() {
										swal({
										title: "Success!",
										text: "Successful Deleted",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "user.php";
									  });}
									</script>
									';
									
								}else{
									echo '	
									<script>
									function myFunction() {
									swal({
									title: "Failed!",
									text: "Please Try Again",
									icon: "error",
									button: "Ok",
									});}
									</script>
								';
								}
								}
				?>			
                    </tbody>
                </table>
              </div>
            </div>
			</div>
						
            
      </div>
    </div>
      
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer printPageButton">
    <strong>Copyright &copy; Patient Management System 2021 - <?php echo date('Y');?></strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>  
 <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        
        <div class="modal-body">
		 <form class="user"  method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype = "multipart/form-data" autocomplete="off">
                <div class="form-group row">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" class="form-control"   style=" text-transform:capitalize;"required = "required"placeholder="Last Name" name = "lname" >
                  </div>
                  <div class="col-sm-4 mb-3 ">
                    <input type="text" class="form-control"	style=" text-transform:capitalize;"required = "required"placeholder="First Name" name = "fname">
                  </div>
				  <div class="col-sm-4 ">
                    <input type="text" class="form-control"	style=" text-transform:capitalize;"placeholder="Middle Name" name = "mname" >
                  </div>
                </div>
				<div class="form-group row">
					<div class="col-sm-12">
						<input type="text" class="form-control "required = "required" name="username2" id="username2" placeholder="User Name" >
						<div id="status"></div>
					</div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control"  required = "required" placeholder="Password" name = "password2" id="password2" onkeyup='check();' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
						<div id="err" ></div>
						<div id="err2"></div>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control" required = "required" name = "confirm_password" id="confirm_password" placeholder="Repeat Password" onkeyup='check();' >
                  </div>
                </div>
                <button  class = "btn btn-primary btn-user btn-block" name="register"  id="register" ><span class = "glyphicon glyphicon-save"></span> Save</button>			
                <hr>
              </form>
      </div>
      </div>
    </div>
  </div> 
  <?php

// Include config file
require_once "../connect.php";

// Define variables and initialize with empty values
$username = $email =$fname=$mname=$lname = $password = $confirm_password = "";
$username_err = $email_err =$fname_err =$mname_err =$lname_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if(isset($_POST['register'])){
  $fname = $_POST['fname'];
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  $client = "Admin";
  $username2 = $_POST["username2"];
    // Validate username
    
    // Check input errors before inserting in database
        
    if($client=='Admin'){		
    if(empty(trim($_POST["username2"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT admin_id FROM admin WHERE username = ?";
        
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
					echo '<script>
									function myFunction() {
									swal({
									title: "Failed!",
									text: "This username is already taken.",
									icon: "error",
									button: "Ok",
									});}
									</script>';
                } else{
                    $username = trim($_POST["username2"]);
                }
            } else{
				echo '<script>
									function myFunction() {
									swal({
									title: "Failed!",
									text: "Oops! Something went wrong. Please try again later.",
									icon: "error",
									button: "Ok",
									});}
									</script>';
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    } // Validate password
    if(empty(trim($_POST["password2"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password2"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password2"]);
    }
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
			echo '<script>
									function myFunction() {
									swal({
									title: "Failed!",
									text: "Password did not match.",
									icon: "error",
									button: "Ok",
									});}
									</script>';
        }
    }
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $sql = "INSERT INTO admin (username,password,fname,mname,lname) VALUES (?,?,'$fname','$mname','$lname')";
        $date23 = date('m/d/Y h:i:s a', time());	
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
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
										window.location = "user.php";
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
		}
        // Close statement
		}else{
	
	$sql1="SELECT count(*) AS total1 FROM user_account WHERE `username`='$username2'";
	$result1=mysqli_query($conn,$sql1);
	$data1=mysqli_fetch_assoc($result1);
	if($data1['total1']>=1){
				
					echo '<script>
									function myFunction() {
										swal({
					title: "Failed!",
					text: "This username is already taken.",
					icon: "error",
					button: "Ok",
										}).then(function() {
										window.location = "user.php";
									  });}
									
									</script>';
	}else{
		
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
					echo '<script>
									function myFunction() {
									swal({
									title: "Failed!",
									text: "This username is already taken.",
									icon: "error",
									button: "Ok",
									});}
									</script>';
                } else{
                    $username = trim($_POST["username2"]);
                }
            } else{
				echo '<script>
									function myFunction() {
									swal({
									title: "Failed!",
									text: "Oops! Something went wrong. Please try again later.",
									icon: "error",
									button: "Ok",
									});}
									</script>';
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    } // Validate password
    if(empty(trim($_POST["password2"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password2"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password2"]);
    }
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){   
	$sql = "INSERT INTO user_account (username,password,fname,mname,lname) VALUES (?,?,'$fname','$mname','$lname')";
    $date23 = date('m/d/Y h:i:s a', time());	
    if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
               echo '<script>
									function myFunction() {
										swal({
										title: "Success!",
										text: "Your Employee Successfully Recorded",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "user.php";
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
         
        mysqli_stmt_close($stmt);
		}
		}
		}
    mysqli_close($conn);
}
?>
           
  <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Your Profile</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">	
					<?php
								$q_e2 = $conn->query("SELECT * FROM `admin` WHERE `admin_id` = '$u_id'") or die(mysqli_error());
								while($f_e2=$q_e2->fetch_array()){	
					?>	
      
               <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype = "multipart/form-data"autocomplete="off" >
							<div class  = "modal-body">
								<div class = "form-group" >
									<label>First Name</label>
										<input type="text" value="<?php echo $f_e2['fname'];?>" name="fname" class = "form-control" style="text-transform:capitalize;">
										<input type="hidden" value="<?php echo $u_id?>" name="id" class = "form-control" style="text-transform:capitalize;">
									</div>
								<div class = "form-group" >
									<label>Middle Name</label>
									<input type="text" value="<?php echo $f_e2['mname'];?>" name="mname" class = "form-control" style="text-transform:capitalize;">
								</div>
								<div class = "form-group" >
									<label>Last Name</label>
									<input type="text" value="<?php echo $f_e2['lname'];?>" name="lname" class = "form-control" style="text-transform:capitalize;">
								</div>
								<div class = "form-group" >
									<label>Username</label>
									<input type="text" value="<?php echo $f_e2['username'];?>" name="username" class = "form-control" >
								</div>	
								<div class = "form-group" >
									<label>Password</label>
									<input type="password" name="password2" id="password2" class = "form-control" onkeyup='check();'  >
									<input type="hidden" value="<?php echo $f_e2['password'];?>" name="password1" class = "form-control" >
									<div id="err"></div><div id="err2"></div>
								</div>	
								<div class = "form-group" >
									<label>Re-Type Password</label>
									<input type="password" name = "confirm_password" id="confirm_password"class = "form-control" onkeyup='check();'>
								</div>
								
							</div>
						<?php 
						}
						if(isset($_POST['update'])){
						$id 		= $_POST['id'];
						$fname 		= $_POST['fname'];
						$mname		= $_POST['mname'];
						$lname		= $_POST['lname'];	
						$username	= $_POST['username'];
						$password	= $_POST['password2'];
						if($password!=null){
							$password_try = $_POST['password2'];
							$password1 = password_hash($password_try, PASSWORD_DEFAULT);
						}else{
							$password1 = $_POST['password1'];
						}
						$update = $conn->query("UPDATE `admin` SET `username` = '$username', `fname` = '$fname',`mname` = '$mname',`lname`='$lname',`password`='$password1'WHERE `admin_id` = '$id'");	
						
						if ($update) { 
									echo '<script>
									function myFunction() {
										swal({
										title: "Success! ",
										text: "Your Profile Successfully Update",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "user.php";
									  });}
									
								  </script>';			
						}else{
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
								?>
		</div>
        <div class="modal-footer">
          <button  class = "btn btn-primary" name = "update" style="float:right;"><span class = "fas fa-save"></span> Update Service </button>
								<button  class = "btn btn-danger" name = "add1" style="float:right;" data-dismiss = "modal" aria-label = "Close">
								<span class = "fas fa-times"></span> Close</button>
        </div></form>	
      </div>
    </div>
  </div>
  
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for calendar -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/fullcalendar/main.min.js"></script>
<script src="../plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="../plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="../plugins/fullcalendar-interaction/main.min.js"></script>
<script src="../plugins/fullcalendar-bootstrap/main.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script><script>

var check = function() {
  if (document.getElementById('password2').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('password2').style.border = 'green 2px solid';
    document.getElementById('confirm_password').style.border = 'green 2px solid';
    document.getElementById('err2').innerHTML = '<br><span style="color:green;" class="glyphicon glyphicon-ok-sign"> </span> Password confirm';
  } else {
    document.getElementById('password2').style.border = 'red 2px solid';
    document.getElementById('confirm_password').style.border = 'red 2px solid';
    document.getElementById('err2').innerHTML = '<br><span style="color:red;" class="glyphicon glyphicon-remove-sign"> </span> Password and confirm password is not match';
  }
}
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendarInteraction.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        console.log(eventEl);
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };
      }
    });

    var calendar = new Calendar(calendarEl, {
      plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
      header    : {
        left  : 'prev,next',
        center: 'title',
        right : ' today'
      },
      //Random default events
      events    : [
        {
          title          : 'All Day Event',
          backgroundColor: '#f56954', //red
          borderColor    : '#f56954' //red
        },
        {
          title          : 'Long Event',
          backgroundColor: '#f39c12', //yellow
          borderColor    : '#f39c12' //yellow
        },
        {
          title          : 'Meeting',
          allDay         : false,
          backgroundColor: '#0073b7', //Blue
          borderColor    : '#0073b7' //Blue
        },
        {
          title          : 'Lunch',
          allDay         : false,
          backgroundColor: '#00c0ef', //Info (aqua)
          borderColor    : '#00c0ef' //Info (aqua)
        },
        {
          title          : 'Birthday Party',
          allDay         : false,
          backgroundColor: '#00a65a', //Success (green)
          borderColor    : '#00a65a' //Success (green)
        },
        {
          title          : 'Click for Google',
          url            : 'http://google.com/',
          backgroundColor: '#3c8dbc', //Primary (light-blue)
          borderColor    : '#3c8dbc' //Primary (light-blue)
        }
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      }    
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      ini_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
  $(document).ready(function() {
    var interval = setInterval(function() {
        var momentNow = moment();
        $('#date-part').html(momentNow.format('YYYY MMMM DD') + ' '
                            + momentNow.format('dddd')
                             .substring(0,3).toUpperCase());
        $('#time-part').html(momentNow.format('hh:mm:ss A'));
    }, 100);
    
    $('#stop-interval').on('click', function() {
        clearInterval(interval);
    });
});

  function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=1000,height=500');
       popupWin.document.open();
       popupWin.document.write('<html><title>Library Management System</title><style>table{border:1px solid black;}th{border:1px solid black;font-size:11px;}td{border:1px solid black;font-size:12px;}li{display:none}a{display:none}input{display:none}select{display:none;}button{display:none;}</style><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
     function PrintDiv1() {    
       var divToPrint = document.getElementById('divToPrint1');
       var popupWin = window.open('', '_blank', 'width=1000,height=500');
       popupWin.document.open();
       popupWin.document.write('<html><title>Library Management System</title><style>table{border:1px solid black;}th{border:1px solid black;font-size:11px;}td{border:1px solid black;font-size:12px;}li{display:none}a{display:none}input{display:none}select{display:none;}button{display:none;}</style><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }           
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });
     
  $(document).ready(function() {
    $('table.display').DataTable({
        "order": [[ 0, "asc" ]]
    });
} );        
</script>
</body>
</html>