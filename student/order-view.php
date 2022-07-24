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
  i,p{
	color:white;
}
  @media print {
	#printPageButton {
    display: none;
  }
  .printPageButton{
	   display: none;
  }
  #DataTables_Table_0_filter,#DataTables_Table_0_length,#DataTables_Table_0_paginate{
	  
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
							$username = htmlspecialchars($_SESSION["username"]);
							$q = $conn->query("SELECT * FROM `user_account` WHERE `username` = '$username'") or die(msqli_error());
							$f = $q->fetch_array();
								$u_id=$f['u_id'];
								$name = $f['lname'];
									echo $name;
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
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="monitoring.php" class="nav-link ">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
               Product
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="order.php" class="nav-link active">
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
    <div class="content-header">
       <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark printPageButton">Order Information</h1>
          </div><!-- /.col -->
           <!-- /.col -->
        </div>
        </div>
		
		<div class="container-fluid"> 
		
			<a href="#" class="btn-danger btn-m btn"  style="text-transform:capitalize;color:white;text-stroke:2px solid black;" data-toggle="modal" data-target="#addProduct"> 
				<i class="fas fa fa-list fa-m text-white-100" style="font-size:15px;" title="Mail"></i> Update Status			
			</a> 
			<a href="#" class="btn-danger btn-m btn"  style="text-transform:capitalize;color:white;text-stroke:2px solid black;" data-toggle="modal" data-target="#addProduct1"> 
				<i class="fas fa fa-list fa-m text-white-100" style="font-size:15px;" title="Mail"></i> View ID and Prescription			
			</a> 
	  <div class="printPageButton">  
			<!--<a href="#"   onclick="window.print()" class = "btn-info btn-m btn"  style="color:black;"> <i class="fas fa-print fa-m"></i> Print this page</a>-->
			
	   </div>
	   
					
            <div class="card shadow mb-4"  style="margin-top:10px;">
			<div class='card-header py-3 bg-info'>
              <h6 class="m-0 font-weight-bold" style="color:black;" >Order List
              <b  style="color:black;float:right;"></b></h6>
            </div>
			
	   
            <div class="card-body" >
              <div class="table-responsive" > 
					<table width="100%" class="display" cellspacing="0">
              
                  <thead>
				 
                    <tr class="btn-info"  >
                      <th>Reference No.</th>
                      <th>Name</th>
                      <th>Quantity</th>
                      <th>Status</th>
                      <th>Price</th>
                      <th>Total</th>
                      <th>Delivery Option </th>
                      <th>Payment Option </th>
                    </tr>
                  </thead>
                 <tbody>		
	   <?php			
	   
	  error_reporting(0);
	  ini_set('display_errors', 0);
	  $view_cart = $_GET['view_cart'];
	  $cart_order = $_GET['cart_order'];
       
					$q_e = $conn->query("SELECT * FROM `cart` WHERE `cart_ref`='$cart_order'") or die(mysqli_error());
					while($f_e=$q_e->fetch_array()){
						$product = $f_e['cart_product'];
						$cart_ref = $f_e['cart_ref'];
						$cart_qty = $f_e['cart_qty'];
						$cart_qty = $f_e['cart_qty'];
						$status = $f_e['status'];
						$q1 = $conn->query("SELECT * FROM `product` WHERE `product_id` = '$product'") or die(msqli_error());
						$f1 = $q1->fetch_array();
						$product_price = $f1['product_price'];
						
						$q2 = $conn->query("SELECT * FROM `cart_order` WHERE `cart_order_add` = '$cart_order'") or die(msqli_error());
						$f2 = $q2->fetch_array();
						$cart_order_pic      = $f2['cart_order_pic'];
						$cart_pre            = $f2['cart_pre'];
						$cart_order_delivery = $f2['cart_order_delivery'];
						$cart_order_payment  = $f2['cart_order_payment'];
						$cart_order_status  = $f2['cart_order_status'];
	   ?>
  <div class="modal fade" id="addProduct1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ID and Prescription</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <center>
                <?php if($cart_order_pic==null){
                }else{?>
                <h5>Client's ID</h5>
                <img src="../management/img/<?php echo $cart_order_pic?>" width="400px" height="250px">
                
                <?php } 
                if($cart_pre==null){
                }else{?>
                <h5>Prescription</h5>
                <img src="../management/img/<?php echo $cart_pre?>" width="400px" height="250px">
                <?php } ?>
            </center>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> 
					<tr>
						<td style="text-size:8px;text-transform:capitalize;"><?php echo $cart_ref;?></td>
						<td style="text-size:8px;text-transform:capitalize;"><?php echo $f1['product_name'];?></td>
						<td style="text-size:8px;text-transform:capitalize;"><?php echo $cart_qty;?></td>
						<td style="text-size:8px;text-transform:capitalize;"><?php if($cart_order_status=="ReadyDispatch"){ echo "Ready to Dispatch";}else{echo $status;};?></td>
						<td style="text-size:8px;text-transform:capitalize;"><?php echo $product_price;?></td>
						<td style="text-size:8px;text-transform:capitalize;"><?php echo $product_price * $cart_qty;?></td>
						<td style="text-size:8px;text-transform:capitalize;"><?php echo $cart_order_delivery; ?></td>
						<td style="text-size:8px;text-transform:capitalize;"><?php echo $cart_order_payment;  ?></td>
					</tr>
						<?php
						$total_amount +=$product_price * $cart_qty;
						}						
						if(isset($_GET['del_cart'])){
					$del_cart = $_GET['del_cart'];
					
					$result=$conn->query("UPDATE product SET product_updated_date='Deleted' WHERE product_id='$del_cart'");
					if($result){
					echo '<script>
									function myFunction() {
										swal({
										title: "Success!",
										text: "Successfully Remove Product",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "monitoring.php";
									  });}
									</script>';
				}
				}
								
				?>			
                    </tbody>
                </table>
              </div>
			  <h3 style="float:right;"><?php echo  "Total: ".$total_amount."";?> Php</h3>
            </div>
			</div>
						
            
      </div>
    </div>
      
    <!-- /.content -->
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
        <?php
			$q2 = $conn->query("SELECT * FROM `cart_order` WHERE `cart_order_add` = '$cart_order' ") or die(msqli_error());
			$f2 = $q2->fetch_array();
			$cart_order_uid    = $f2['cart_order_uid'];
            $cart_order_driver = $f2['cart_order_driver'];
			$cart_order_status = $f2['cart_order_status'];
			$cart_order_add    = $f2['cart_order_add'];
			$cart_order_delivery   = $f2['cart_order_delivery'];
			$cart_order_payment    = $f2['cart_order_payment'];
         ?>
  <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Orders</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
         <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype = "multipart/form-data"autocomplete="off" >
			<div class="modal-body">
				 <div class  = "modal-body">
				
				<div class = "form-group row" >
                  <div class="col-sm-12 mb-3 mb-sm-0">
						<label>Status</label>
						<select type="text" name="status" class = "form-control" required  style="text-transform:capitalize;">
							<option value="">Select Status</option>
							<option value="Pending">-Pending</option>
							<option value="Confirm">-Confirm</option>
							<option value="ReadyDispatch">-Ready to Dispatch</option>
							<option value="Delivering">-Delivering</option>
							<option value="Done">-Done Transaction</option>
						</select>
				</div>
                <div class="col-sm-12 mb-3 mb-sm-0">
						<label>Current Status:</label>
						<p style="color:black;"><?php if($cart_order_status=="ReadyDispatch"){ echo "Ready to Dispatch";}else{echo $cart_order_status;} ?>
				</div>
				</div>
				<?php 
				$q3 = $conn->query("SELECT * FROM `cashin` WHERE `cashin_user_id` = '$cart_order_uid'") or die(msqli_error());
				$f3 = $q3->fetch_array();
					
                $sql1="SELECT count(*) AS total1 FROM `cashin` WHERE  `cashin_user_id`='$cart_order_driver'";
				$result1=mysqli_query($conn,$sql1);
				$data1=mysqli_fetch_assoc($result1);
				$total1 = $data1['total1'];
				
				if($total1>=1){ 
					$q4 = $conn->query("SELECT * FROM `cashin` WHERE `cashin_user_id` = '$cart_order_driver'") or die(msqli_error());
					$f4 = $q4->fetch_array();
					$cashin_total = $f4['cashin_total'];
				}else{
				    $cashin_total = 0;
				}
				
				$q5 = $conn->query("SELECT * FROM `cashin` WHERE `cashin_user_id` = '$u_id'") or die(msqli_error());
				$f5 = $q5->fetch_array();
					
                $sql2="SELECT count(*) AS total2 FROM `cashin` WHERE  `cashin_user_id`='$u_id'";
				$result2=mysqli_query($conn,$sql2);
				$data2=mysqli_fetch_assoc($result2);
				$total2 = $data2['total2'];
				
				if($total2>=1){ 
					$q6 = $conn->query("SELECT * FROM `cashin` WHERE `cashin_user_id` = '$u_id'") or die(msqli_error());
					$f6 = $q6->fetch_array();
					$cashin_total1 = $f6['cashin_total'];
				}else{
				    $cashin_total1 = 0;
				}
				
				$qa = $conn->query("SELECT * FROM `cashin` WHERE `cashin_user_id` = '3'") or die(msqli_error());
				$fa = $qa->fetch_array();
				?>
				<input type="hidden" name="cart_order_id" value="<?php echo $f2['cart_order_id']?>">
				<input type="hidden" name="u_id" value="<?php echo $f2['cart_order_uid']?>">
				
                <input type="hidden" name="total_amount"      value="<?php echo $total_amount?>">
                <input type="hidden" name="cashin_total"      value="<?php echo $f3['cashin_total']; ?>">
                <input type="hidden" name="cashin_total_d"    value="<?php echo $cashin_total ?>">
                <input type="hidden" name="cashin_total_s"    value="<?php echo $cashin_total1 ?>">
                <input type="hidden" name="cart_order"        value="<?php echo $f2['cart_order_add']; ?>">
                <input type="hidden" name="u_id1" value="<?php echo $u_id; ?>">
                <input type="hidden" name="cart_order_driver" value="<?php echo $f2['cart_order_driver']; ?>">
                <input type="hidden" name="total1" value="<?php echo $total1 ?>">
                <input type="hidden" name="total2" value="<?php echo $total2 ?>">
                <input type="hidden" name="total3" value="<?php echo $fa['cashin_total'] ?>">
                <input type="hidden" name="cart_order_delivery" value="<?php echo $cart_order_delivery ?>">
                <input type="hidden" name="cart_order_payment" value="<?php echo $cart_order_payment ?>">
              
				</div>
			</div>
        <div class="modal-footer">
								<button  class = "btn btn-danger" name = "add1" style="float:right;" data-dismiss = "modal" aria-label = "Close">
								<span class = "fas fa-times"></span> Close</button>
		
            <button  class = "btn btn-primary" name = "update_order" style="float:right;"><span class = "fas fa-save"></span> Update Order</button>
         
        </div>
							</form>
      </div>
    </div>
  </div> 
