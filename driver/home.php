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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
								$city=$f['city'];
								$brgy=$f['brgy'];
								$location = $brgy." ".$city;
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
			<a href="withdraw.php" style="float:right;margin-right:20px;text-decoration:none;margin-top:10px;">E-Coins: 
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
        <section class="py-5">	
         
            <div class="container px-12 px-lg-12 mt-12">
                <div class="row gx-12 gx-lg-12 row-cols-1 row-cols-md-12 row-cols-xl-12">
            <?php 
                $sql1d="SELECT count(*) AS total1d FROM `cart_order` WHERE `cart_order_status`='Delivering' OR `cart_order_status`='ReadyDispatch'  AND `cart_order_name` = '$location' AND `cart_order_delivery`='Delivery'";
				$result1d=mysqli_query($conn,$sql1d);
				$data1d=mysqli_fetch_assoc($result1d);
				
				if($data1d['total1d']>="1"){
				    
			    $sql1="SELECT count(*) AS total1 FROM `cart_order` WHERE `cart_order_driver` = '$u_id' AND `cart_order_status`='Delivering'  AND `cart_order_delivery`='Delivery' ";
				$result1=mysqli_query($conn,$sql1);
				$data1=mysqli_fetch_assoc($result1);
				
				if($data1['total1']>=1){
				    
				        $q1c = $conn->query("SELECT * FROM `cart_order` WHERE `cart_order_driver` = '$u_id' AND `cart_order_status`='Delivering'") or die(msqli_error());
						$f1c = $q1c->fetch_array();
						$code = $f1c['cart_order_add'];
				?>
				 <div class="card h-100">
            <?php 
                $q_e = $conn->query("SELECT * FROM `cart_order` WHERE  `cart_order_add`='$code'") or die(mysqli_error());
				while($f_e=$q_e->fetch_array()){
				        $cart_order_add = $f_e['cart_order_add'];
				        $cart_order_uid = $f_e['cart_order_uid'];
				        $q1 = $conn->query("SELECT * FROM `cart` WHERE `cart_ref` = '$cart_order_add'") or die(msqli_error());
						$f1 = $q1->fetch_array();
						$cart_product = $f1['cart_product'];
						
				        $q2 = $conn->query("SELECT * FROM `product` WHERE `product_id` = '$cart_product'") or die(msqli_error());
						$f2 = $q2->fetch_array();
						$product_user = $f2['product_user'];
				        $q3 = $conn->query("SELECT * FROM `user_account` WHERE `u_id` = '$product_user'") or die(msqli_error());
						$f3 = $q3->fetch_array();
						
				        $q4 = $conn->query("SELECT * FROM `user_account` WHERE `u_id` = '$cart_order_uid'") or die(msqli_error());
						$f4 = $q4->fetch_array();
            ?>
                            <!-- Product image-->
                            <!-- Product details-->
                            <div class="card-body p-12">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $f_e['cart_order_add'];?></h5><br>
                                    
                                </div>
                                <p><b>Pharmacy Name:  </b> <text style="float:right;margin-right:30px;"><?php echo $f3['lname'];?> </text></p>
                                <p><b>Pharmacy Address:  </b>  <text style="float:right;margin-right:30px;"><?php echo $f3['fname'];?> </text></p>
                                <p><b>Client Name:  </b>  <text style="float:right;margin-right:30px;"><?php echo $f4['fname']." ".$f4['mname']." ".$f4['lname'];?> </text></p>
                                <p><b>Contact Number:  </b>  <text style="float:right;margin-right:30px;"><?php echo $f1c['cart_order_number'];?> </text></p>
                                <p><b>Address:  </b>  <text style="float:right;margin-right:30px;"><?php echo $f_e['cart_order_name'];?> </text></p>
                                <p><a href="https://www.google.com/maps">Track the location</a></p>
                            </div>
                            <!-- Product actions-->
                            <div class="text-center">
					        	<h5 class="fw-bolder">Medicine Ordered</h5><br>
						    </div>
							<?php 
				    
				}
						
					$q_e = $conn->query("SELECT * FROM `cart` WHERE `cart_ref`='$code' ") or die(mysqli_error());
					while($f_e=$q_e->fetch_array()){
						$product = $f_e['cart_product'];
						$cart_ref = $f_e['cart_ref'];
						$cart_qty = $f_e['cart_qty'];
						$status = $f_e['status'];
						$q1 = $conn->query("SELECT * FROM `product` WHERE `product_id` = '$product'") or die(msqli_error());
						$f1 = $q1->fetch_array();
						$product_price = $f1['product_price'];
						$product_name = $f1['product_name'];
						
						$total_amount +=$product_price * $cart_qty;
				?> 
                                <p><b style="margin-left:20px;"><?php echo $product_name;?></b>
                                <text style="float:right;margin-right:30px;"><?php echo $product_price."php * ".$cart_qty?>qty = <?php echo $product_price * $cart_qty ?> </text></p>
                           
                            <?php 	}?>
                            <b><text style="float:right;margin-right:30px;"><?php echo  "Total: ".$total_amount."";?> Php</text></b>
                            <div class="card-footer p-12 pt-0 border-top-0 bg-transparent" style="margin-top:10px;">
                                <div style="float:right;">
                               <a class="btn btn-outline-light mt-auto bg-success" href="home.php?ref=<?php echo $code;?>&done=Delivered"  data-bs-toggle="modal" data-bs-target="#exampleModal">Done Delivering ?</a>
                               <a class="btn btn-outline-light mt-auto bg-success" href="#"  data-bs-toggle="modal" data-bs-target="#exampleModal1">Report</a>
                               
                               </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please let us know</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype = "multipart/form-data"autocomplete="off" >
      <div class="modal-body">
        Why you want to report this Client?
        <textarea class="form-control" name="reason"></textarea>
        <input type="hidden" name="cart_user" value="<?php echo $cart_order_uid;?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Dismiss</button>
        <button type="submit" class="btn btn-info" name="report_client">Report Now</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php

                if(isset($_POST['report_client'])){
                $reason = $_POST['reason']; 
                $cart_user = $_POST['cart_user']; 
                $u_id = $u_id; 
                $date = date('F d,Y - h:i:s',time());
	            $sql123 ="INSERT INTO report VALUES(null,'$u_id','$cart_user','$reason','$date')";
					if (mysqli_query($conn, $sql123)) {
									echo '<script>
									function myFunction() {
										swal({
										title: "Success! ",
										text: "Successfully Report this Client",
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please let us know</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        are you sure you're done delivering this ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <a class="btn btn-outline-light mt-auto bg-danger" href="home.php?ref=<?php echo $code;?>&done=Delivered" >Yes</a>
      </div>
    </div>
  </div>
</div>
				<?php    
				
                if(isset($_GET['done'])){
                $ref = $_GET['ref'];    
            	$result112=$conn->query("UPDATE `cart_order` SET `cart_order_status`='Delivered' WHERE `cart_order_add`='$ref'");
	        	if($result112){
									echo '<script>
									function myFunction() {
										swal({
										title: "Success! ",
										text: "Successfully Delivered this Order",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "home.php?ref='.$ref.'";
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
                $q_e = $conn->query("SELECT * FROM `cart_order` WHERE `cart_order_status` = 'ReadyDispatch'") or die(mysqli_error());
				while($f_e=$q_e->fetch_array()){
				        $cart_order_add = $f_e['cart_order_add'];
				        
				        $q1 = $conn->query("SELECT * FROM `cart` WHERE `cart_ref` = '$cart_order_add'") or die(msqli_error());
						$f1 = $q1->fetch_array();
						$cart_product = $f1['cart_product'];
						
				        $q2 = $conn->query("SELECT * FROM `product` WHERE `product_id` = '$cart_product'") or die(msqli_error());
						$f2 = $q2->fetch_array();
						$product_user = $f2['product_user'];
				        $q3 = $conn->query("SELECT * FROM `user_account` WHERE `u_id` = '$product_user'") or die(msqli_error());
						$f3 = $q3->fetch_array();
            ?>
				   <div class="col mb-12" style="margin-bottom:50px;">
                        <div class="card h-100">
                            <!-- Product image-->
                            <!-- Product details-->
							<form action="" method="GET">
                            <div class="card-body p-12">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Can You Please Pick Me Up</h5>
                                    
                                </div>
                                <p><b>Order Reference:</b> <?php echo $f_e['cart_order_add'];?></p>
                                <p><b>Pharmacy Name:</b> <?php echo $f3['lname'];?>     </p>
                                <p><b>Pharmacy Address:  </b> <?php echo  $f3['brgy']." ".$f3['city'];?></p>
            
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-12 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-light mt-auto bg-danger" href="pick-up.php?ref=<?php echo $f_e['cart_order_add'];?>">Pick It Up </a></div>
                            </div>
							</form>
                        </div>
            </div>
            <?php
		 }
            
            }
				    
				}else{
        ?>
        <center>
            <h3>No Request Yet</h3>
        <center>
        
        <?php
                
            }
            
            
            ?>
                    </div> 
				</div>
        </section>
        <!-- Footer-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
