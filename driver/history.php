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
    </head>
    <body>
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
            <?php    
				    
                $q_e = $conn->query("SELECT * FROM `cart_order` WHERE `cart_order_status` = 'Delivered' AND `cart_order_driver`='$u_id'") or die(mysqli_error());
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
                                    <h5 class="fw-bolder">Delivered</h5>
                                    
                                </div>
                                <p><b style="font-size:12px;">Order Reference:   </b>  <text style="float:right;margin-right:10px;font-size:12px;"><?php echo $f_e['cart_order_add'];?>   </text></p>
                                <p><b style="font-size:12px;">Pharmacy Name:     </b>  <text style="float:right;margin-right:10px;font-size:12px;"><?php echo $f3['lname'];?>             </text></p>
                                <p><b style="font-size:12px;">Pharmacy Address:  </b>  <text style="float:right;margin-right:10px;font-size:12px;"><?php echo $f3['brgy']." ".$f3['city'];?> </text></p>
                                
                            </div>
							</form>
							<div class="card-footer p-12 pt-0 border-top-0 bg-transparent" style="margin-top:10px;">
                            <div style="float:right;">
                                <a class="btn btn-outline-light mt-auto bg-success" href="history-list.php?store_id=<?php echo $f_e['cart_order_add'];?>">View Details</a></div>
                            </div>
                        </div>
            </div>
            <?php
		 }
            
             ?>
                    </div> 
				</div>
        </section>
        <!-- Footer-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
