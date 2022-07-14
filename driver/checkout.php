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
        <title>Medi Cab</title>
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
			
			<form action="checkout.php" method="POST">
				<div class="row">
				<div class="form-group">
                  <div class="col-sm-4 mb-3 mb-sm-0">
					<label><b>Complete your Address Here</b></label>
                    <input type="text" class="form-control" style=" text-transform:capitalize;"required = "required" name = "address" >
                  </div>
				  <div class="col-sm-4 mb-sm-0">
					<label><b>Your Number</b></label>
                    <input type="text" class="form-control"	style="text-transform:capitalize;" placeholder="Contact" name = "number" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="11" minlength="11" >
                  </div>
                </div>
                </div>
            <div class="container px-4 px-lg-5 mt-5">
			<div class="form-group row"> 
			<div class="col-sm-5 mb-3 mb-sm-0">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4"> <table class="table">
  <thead>
    <tr>
      <th scope="col">Product</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Total</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
               <?php
		  $c = 1;
		  $total_price_all = 0;
					$q_e = $conn->query("SELECT * FROM `cart` WHERE `cart_user` = '$u_id' AND `status`='Pending'") or die(mysqli_error());
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
      <td><a class="btn btn-outline-light bg-danger mt-auto" href="checkout.php?del_cart=<?php echo $f_e['cart_id']?>"><i class="bi bi-bag-x"></i> </a></td>
    </tr>
	<?php 
	$total_price_all +=$total_per;
	}
	?>
  </tbody><thead>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col">Final Total</th>
      <th scope="col"><?php echo $total_price_all?> Php</th>
    </tr>
  </thead>
</table>
				<?php 
			
					if(isset($_GET['del_cart'])){
					$del_cart = $_GET['del_cart'];
					
					$result=$conn->query("UPDATE cart SET status='Deleted' WHERE cart_id='$del_cart'");
					if($result){
					echo '<script>
									function myFunction() {
										swal({
										title: "Success!",
										text: "Successfully Remove Product",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "checkout.php";
									  });}
									</script>';
					}
					}
				?>
							
				</div>  
				</div>
               <div class="col-sm-5 mb-3 mb-sm-0">
				
				<div class="form-group">
				  <div class="col-sm-4 mb-sm-0"><br>
				   <button class="btn btn-sm bg-success" style="float:right;color:white;" type="submit" name="check_out">
						<i class="bi bi-basket-fill"></i> Check Out
				   </button>
				   </div>
                </div>
				</form>
				<?php
					if(isset($_POST['check_out'])){
					$address = $_POST['address'];
					$number = $_POST['number'];
					$date = date('F d,Y - h:i:s A',time());
					$ref = 'MED-'.date('Ymidhs',time());
					$sql3r ="INSERT INTO cart_order VALUES(null,'$u_id','$address','$ref','$number','Pending','$date')";
					if (mysqli_query($conn,$sql3r)) {}	
					$result1=$conn->query("UPDATE `cart` SET `status`='Ordered',`cart_ref`='$ref' WHERE `cart_user`='$u_id' AND `status`='Pending'");
					if($result1){
					echo '<script>
									function myFunction() {
										swal({
										title: "Success!",
										text: "Successfully Order this Product",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "home.php";
									  });}
									</script>';
				}
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
