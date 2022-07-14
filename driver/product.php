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
			<a href="checkout.php">
				<h5 style="float:right;margin-right:25px;">
					<i class="bi bi-basket-fill"></i> 
					<?php
						 $sql1="SELECT count(*) AS total1 FROM `cart` WHERE `cart_user` = '$u_id' AND `status`='Pending'";
						 $result1=mysqli_query($conn,$sql1);
						 $data1=mysqli_fetch_assoc($result1);
					     echo "<text style='font-size:15px;'>".$data1['total1']."</text>";
					
				?>
				</h5>
			</a>
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
               <?php
		  
					$q_e = $conn->query("SELECT * FROM `user_account` WHERE `position`='Pharmacy' ") or die(mysqli_error());
					while($f_e=$q_e->fetch_array()){
		  ?> 
				   <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="../student/img/<?php echo $f_e['mname']?>" alt="..." />
                            <!-- Product details-->
							<form action="" method="GET">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $f_e['lname']?></h5>
                                    <!-- Product price-->
                                     Address:  <?php echo $f_e['fname']?> <br>
                                     Location: <?php
													$temp = (rand(2,5));
													echo $temp;
											    ?>.<?php
													$temp = (rand(1,9));
													echo $temp;
											    ?> km
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-light mt-auto bg-danger" href="product-list.php?u_id=<?php echo $f_e['u_id']?>">Open</a></div>
                            </div>
							</form>
                        </div>
                    </div> 
					<?php 
			}
			if(isset($_GET['prod'])){
				$product = $_GET['prod'];
				$date = date('F d,Y - H:i:s A',time());
				$ref  = date('YdmHis',time());
				$sql3r ="INSERT INTO cart VALUES(null,'$ref','$u_id','$product','1','Pending','$date')";
				if (mysqli_query($conn,$sql3r)) {
					echo '<script>
									function myFunction() {
										swal({
										title: "Success!",
										text: "Successfully Added new Product",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "product.php";
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
