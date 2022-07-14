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
		if($status=='Inactive'){
			?><script>
									  function myFunction() {
										swal({
									title: "Sorry Your Account is Inactive",
									text: "Contact the Admin to change the status to active",
									    icon: "error",
										type: "error"
										}).then(function() {
										window.location = "logout.php";
									  });}
									</script>
			<?php
		}else{
		if($position=="Pharmacy"){
			
		?>
		<script>
				setTimeout(function(){
				window.location.reload(1);
				window.location.href='../student/home.php';
				}, 2000);
		</script>
		<?php
		
		}elseif($position=="Pharmacy"){
			
		
		?>
		<script>
				setTimeout(function(){
				window.location.reload(1);
				window.location.href='../student/home.php';
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