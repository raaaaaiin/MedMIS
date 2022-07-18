<?php
session_start();
require_once "../connect.php";
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit();
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
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" href="http://cdnjs.buttflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />
	 <link href="../management/css/bootstrap.css" rel="stylesheet" />
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body onload="myFunction()" >
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
                            <a class="nav-link dropdown-toggle " id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Store</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="product.php">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="history.php">Order History</a></li>
                            </ul>
                        </li> 
						<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-transform:capitalize;"><?php
                            $username = htmlspecialchars($_SESSION["username"]);
                            ($q = $conn->query(
                                "SELECT * FROM `user_account` WHERE `username` = '$username'"
                            )) or die(msqli_error());
                            $f = $q->fetch_array();
                            $u_id = $f["u_id"];
                            $name =
                                "" .
                                $f["fname"] .
                                " " .
                                $f["mname"] .
                                " " .
                                $f["lname"] .
                                "";
                            echo $name;
                            ?></a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item active" href="setting.php">Settings</a></li>
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
       

            <div class="container px-4 px-lg-5 mt-4">

				<div class="container p-0">
	
		<div id="locationPicker" class="h-50" style="width: auto;"></div>
	</div>




	<br><br>

	<div class="row">
			<div class="col-9 col-md-11">
				<input type="text" class="form-control" id="address" placeholder="Search Address E.g Antipolo Rizal">
			</div>
			<div class="col-3 col-md-1">
				<button  class = "btn btn-primary btn-user" name="search"  id="search" style="float:right;"><span class = "glyphicon glyphicon-save"></span> Search</button>
			</div>
			
		</div>
		<br>
				 <form class="user"  method = "POST" action = "<?php echo htmlspecialchars(
         $_SERVER["PHP_SELF"]
     ); ?>" enctype = "multipart/form-data" autocomplete="off">
				 <div class="row">
                 <div class="d-none">
			<div class="col-md-3">
				<input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude">
			</div>
			<div class="col-md-3">
				<input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude">
			</div>
			<div class="col-md-3">
				<input type="number" class="form-control" id="radius" placeholder="Radius">
			</div>
			</div>
                <div class="col-md-6">
                    <input type="text" id="UnitFloor" class="form-control"	style=" text-transform:capitalize;" required = "required" placeholder="Unit/Floor/Building Name *" name = "ufb"  value=""><br>
                 </div>
				  <div class="col-md-6">
                    <input type="text" id="BuildingName" class="form-control"	style=" text-transform:capitalize;"placeholder="Avenue/District" name = "ave"  value=""><br>
                 </div>
					 <div class="col-md-6">
                    <input type="text" id="street" class="form-control"   style=" text-transform:capitalize;"required = "required"placeholder="Street *" name = "street" value="" > <br>
					</div>
                <div class="col-md-6">
					<input type="text" id="Barangay" class="form-control"  required = "required" name="barangay" placeholder="Barangay *"  value="<?php echo $f[
          "brgy"
      ]; ?>"><br>
					</div>
				  <div class="col-md-6">
						<input type="text" id="City" class="form-control "required = "required" name="city"  placeholder="City *"  value="<?php echo $f[
         "city"
     ]; ?>"><br>
						</div>
			 <div class="col-md-6">
					<input type="text" id="Province" class="form-control"  required = "required"name="province"  placeholder="Province *"  value=""><br>
					</div>
					</div>
					
                    <button  class = "btn btn-primary btn-user" name="check"  id="register" style="float:right;"><span class = "glyphicon glyphicon-save"></span> Update Profile</button>
					
					<br><br>
				<hr>
              </form>
             
			
				<?php if (isset($_POST["check"])) {
        $lat = $_POST['latitude'];
        $long = $_POST['longitude'];
        $ufb = $_POST['ufb'];
        $ave = $_POST['ave'];
        $street = $_POST['street'];
        $province =$_POST['province'];
        $brgy = $_POST['barangay'];
        $city = $_POST['city'];
        
                $result = $conn->query(
                    "UPDATE user_account SET latitude='$lat',`longtitude`='$long',`unitfloorbld`='$ufb',`ave`='$ave',street='$street',province='$province',brgy='$brgy',city='$city' WHERE u_id='$u_id' "
                );
                if ($result) {
                    echo '<script>
									function myFunction() {
										swal({
										title: "Success!",
										text: "Successfully Updated Your Profile",
									    icon: "success",
										type: "success"
										}).then(function() {
										window.location = "setting.php";
									  });}
									</script>';
                }else {
                echo '<script>
									function myFunction() {
									swal({
									title: "Failed!",
									text: "Oops! Sorry, please try again",
									icon: "error",
									button: "Ok",
									});}
									</script>';
                }
    } ?>
            </div>
        </section>
        <!-- Footer-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
<script>
var check = function() {
  if (document.getElementById('password2').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('password2').style.border = 'white 2px solid';
    document.getElementById('confirm_password').style.border = 'white 2px solid';
    document.getElementById('err2').innerHTML = '<br><span style="color:white;font-size:8px;" > </span> Password confirm';
  } else {
    document.getElementById('password2').style.border = 'red 2px solid';
    document.getElementById('confirm_password').style.border = 'red 2px solid';
    document.getElementById('err2').innerHTML = '<br><span style="color:red;font-size:8px;" > </span> Password and confirm password is not match';
  }
}
</script>
    </body>
</html>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="http://cdnjs.buttflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>
<script src="http://k4r573n.github.io/leaflet-control-osm-geocoder/Control.OSMGeocoder.js"></script>
<script src="../js/OSMLocationPicker.js"></script>
<script>
	$(document).ready(function(){
		OSMPICKER.initmappicker(14.5948914, 120.9782618, 1, {
			addressId: "address",
			latitudeId: "latitude",
			longitudeId: "longitude",
			radiusId: "radius"
		});
	});
</script>