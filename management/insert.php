<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
		 <!-- Core theme CSS (includes Bootstrap)-->
<link href="css/styles.css" rel="stylesheet" />
<body onload="myFunction()">
<?php

				require_once "connect.php";
				date_default_timezone_set('Asia/Manila');
				$product = $_GET['prod'];
				$u_id1   = $_GET['u_id'];
				$u_id    = $_GET['u_id1'];
				$qty 	 = $_GET['qty'];
				$product_updated_by	 = $_GET['product_updated_by'];
				$date    = date('F d,Y - H:i:s A',time());
				$ref     = date('YdmHis',time());
				$sql3r   = "INSERT INTO cart VALUES(null,'$ref','$u_id','$product','$product_updated_by','$qty','Pending','$date')";
				if (mysqli_query($conn,$sql3r)) {
					echo '<script>
									function myFunction() {
										swal({
										title: "Success!",
										text: "Successfully Added new Product",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "product-list.php?u_id='.$u_id1.'";
									  });}
									</script>';
				}