<?php
if (isset($_POST['update_order'])) {

    $cart_order_id = $_POST['cart_order_id'];
    $status = $_POST['status'];
    $cart_order_delivery1 = $_POST['cart_order_delivery'];
    $cart_order_payment1 = $_POST['cart_order_payment'];
    $quantity = $_POST['quantity'];
    $u_id_u = $_POST['u_id'];
    $cart_order = $_POST['cart_order'];
    $total_amount = $_POST['total_amount'] + 59;
    $cashin_total = $_POST['cashin_total'];
    $u_id1 = $_POST['u_id1'];
    $cart_order_driver = $_POST['cart_order_driver'];
    $total1_e = $_POST['total1'];
    $total2_e = $_POST['total2'];
    $cashin_total_d = $_POST['cashin_total_d'] + 59;
    $total_final = $total_amount - 59;
    $cashin_total_p = $total_final * 0.1;
    $cashin_total_s = $total_final - $cashin_total_p;
    $cashin_total_a = $total_final * 0.1;
    $cashin_total_af = $cashin_total_a + $total3;
    $cashin_total_final = $cashin_total - $total_amount;
   
    if ($status == "Done") {
   
        //Driver
        if ($cart_order_delivery1 == "Delivery") {

            if ($cart_order_payment1 == "Cash") {
            
            } 
            else {
            

                if ($total1_e >= 1) {
                $update3 = $conn->query("UPDATE `cashin` SET `cashin_total`= `cashin_total` + '$cashin_total_d' WHERE `cashin_user_id` = '$cart_order_driver'");
                    if ($update3) {
                }
            }       else {
                $sqli = "INSERT INTO cashin VALUES(null,'59','$cart_order_driver')";
                if (mysqli_query($conn, $sqli)) {
                }
            }

              //Admin
			    if ($total2_e >= 1) {
            $update4 = $conn->query("UPDATE `cashin` SET `cashin_total`=`cashin_total` + '$cashin_total_s' WHERE `cashin_user_id` = '$u_id1'");
                if ($update4) {}
            }
                else {
            $sqli1 = "INSERT INTO cashin VALUES(null,'$cashin_total_s','$u_id1')";
                if (mysqli_query($conn, $sqli1)) {}
            }




            //Store 
			 $update5 = $conn->query("UPDATE `cashin` SET `cashin_total`=`cashin_total` + ' $cashin_total_p' WHERE `cashin_user_id` = '3'");
                if ($update5) {
                }
               


            }
        }else{
         if ($cart_order_payment1 == "E Wallet Method") {
            $update2 = $conn->query("UPDATE `cashin` SET `cashin_total`=`cashin_total` + '$cashin_total_final' WHERE `cashin_user_id` = '$u_id_u'");
                if ($update2) {}
                }
        }
        
        
       
       
    }
    $result1 = $conn->query("UPDATE `cart_order` SET `cart_order_status`='$status' WHERE `cart_order_add`='$cart_order'");
    if ($result1) {
        echo '<script>
									function myFunction() {
										swal({
										title: "Success! ",
										text: "' . $status . '",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "order-view.php?view_cart=' . $u_id1 . '&cart_order=' . $cart_order . '";
									  });}
									
								  </script>';
    } else {
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
						$update = $conn->query("UPDATE `user_account` SET `username` = '$username', `fname` = '$fname',`mname` = '$mname',`lname`='$lname',`password`='$password1'WHERE `u_id` = '$id'");	
						
						if ($update) { 
									echo '<script>
									function myFunction() {
										swal({
										title: "Success! ",
										text: "Your Profile Successfully Update",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "add_lesson.php";
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
 
 function handleSelect(elm)
  {
     window.location = elm.value+".php";
  }  
</script>
</body>
</html>