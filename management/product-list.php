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
    <body onload="myFunction()">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!"><img src="../img/medilogo.png" style="width:150px;" autofill="off"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="home.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle active" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Store</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="product.php">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="history.php">Order History</a></li>
                            </ul>
                        </li> 
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
			
			<a href="checkout.php" style="float:right;margin-right:20px;text-decoration:none;">
				<h5 style="float:right;">
					<i class="bi bi-basket-fill"></i> 
					<?php
						 $sql1="SELECT count(*) AS total1 FROM `cart` WHERE `cart_user` = '$u_id' AND `status`='Pending'";
						 $result1=mysqli_query($conn,$sql1);
						 $data1=mysqli_fetch_assoc($result1);
					     echo "<text style='font-size:15px;'>".$data1['total1']."</text>";
					
				    ?>
				</h5>
			</a>
			<a href="cashin.php" style="float:right;margin-right:20px;text-decoration:none;">E-Coins: 
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
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
               <?php
					
				$u_id1 = $_GET['u_id'];
				
				$sql2="SELECT count(*) AS total2 FROM `product` WHERE `product_qty`!='0' AND `product_updated_date`!='Deleted' AND `product_user`='$u_id1'";
				$result2=mysqli_query($conn,$sql2);
				$data2=mysqli_fetch_assoc($result2);
				$product_count = $data2['total2'];
				if($product_count>=1){
					$q_e = $conn->query("SELECT * FROM `product` WHERE `product_user`='$u_id1'") or die(mysqli_error());
					while($f_e=$q_e->fetch_array()){
		  ?> 
				   <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="../student/img/<?php echo $f_e['product_img']?>" alt="..." height="100px"/>
                            <!-- Product details-->
							<form action="insert.php" method="GET">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder" style="font-size:12px;"><?php echo $f_e['product_name']?></h5>
                                    <!-- Product price-->
                                    <p  style="font-size:10px;">
                                     <?php echo $f_e['product_price']?> Php  - 
                                     <?php echo $f_e['product_qty']?> Qty
                                     </p><center>
									  <label  style="font-size:10px;">Quantity</label>  
									 <input type="text" style="width:100px;height:20px;"class="form-control"name="qty" style="width:100px;" placeholder="0" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
									 <input type="hidden" name="prod" value="<?php echo $f_e['product_id']?>">
									 <input type="hidden" name="u_id" value="<?php echo $u_id1 ?>">
									 <input type="hidden" name="u_id1" value="<?php echo $u_id ?>">
									 <input type="hidden" name="product_updated_by" value="<?php echo  $f_e['product_updated_by'] ?>">
									 </center>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><button class="btn btn-danger mt-auto" name="prod_button" style="font-size:10px;">Add to Cart</button></div>
                            </div>
							</form>
                        </div>
                    </div> 
					<?php 
			}
			
				}else{
		 ?>
		<div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="data:image/png;base64,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" alt="..." />
                            <!-- Product details-->
							<form action="" method="GET">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Aw Sorry We Dont have our Medicine yet</h5>
                                    <!-- Product price-->
                                     0.00 Php  - 
                                     0 Qty
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to Cart</a></div>
                            </div>
							</form>
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
		<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
