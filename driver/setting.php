<?php
session_start();
 require_once "connect.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MediGrab</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body onload="myFunction()" >
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!"><img src="../img/medilogo.png" style="width:150px;" autofill="off"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="home.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="history.php">History</a></li>
						<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-transform:capitalize;"><?php  
							$username = htmlspecialchars($_SESSION["username"]);
							$q = $conn->query("SELECT * FROM `user_account` WHERE `username` = '$username'") or die(msqli_error());
							$f = $q->fetch_array();
								$u_id=$f['u_id'];
								$name = "".$f['fname']." ".$f['mname']." ".$f['lname']."";
									echo $name;
						?></a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="setting.php">Settings</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <!-- Section-->
        <section class="py-5">	
			<a href="#" style="float:right;margin-right:20px;text-decoration:none;">E-Coins: 
			  <?php
			  $qc = $conn->query("SELECT * FROM `cashin` WHERE `cashin_user_id` = '$u_id'") or die(msqli_error());
			  $fc = $qc->fetch_array();
			  $total_cash = $fc['cashin_total'];
		       if($fc['cashin_total']==null){
		          echo "0"; 
		       }else{
		           echo  $fc['cashin_total'];
		       }
			  ?>  
			</a>  
            <div class="container px-4 px-lg-5 mt-5">
				 <form class="user"  method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype = "multipart/form-data" autocomplete="off">
                
                    <input type="text" class="form-control"   style=" text-transform:capitalize;"required = "required"placeholder="Last Name" name = "lname" value="<?php echo $f['lname']?>" > <br>
                 
                    <input type="text" class="form-control"	style=" text-transform:capitalize;"required = "required"placeholder="First Name" name = "fname"  value="<?php echo $f['fname']?>"><br>
                 
                    <input type="text" class="form-control"	style=" text-transform:capitalize;"placeholder="Middle Name" name = "mname"  value="<?php echo $f['mname']?>"><br>
               
					<input type="text" class="form-control"  required = "required" name="city" placeholder="City"  value="<?php echo $f['city']?>"><br>
				 
						<input type="text" class="form-control "required = "required" name="brgy"  placeholder="Barangay"  value="<?php echo $f['brgy']?>"><br>
			
					<input type="email" class="form-control"  required = "required"name="email" id="email2" placeholder="Email Address"  value="<?php echo $f['email']?>"><br>
					<div id="status2"></div>
						<input type="text" class="form-control "required = "required" name="username" id="username2" placeholder="User Name"  value="<?php echo $f['username']?>"><br>
						<div id="status"></div>
				 
                    <input type="password" class="form-control"  placeholder="Password" name = "password" id="password2" onkeyup='check();' ><br>
                  
                    <input type="password" class="form-control" name = "confirm_password" id="confirm_password" placeholder="Repeat Password" onkeyup='check();'>
					
					<div id="err2"></div><br>
                    <input type="password" class="form-control" required = "required" name = "old_password2" id="confirm_password" placeholder="Old Password" ><br>
                    <input type="hidden" class="form-control"	  name = "u_id" required value="<?php echo $f['u_id']?>">
                    <input type="hidden" class="form-control"	 name = "old_password1"  value="<?php echo $f['password']?>">
                  
                    <button  class = "btn btn-primary btn-user" name="check"  id="register" style="float:right;"><span class = "glyphicon glyphicon-save"></span> Update Profile</button>
				<hr>
              </form>
			  <?php
				if(isset($_POST['check'])){
					$u_id 		= $_POST['u_id'];
					$lname 		= $_POST['lname'];
					$mname 		= $_POST['mname'];
					$fname 		= $_POST['fname'];
					$email 		= $_POST['email'];
					$username 	= $_POST['username'];
					$city 		= $_POST['city'];
					$brgy 		= $_POST['brgy'];
					$old_password1 		= $_POST['old_password1'];
					$old_password2 		= $_POST['old_password2'];
					$password 	    	= $_POST['password'];
					$confirm_password 	= $_POST['confirm_password'];
					
					if(password_verify($old_password2, $old_password1)){
					if($password == $confirm_password){
						if($_POST['password']==""){
							$ps2 = $_POST['old_password2'];
						}else{
							$ps2 = $_POST['password'];
						}
				    $pass = password_hash($ps2, PASSWORD_DEFAULT);
					
				    $result=$conn->query("UPDATE user_account SET lname='$lname',`brgy`='$brgy',`city`='$city',`username`='$username',fname='$fname',mname='$mname',email='$email',password='$pass' WHERE u_id='$u_id' ");
					if($result){
					echo '<script>
									function myFunction() {
										swal({
										title: "Success!",
										text: "Successfully Updated Your Profile",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "setting.php";
									  });}
									</script>';
						}
					    
					}else{
					    echo '<script>
									function myFunction() {
									swal({
									title: "Failed!",
									text: "Oops! Sorry, please try again",
									icon: "error",
									button: "Ok",
									});}
									</script>';
					}
				}else{
				      echo '<script>
									function myFunction() {
									swal({
									title: "Failed!",
									text: "Oops! Wrong password. Please try again",
									icon: "error",
									button: "Ok",
									});}
									</script>';
				}
					
				}
					?>
            </div>
        </section>
        <!-- Footer-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
