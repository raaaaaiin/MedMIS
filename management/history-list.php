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
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
              <table class="table">
  <thead>
    <tr>
      <th scope="col">Product</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
               <?php
		  $c = 1;
		  $total_price_all = 0;
		  $store_id = $_GET['store_id'];
					$q_e = $conn->query("SELECT * FROM `cart` WHERE `cart_user` = '$u_id' AND `status`='Ordered' AND `cart_ref`='$store_id'") or die(mysqli_error());
					while($f_e=$q_e->fetch_array()){
							$product = $f_e['cart_product'];
							$q1 = $conn->query("SELECT * FROM `product` WHERE `product_id`='$product' ") or die(msqli_error());
							$f1 = $q1->fetch_array();
							
							$total_per = $f_e['cart_qty'] * $f1['product_price']
		  ?>
    <tr>
      <td><img src="../student/img/<?php echo $f1['product_img']?>" style="width:50px;height:50px;" /></td>
      <td><?php echo $f_e['cart_qty']?> Qty</td>
      <td><?php echo $f1['product_price']?> Php</td>
      <td><?php echo $f_e['cart_qty'] * $f1['product_price']?> Php</td>
    </tr>
	<?php 
	$total_price_all +=$total_per;
	$status =$f_e['status'];
	}

		$q12 = $conn->query("SELECT * FROM `cart_order` WHERE `cart_order_add`='$store_id' ") or die(msqli_error());
		$f12 = $q12->fetch_array();
		$cart_order_driver = $f12['cart_order_driver'];
        $means = $f12['cart_order_delivery'];
               $stats = $f12['cart_order_status'];
		$q11 = $conn->query("SELECT * FROM `user_account` WHERE `u_id` = '$cart_order_driver'") or die(msqli_error());
		$f11 = $q11->fetch_array();
        if(is_null($f11)){
            $f11['fname'] = "Pending";
            $f11['mname'] = " ";
            $f11['lname'] = " ";
            $f11['user_id_number'] = "Pending";
        }
	?>
  </tbody>
  <thead>
    <tr>
      <th scope="col">Status</th>
      <th scope="col" style="font-weight: normal;"><?php echo $f12['cart_order_status']?></th>
      <th scope="col">Final Total</th>
      <th scope="col" style="font-weight: normal;"><?php echo $total_price_all + 59?> Php</th>
    </tr>
  </thead>
</table>
                    <?php
                    if($means == 'Delivery' && $stats != 'Rejected'){


                    ?>
<br><br>
<b style="margin-top:30px;">Drivers Details:</b>
<b></b>
<h6 style="margin-top:20px;">Drivers Name: </h6>
<h6 style="margin-top:20px;"><?php echo $f11['fname']." ".$f11['mname']." ".$f11['lname']?></h6>
<h6>Plate Number: </h6>
<h6><?php echo $f11['user_id_number']?></h6>
                    <?php
                    }elseif($stats == "Rejected"){
                        ?>
                        <b class="w-100" style="margin-top:30px;color:red">This item is rejected due to : Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</b>
                            <?php
                    } else{
                        ?>
                        <b style="margin-top:30px;">This item is for pick up</b>
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
