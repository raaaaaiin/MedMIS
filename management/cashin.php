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
            <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#gcash">Admin Gcash </a> 
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
        </section>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype = "multipart/form-data"autocomplete="off" >
        <div class="modal-body">
            	   <label>Payment Declare<b style="color:red;"></b></label>
		         <input type="text" name="declare" class="form-control" required>
            	   <label>Proof of Payment: <b style="color:red;"></b></label>
		         <input type="file" name="file" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="submit" name="send_proof">Send Proof</button>
 
        </div>
        </form>
        <center>
	   <?php
            if(isset($_POST['send_proof'])){
	        $declare = $_POST['declare'];
			$date = date('F d,Y - h:i:s A',time());
			$ref = 'MED-'.date('Ymidhs',time());
			$brand1 = "THERMO-";
			$invoice1 = $brand1.$cur_date;
			$customer_id1 = rand(00000 , 99999);
			$uRefNo1 = $invoice1.'-ITEM-'.$customer_id1;
     
			$tmp1=$_FILES["file"]["tmp_name"];
			$extension1 = explode("/", $_FILES["file"]["type"]);
			$name2=$uRefNo1.".".$extension1[1];
			$ref = date("ydsimh",time());
			move_uploaded_file($tmp1, "img/" . $uRefNo1.".".$extension1[1]);
			$sql123 ="INSERT INTO proof_payment VALUES(null,'$u_id','$declare','$name2','For Verify')";
			if (mysqli_query($conn,$sql123)) { 
									echo '<script>
									function myFunction() {
										swal({
										title: "Success! ",
										text: "Successfully Send the Proof",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "cashin.php";
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
	   </center>
	   </form> 
  </div>
  <div class="modal fade" id="gcash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Gcash Number</h5>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <h3><e>09155654151</e></h3>
            <b></b>
                     
          <h3>How to Cash in</h3>
          <p>1. Send your money through Gcash application and input the Admin Gcash number.</p>
          <p>2. Screenshot the receipt.</p>
          <p>3. Attached the screenshot on the MediGrab application, and enter the amount you sent, then send proof</p>
          <p>4. Wait for a few seconds until the Admin has validated the cash in request and it will be reflected on your E-coins</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="number" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">MediGrab GCash Number</h5>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        
        <?php 
        ?>
      </div>
    </div>
  </div>
</div><br>
        <!-- Footer-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
