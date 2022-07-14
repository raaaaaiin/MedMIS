<?php
		session_start();
 require_once "../connect.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}	
	date_default_timezone_set('Asia/Manila');
		$time =  date("h:i:m A", time());
		$date =  date("F d,Y h:i:m A", time());
							$username = htmlspecialchars($_SESSION["username"]);
							$q = $conn->query("SELECT * FROM `user_account` WHERE `username` = '$username'") or die(msqli_error());
							$f = $q->fetch_array();
							$position = $f['position'];
							$status = $f['status'];
							$u_id = $f['u_id'];
	?>
<html>
	<head>
		<title>Redirecting</title>
  <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  							
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<style>
		@media only screen and (min-width: 200px) {
			.image{
				margin-top:10%;width:300px;
			}
		}
		</style>
	</head>
	<body  onload="myFunction()">
		<center>
		
		<image src="../img/process.gif" class="image">
		<?php
		
		if($status=='Pending' || $status=="Block"){
			?>
			<h3>
			<?php
			if($status=="Block"){
		       echo "Sorry Your Account is For Block";
		    }else{
		        echo "Sorry Your Account is For Pending";
	    	}
			?>
			</h3>
			</h4>
			<?php
			if($status=="Block"){
		        echo "Contact the Admin to change the status to reactive";
		        ?>
		    
			<form class="user"  method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype = "multipart/form-data" autocomplete="off">
               
			   
			    <div class="col-sm-4 mb-3 mb-sm-0">
                    <br>
                    <a  href="logout.php" class = "btn btn-danger">Logout </a>
                  </div>
			    </form>
		    <?php
		    }else{
		        echo "We Sent A Verification Code to Your Email";
		    ?>
			<form class="user"  method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype = "multipart/form-data" autocomplete="off">
               
			    <label>Unicode</label>
			    <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" class="form-control"   style=" text-transform:capitalize;" name = "code" ><br>
                    <button  class = "btn btn-primary" name = "update" type="submit"> Verify Code </button>
                    <a  href="logout.php" class = "btn btn-danger">Cancel </a>
                  </div>
			    </form>
		    <?php
	    	}
			?></h4> 
			    
			<?php
			if(isset($_POST['update'])){
			    $code = $_POST['code'];
			    $update1 = $conn->query("UPDATE `user_account` SET `status` = 'Approve' WHERE `ref` = '$code'");	
				if ($update1) { 
									echo '<script>
									function myFunction() {
										swal({
										title: "Successfully Updated! ",
										text: "Please Login Again to Confirm your Account",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "logout.php";
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
		}else{
		if($position=="Client"){
			
		?>
		<script>
				setTimeout(function(){
				window.location.reload(1);
				window.location.href='home.php';
				}, 2000);
		</script>
		<?php
		
		}elseif($position=="Driver"){
			
		
		?>
		<script>
				setTimeout(function(){
				window.location.reload(1);
				window.location.href='../driver/home.php';
				}, 2000);
		</script>
		<?php
		}else{
			?>
		<script>
				setTimeout(function(){
				window.location.reload(1);
				window.location.href='logout.php';
				}, 2000);
		</script>
		<?php
		} 
		}
		?>
		</center>
	</body>
</html>