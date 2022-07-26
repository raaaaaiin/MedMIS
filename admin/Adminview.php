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
  <title>MediGrab</title>
  <!-- Tell the browser to be responsive to screen width -->
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
i,p{
	color:white;
}
</style>
<style>
                                        .cyan {
    border-top: 3px solid #14cdc8;
}
                                        table, tr td {
}
tbody ,ul{
    max-height:500px;
    display: block;
    height: auto;
    overflow: auto;
}
thead, tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed;
}
thead {
    width: calc( 100% - 1em )/* scrollbar is average 1em/16px width, remove it from thead width */
}
table {
    width: 400px;
}
                                        </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed" onload="myFunction()">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars bg-danger"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home.php" class="nav-link">Home</a>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-light elevation-4 bg-info"  >
    <a href="#" class="brand-link">
      
      <span class="brand-text font-weight-dark" style="color:white;"><center><img src="../img/medilogo.png" style="width:150px;" autofill="off"></center></span>
	  
    </a>
    <div class="sidebar" >
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        </div>
        <div class="info">
          <a href="#" class="d-block" data-toggle="modal" data-target="#editProfile" style="text-transform:capitalize;color:white;text-stroke:2px solid black;">
		  <?php  
							
								$u_id=$_GET['id'];
                                
                                                        $userid = $u_id;
                                                        $name = $conn->query("SELECT Concat(`lname`) as name FROM `user_account` WHERE `u_id` = '$userid'")  ;
							                            $res = $name->fetch_array();
                                                        echo 'Admin: '.$res['name'] 
                                                        
                                                        
                                                        
                                                       
						?>
		 </a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="home.php" class="nav-link " >
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Admin Dashboard
              </p>
            </a>
          </li>
		  <li class="nav-item has-treeview">
            <a href="adminview.php?id=<?php echo $u_id ?>" class="nav-link " >
              <i class="nav-icon fas fa-hospital"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="monitoring.php?id=<?php echo $u_id ?>" class="nav-link ">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
               Product
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="order.php?id=<?php echo $u_id ?>" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
              Order 
              </p>
            </a>
          </li>
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#logoutModal">
              <i class="nav-icon ion ion-power" style="font-size:20px;"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          </ul>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <div class="main-section d-flex justify-content-center"><div class="container" style="  max-width: 1400px;">

                


            


             
    

                        <br>



































                        
                        
                        

                       
                        
                        



                        <div class="row">
                             <?php  
							$username = htmlspecialchars($_SESSION["username"]);
							$q = $conn->query("SELECT COUNT(*) as total_order FROM `cart_order` WHERE `cart_pharmacy_id` = '$u_id'") or die(msqli_error());
							$pharma = $q->fetch_array();
							
								$totalcount=$pharma['total_order'];
                             $q = $conn->query("SELECT COUNT(*) as active_prod FROM `product` WHERE `product_user` = '$u_id' AND product_updated_date = 'Active'") or die(msqli_error());
                             $pharma = $q->fetch_array();
                             $activeProd=$pharma['active_prod'];
                             $q = $conn->query("SELECT COUNT(*) as active_prod FROM `product` WHERE `product_user` = '$u_id' AND product_updated_date != 'Active'") or die(msqli_error());
                             $pharma = $q->fetch_array();
                             $deactiveProd=$pharma['active_prod'];
                             $q = $conn->query("SELECT cashin_total as balance FROM `cashin` WHERE `cashin_user_id` = '$u_id'") or die(msqli_error());
                             $pharma = $q->fetch_array();
                             $balance=$pharma['balance'];
						    ?>  
                            <div class="col-lg-3 col-6">
                                <div class="card" style="height:150px;max-height:150px!important;min-height:150px!important">
                                    <div class="card-body cyan cy" style="height:150px;max-height:150px!important;min-height:150px!important">
                                        <h5 class="text-muted">Total Order</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1"><?php echo $totalcount ?></h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span><!-- <i class="fa fa-fw fa-arrow-up"></i> Font Awesome fontawesome.com --></span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue"></div>
                                </div>
                            </div>


                            <div class="col-lg-3 col-6" style="height:150px;max-height:150px!important;min-height:150px!important">
                                <div class="card" style="height:150px;max-height:150px!important;min-height:150px!important">
                                    <div class="card-body cyan">
                                        <h5 class="text-muted">Active Medicine</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1"><?php echo $activeProd ?></h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span><!-- <i class="fa fa-fw fa-arrow-up"></i> Font Awesome fontawesome.com --></span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue2"></div>
                                </div>
                            </div>


                            <div class="col-lg-3 col-6" style="height:150px;max-height:150px!important;min-height:150px!important">
                                <div class="card" style="height:150px;max-height:150px!important;min-height:150px!important">
                                    <div class="card-body cyan">
                                        <h5 class="text-muted">Disabled Medicine</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1"><?php echo $deactiveProd ?></h1>
                                        </div>
                                        
                                    </div>
                                    <div id="sparkline-revenue3"></div>
                                </div>
                            </div>


                            <div class="col-lg-3 col-6" style="height:150px;max-height:150px!important;min-height:150px!important">
                                <div class="card" style="height:150px;max-height:150px!important;min-height:150px!important">
                                    <div class="card-body cyan">
                                        <h5 class="text-muted">Balance</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1"><?php echo $balance ?> PHP</h1>
                                        </div>
                                        
                                    </div>
                                    <div id="sparkline-revenue4"></div>
                                </div>
                            </div>
                        <div class="col-lg-12">
                                <div class="card">
                                    <h5 class="card-header">Complete transaction</h5>
                                    <div class="card-body cyan p-0">
                                        <div class="table-responsive">
                                        
                                            <table class="table">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0">No</th>
                                                        <th class="border-0">Cart ID</th>
                                                        <th class="border-0">Customer Name</th>
                                                        <th class="border-0">Address</th>
                                                        <th class="border-0">Rider Name</th>
                                                        <th class="border-0">Delivery type</th>
                                                        <th class="border-0">Payment Type</th>
                                                        <th class="border-0">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="max-height: 500px;
  overflow-y: scroll;";>
                                                     <tr>


                                                     <?php
                                                     $transact = $conn->query("SELECT * FROM `cart_order` WHERE `cart_pharmacy_id` = '$u_id' and cart_order_status = 'Done' order by cart_order_id desc") or die(msqli_error());
                                                     $completetransact = mysqli_fetch_all ($transact, MYSQLI_ASSOC);
                                                     $i = 0;
                                                     foreach ($completetransact as $key) {
                                                     $i++;
                                                     ?>

                                                     </tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><a href="order-view.php?cart_order=<?php echo $key['cart_order_add'] ?>"><?php echo $key['cart_order_add'] ?></a></td> 
                                                        <td><?php 
                                                        $userid = $key['cart_order_uid'];
                                                        $name = $conn->query("SELECT Concat(`lname`,' ',`fname`,' ',`mname`) as name FROM `user_account` WHERE `u_id` = '$userid'")  ;
							                            $res = $name->fetch_array();
                                                        echo $res['name'] 
                                                        
                                                        
                                                        
                                                        ?></td> 
                                                        <td><?php echo $key['cart_order_name'] ?></td>
                                                        
                                                        <td><?php 
                                                        $userid = $key['cart_order_driver'];
                                                        $name = $conn->query("SELECT Concat(`lname`,' ',`fname`,' ',`mname`) as name FROM `user_account` WHERE `u_id` = '$userid'")  ;
							                            $res = $name->fetch_array();
                                                        echo $res['name'] 
                                                        
                                                        
                                                        
                                                        ?></td>
                                                        <td><?php echo $key['cart_order_delivery'] ?></td> 
                                                        <td><?php echo $key['cart_order_payment'] ?></td>
                                                        <td><?php echo $key['cart_order_date'] ?></td> 
                                                     <tr>

                                                     <?php
                                                       }

                                                     ?>



                                                       
                                                        
                                                    
                                                                                                       
                                                       
                                                                                                           
                                                    
                                                    
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- ============================================================== -->
                                <!-- social source  -->
                                <!-- ============================================================== -->
                                                                <div class="card">
                                    <h5 class="card-header">Pending</h5>
                                    <div class="card-body cyan p-0">
                                        <ul class="social-sales list-group list-group-flush" style="
    min-height:200px;">

                                        <?php
                                                     $transact = $conn->query("SELECT * FROM `cart_order` WHERE `cart_pharmacy_id` = '$u_id' and cart_order_status = 'Pending' order by cart_order_id desc") or die(msqli_error());
                                                     $completetransact = mysqli_fetch_all ($transact, MYSQLI_ASSOC);
                                                     $i = 0;
                                                     foreach ($completetransact as $key) {
                                                     $i++;
                                                     ?>

                                                     <li class="list-group-item social-sales-content"><span class="social-sales-name"><a href="order-view.php?cart_order=<?php echo $key['cart_order_add'] ?>"><?php echo $key['cart_order_add'] ?></a></span><span style="color: #c6c6c6;" class="float-right text-dark"><?php echo $key['cart_order_name'] . ' ' .$key['cart_order_date'] ?></span>
                                            </li>

                                                     <?php
                                                       }

                                                     ?>


                                            
                                                                                                        
                                            
                                        </ul>
                                    </div>
                                    <div class="card-footer text-center">
                                    </div>
                                </div>
                                <!-- ============================================================== -->
                                <!-- end social source  -->
                                <!-- ============================================================== -->
                            </div>
                            <div class="col-lg-4">
                                                            <!-- ============================================================== -->
                                <!-- sales traffice source  -->
                                <!-- ============================================================== -->
                                <div class="card">
                                    <h5 class="card-header">Confirm</h5>
                                    <div class="card-body cyan p-0">
                                    <ul class="country-sales list-group list-group-flush" style="
    min-height:200px;">
                                                                                 <?php
                                                     $transact = $conn->query("SELECT * FROM `cart_order` WHERE `cart_pharmacy_id` = '$u_id' and cart_order_status = 'Confirm' order by cart_order_id desc") or die(msqli_error());
                                                     $completetransact = mysqli_fetch_all ($transact, MYSQLI_ASSOC);
                                                     $i = 0;
                                                     foreach ($completetransact as $key) {
                                                     $i++;
                                                     ?>

                                                     <li class="list-group-item social-sales-content"><span class="social-sales-name"><a href="order-view.php?cart_order=<?php echo $key['cart_order_add'] ?>"><?php echo $key['cart_order_add'] ?></a></span><span style="color: #c6c6c6;" class="float-right text-dark"><?php echo $key['cart_order_name']. ' ' .$key['cart_order_date'] ?></span>
                                            </li>

                                                     <?php
                                                       }

                                                     ?>
                                                                                   
                                           
                                        </ul>
                                        <div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end sales traffice source  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- sales traffic country source  -->
                            <!-- ============================================================== -->
                            <div class="col-lg-4">
                                                            <div class="card">
                                    <h5 class="card-header">Ready to Dispatch</h5>
                                    <div class="card-body cyan p-0">
                                        <ul class="country-sales list-group list-group-flush" style="
    min-height:200px;">
                                                                                   <?php
                                                     $transact = $conn->query("SELECT * FROM `cart_order` WHERE `cart_pharmacy_id` = '$u_id' and cart_order_status = 'ReadyDispatch' order by cart_order_id desc") or die(msqli_error());
                                                     $completetransact = mysqli_fetch_all ($transact, MYSQLI_ASSOC);
                                                     $i = 0;
                                                     foreach ($completetransact as $key) {
                                                     $i++;
                                                     ?>

                                                     <li class="list-group-item social-sales-content"><span class="social-sales-name"><a href="order-view.php?cart_order=<?php echo $key['cart_order_add'] ?>"><?php echo $key['cart_order_add'] ?></a></span><span style="color: #c6c6c6;" class="float-right text-dark"><?php echo $key['cart_order_name'] . ' ' .$key['cart_order_date'] ?></span>
                                            </li>

                                                     <?php
                                                       }

                                                     ?>
                                                           
                                                                                   
                                           
                                        </ul>
                                    </div>
                                    <div class="card-footer text-center">
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end sales traffice country source  -->
                            <!-- ============================================================== -->
                        </div>
