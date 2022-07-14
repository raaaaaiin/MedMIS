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
        <title>MediGrab</title>
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
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body onload="myFunction()">
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
			<a href="#" style="float:right;margin-right:20px;text-decoration:none;margin-top:10px;">E-Coins: 
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
        <!-- Header-->
        <!-- Section-->
        <section class="py-5">
            <div class="container px-12 px-lg-12 mt-12">
                <div class="row gx-12 gx-lg-12 row-cols-1 row-cols-md-12 row-cols-xl-12">
            
				 <div class="card h-100">
				        <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype = "multipart/form-data"autocomplete="off" >
        <div class="modal-body">
            	   <label>Amount Withdraw<b style="color:red;"></b></label>
		         <input type="text" name="declare" class="form-control" required>
            	   <label>G-Cash Number: <b style="color:red;"></b></label>
		         <input type="text" name="gcash" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="submit" name="send_proof">Send Request</button>
        </div>
        </form>  
	   <?php
            if(isset($_POST['send_proof'])){
	        $gcash = $_POST['gcash'];
	        $declare = $_POST['declare'];
			$date = date('F d,Y - h:i:s A',time());
			$sql123 ="INSERT INTO request_ecoin VALUES(null,'$u_id','$gcash','$declare','For Verify','$date')";
			if (mysqli_query($conn,$sql123)) { 
									echo '<script>
									function myFunction() {
										swal({
										title: "Success! ",
										text: "Successfully Send a Request",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "withdraw.php";
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
				</div>
            <div class="card-body" >
				<div class="table-responsive" > 
					<table width="100%" class="display" cellspacing="0">
                  <thead>
                    <tr class="btn-info"  >
                      <th>Request Withdraw</th>
                      <th>Gcash Number</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                 <tbody>		
	             <?php		
	                error_reporting(0);
	                ini_set('display_errors', 0);
					$q_e = $conn->query("SELECT * FROM `request_ecoin` WHERE `request_ecoin_user`='$u_id'") or die(mysqli_error());
					while($f_e=$q_e->fetch_array()){
	            ?>
				<tr>
					<td style="text-size:8px;text-transform:capitalize;"><?php echo $f_e['request_ecoin_value'];?></td>
					<td style="text-size:8px;text-transform:capitalize;"><?php echo $f_e['request_ecoin_gnum'];?></td>
					<td style="text-size:8px;text-transform:capitalize;"><?php echo $f_e['request_ecoin_status']?></td>	
						
				</tr>
		<?php
			}	
			
				?>			
                    </tbody>
                </table>
              </div>
              </div>
        </section>
        <!-- Footer-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  
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
        <script>
        
  $(document).ready(function() {
    $('table.display').DataTable({
        "order": [[ 0, "asc" ]]
    });
} );       
 
        </script>
    </body>
</html>
