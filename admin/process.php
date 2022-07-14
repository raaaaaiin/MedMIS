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
		$date =  date("F d,Y", time());
							$username = htmlspecialchars($_SESSION["username"]);
							$q = $conn->query("SELECT * FROM `user_account` WHERE `username` = '$username'") or die(msqli_error());
							$f = $q->fetch_array();
							$position = $f['position'];
	?>
<html>
	<head>
		<title>Redirecting</title>
		<style>
		@media only screen and (min-width: 200px) {
			.image{
				margin-top:10%;width:300px;
			}
		}
		</style>
	</head>
	<body >
		<center>
		
		<image src="../img/process.gif" class="image">
		    <?php if($position=="Admin"){?>
		<script>
				setTimeout(function(){
				window.location.reload(1);
				window.location.href='home.php';
				}, 2000);
		</script>
		<?php }else{
		?>
		<script>
				setTimeout(function(){
				window.location.reload(1);
				window.location.href='logout.php';
				}, 2000);
		</script>
		<?php
		} ?>
		</center>
	</body>
</html>