</div> 
</div>
  </div>
  <!-- /.content-wrapper -->

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
								$q_e2 = $conn->query("SELECT * FROM `user_account` WHERE `u_id` = '$u_id'") or die(mysqli_error());
								while($f_e2=$q_e2->fetch_array()){	
					?>	
      
               <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype = "multipart/form-data"autocomplete="off" >
							<div class  = "modal-body">
								<div class = "form-group" >
									<label>Company Name</label>
									<input type="text" value="<?php echo $f_e2['lname'];?>" name="lname" class = "form-control" style="text-transform:capitalize;">
								</div>
								<div class = "form-group" >
									<label>Barangay</label>
										<input type="text" value="<?php echo $f_e2['fname'];?>" name="fname" class = "form-control" style="text-transform:capitalize;">
										<input type="hidden" value="<?php echo $u_id?>" name="id" class = "form-control" style="text-transform:capitalize;">
								</div>
								<div class = "form-group" >
									<label>Username</label>
									<input type="text" value="<?php echo $f_e2['username'];?>" name="username" class = "form-control" >
								</div>	
								<div class = "form-group" >
									<label>Email</label>
									<input type="email" value="<?php echo $f_e2['email'];?>" name="email" class = "form-control" >
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
						$lname		= $_POST['lname'];	
						$email	    = $_POST['email'];
						$username	= $_POST['username'];
						$password	= $_POST['password2'];
						if($password!=null){
							$password_try = $_POST['password2'];
							$password1 = password_hash($password_try, PASSWORD_DEFAULT);
						}else{
							$password1 = $_POST['password1'];
						}
						$update = $conn->query("UPDATE `user_account` SET `username` = '$username', `fname` = '$fname',`lname`='$lname',`email`='$email',`password`='$password1'WHERE `u_id` = '$id'");	
						
						if ($update) { 
									echo '<script>
									function myFunction() {
										swal({
										title: "Success! ",
										text: "Your Profile Successfully Update",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "home.php";
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
        <button  class = "btn btn-primary btn-user" type="button" onclick="window.location.href='location.php'"  id="" style="float:right;margin-right: 5px;">
					<span class = "glyphicon glyphicon-save">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
  <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
  <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg></span> Set Address
					</button>
          <button  class = "btn btn-primary" name = "update" style="float:right;"><span class = "fas fa-save"></span> Update Profile </button>

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
</script>
<script>
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
</script>
</body>
</html>