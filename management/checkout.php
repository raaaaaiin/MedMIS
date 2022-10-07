<?php
session_start();
require_once "connect.php";
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
?>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>MediGrab</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet"/>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body style="background-color:#f0f0f0">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-info">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!"><img src="../img/medilogo.png" style="width:150px;" autofill="off"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle active" id="navbarDropdown" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">Store</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="product.php">All Products</a></li>
                        <li>
                            <hr class="dropdown-divider"/>
                        </li>
                        <li><a class="dropdown-item" href="history.php">Order History</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false" style="text-transform:capitalize;"><?php
                        $username = htmlspecialchars($_SESSION["username"]);
                        $q = $conn->query("SELECT * FROM `user_account` WHERE `username` = '$username'") or die(msqli_error());
                        $f = $q->fetch_array();
                        $u_id = $f['u_id'];
                        $name = "" . $f['fname'] . " " . $f['mname'] . " " . $f['lname'] . "";
                        echo $name;
                        ?></a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="setting.php">Settings</a></li>
                        <li>
                            <hr class="dropdown-divider"/>
                        </li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Header-->
<!-- Section-->
<section class="py-3 h-100" style="background-color:#f0f0f0">
    <a href="checkout.php" style="float:right;margin-right:20px;text-decoration:none;">
        <h5 style="float:right;">
            <i class="bi bi-basket-fill"></i>
            <?php
            $sql1 = "SELECT count(*) AS total1 FROM `cart` WHERE `cart_user` = '$u_id' AND `status`='Pending'";
            $result1 = mysqli_query($conn, $sql1);
            $data1 = mysqli_fetch_assoc($result1);
            echo "<text style='font-size:15px;'>" . $data1['total1'] . "</text>";

            ?>
        </h5>
    </a>
    <a href="cashin.php" style="float:right;margin-right:20px;text-decoration:none;">E-Coins:
        <?php
        $qc = $conn->query("SELECT * FROM `cashin` WHERE `cashin_user_id` = '$u_id'") or die(msqli_error());
        $fc = $qc->fetch_array();
        $delfee = 59;
        $total_cash = $fc['cashin_total'];
        if ($fc['cashin_total'] == null) {
            echo "0";
        } else {
            echo $fc['cashin_total'];
        }
        ?>
    </a>
    <br>


    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data"
          autocomplete="off">
        <div class="row w-100" style="justify-content: center; margin:0px!important;">

            <div class="form-group mb-4 col-sm-12 col-md-8" style="overflow:hidden">
                <div class="form-group row h-100" style="    align-content: space-between;">
                    <div class="col-sm-12 mb-sm-0 col-md-12">
                        <div class="row m-0 row-cols-2 p-3 row-cols-md-3 row-cols-xl-4" style="border-radius: 25px;
    background: #ffffff;                                                                                                                                                
    padding: 20px;
    width: 100%;
    height: 100%;">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="17%" scope="col">Product</th>
                                    <th width="17%" scope="col">Name</th>
                                    <th width="17%" scope="col">Quantity</th>
                                    <th width="17%" scope="col">Price</th>
                                    <th width="17%" scope="col">Total</th>
                                    <th width="12%" scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $c = 1;
                                $total_price_all = 0;
                                $q_e = $conn->query("SELECT * FROM `cart` WHERE `cart_user` = '$u_id' AND `status`='Pending'") or die(mysqli_error());
                                while ($f_e = $q_e->fetch_array()) {
                                    $product = $f_e['cart_product'];
                                    $cart_pharmacy = $f_e['cart_pharmacy'];
                                    $q1 = $conn->query("SELECT * FROM `product` WHERE `product_id`='$product' ") or die(msqli_error());
                                    $f1 = $q1->fetch_array();

                                    $total_per = $f_e['cart_qty'] * $f1['product_price']
                                    ?>
                                    <tr>
                                        <td><img src="../student/img/<?php echo $f1['product_img'] ?>"
                                                 style="width:50px;height:50px;"/></td>
                                        <td><?php echo $f1['product_name'] ?></td>
                                        <td><?php echo $f_e['cart_qty'] ?> Qty</td>


                                        <td>₱ <?php echo $f1['product_price'] ?></td>
                                        <td>₱ <?php echo $f1['product_price'] * $f_e['cart_qty']; ?></td>
                                        <td><a class="btn btn-outline-light bg-danger mt-auto"
                                               href="checkout.php?del_cart=<?php echo $f_e['cart_id'] ?>"><i
                                                        class="bi bi-bag-x"></i> </a></td>
                                    </tr>
                                    <?php
                                    $total_price_all += $total_per;
                                }
                                ?>
                                </tbody>

                            </table>
                            <div class="d-sm-none col-sm-12 mb-2 mb-sm-0 w-100">
                                <table style="width:100%">
                                    <thead>

                                    <tr>
                                        <th style="border:0" scope="col">Sub Total Fee</th>
                                        <th style="border:0;float:right" scope="col">
                                            ₱ <?php echo $total_price_all ?></th>
                                    </tr>
                                    <tr>
                                        <th style="border:0" scope="col">SC/PWD Discount</th>
                                        <th style="border:0;float:right" scope="col">₱ 0</th>
                                    </tr>
                                    <tr>
                                        <th style="border:0" scope="col">Delivery Fee</th>
                                        <th style="border:0;float:right" scope="col">₱ 59</th>
                                    </tr>

                                    </thead>
                                </table>

                            </div>
                            <?php
                            if (isset($_GET['del_cart'])) {
                                $del_cart = $_GET['del_cart'];
                                $result = $conn->query("UPDATE cart SET status='Deleted' WHERE cart_id='$del_cart'");
                                if ($result) {
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
                    <input type="hidden" value="<?php echo $cart_pharmacy ?>" name="cart_pharmacy">

                </div>
            </div>
            <div class="form-group col-md-3" style="overflow:hidden;margin-bottom:150px">
                <div class="form-group row h-100" style="    align-content: space-between;">
                    <div class="col-sm-12 mb-sm-0 col-md-12">
                        <div class="row m-0 " style="border-radius: 25px;
    background: #ffffff;
    padding: 20px;
    width: 100%;
    height: 100%;">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label><b>Complete your Address Here</b></label>
                                <input type="text" class="form-control" style=" text-transform:capitalize;width:100%;"
                                       required="required" name="address"
                                       value="<?php echo $f['brgy'] . " " . $f['city'] ?>">
                            </div>
                            <div class="col-sm-12 mb-sm-0">
                                <label><b>Your Contact Number</b></label>
                                <input type="text" class="form-control" style="text-transform:capitalize;width:100%;"
                                       name="number" required
                                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                       maxlength="11" minlength="11">
                            </div>
                            <div class="col-sm-12 mb-sm-0">
                                <label><b> Receiving Option</b></label>
                                <select class="form-select" name="option" style="text-transform:capitalize;width:100%;">
                                    <option value="">Select Receiving Option</option>
                                    <option value="Delivery">Delivery</option>
                                </select>
                            </div>
                            <div class="col-sm-12 mb-sm-0">
                                <label><b> Payment Option</b></label>
                                <select class="form-select" name="option1"
                                        style="text-transform:capitalize;width:100%;">
                                    <option value="">Select Payment Option</option>
                                    <option value="Cash">Cash</option>
                                    <option value="E Wallet Method">E Wallet Method</option>
                                </select>

                                <div class="modal fade" id="gcash" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">For Gcash Payment:</h5>
                                                <button class="close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>To pay, Enter here your</p>
                                                <a href="https://getpaid.gcash.com/checkout/8bdfa3e407206066a4cf1a2d23354b46">"Gcash
                                                    Account"</a>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 ">
                                <label><b>Prescription</b></label>
                                <input type="file" class="form-control" style="text-transform:capitalize;width:100%;"
                                       name="file1" id="file1">
                            </div>
                            <div class="col-sm-12 ">
                                <label><b>Discount ID (Senior/PWD)</b></label>
                                <input type="file" class="form-control" style="text-transform:capitalize;width:100%;"
                                       name="file" id="file2">
                            </div>
                            <div class="d-none d-sm-block col-sm-12 mb-3 mt-4 mb-sm-0">
                                <table style="width:100%">
                                    <thead>

                                    <tr>
                                        <th style="border:0" scope="col">Sub Total Fee</th>
                                        <th style="border:0" scope="col">₱ <?php echo $total_price_all ?></th>
                                    </tr>
                                    <tr>
                                        <th style="border:0" scope="col">SC/PWD Discount</th>
                                        <th style="border:0" scope="col">₱ 0</th>
                                    </tr>
                                    <tr>
                                        <th style="border:0" scope="col">Delivery Fee</th>
                                        <th style="border:0" scope="col">₱ 59</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Final Total</th>
                                        <th scope="col" id="changediscount">₱ <?php echo $total_price_all + 59 ?></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <hr>
                            <button class="col-12 mt-2 btn bg-success d-none d-md-block"
                                    style="float:right;color:white;" type="submit" name="check_out">
                                <i class="bi bi-basket-fill"></i> Check Out
                            </button>


                        </div>

                    </div>
                </div>

            </div>

            <div class="d-md-none col-12 bg-light" style="
    height: 120px; 
    position: fixed; 
    bottom:0%;
    width:100%;
    left:-1px;
    background-color: #393838; 
    opacity: 1;
">
                <table class="mt-2" style="margin-left:20px;width:90%">
                    <thead>


                    <tr>
                        <th scope="col">Final Total</th>
                        <th scope="col" id="changediscount" style="float:right;">
                            ₱ <?php echo $total_price_all + 59 ?></th>
                    </tr>
                    </thead>
                </table>
                <button class="mt-2 btn bg-success" style="border-radius: 100px;width:100%;color:white; height:70px"
                        type="submit" name="check_out">
                    <i class="bi bi-basket-fill"></i> Check Out
                </button>
            </div>

    </form>


    <?php

    $cur_date = date("Y-m-d h:i:sa");
    if (isset($_POST['check_out'])) {
        $option1 = $_POST['option1'];
        if ($option1 == "E Wallet Method") {
            $total_price_all += $delfee;
            if ($total_price_all >= $total_cash) {

                echo '<script>
            				function myFunction() {
            				swal({
            				title: "Failed!",
            				text: "Your E Coin is Below to the Value",
            				icon: "error",
            				button: "Ok",
            				});}
            				</script>';

            } else {
                $address = $_POST['address'];
                $cart_pharmacy = $_POST['cart_pharmacy'];
                $option = $_POST['option'];
                $number = $_POST['number'];
                $date = date('F d,Y - h:i:s A', time());
                $ref = 'MED-' . date('Ymidhs', time());
                $brand1 = "THERMO-";
                $invoice1 = $brand1 . $cur_date;
                $customer_id1 = rand(00000, 99999);
                $uRefNo1 = $invoice1 . '-ITEM-' . $customer_id1;

                $tmp1 = $_FILES["file"]["tmp_name"];
                $extension1 = explode("/", $_FILES["file"]["type"]);
                $name2 = $uRefNo1 . "." . $extension1[1];
                $ref = date("ydsimh", time());
                move_uploaded_file($tmp1, "img/" . $uRefNo1 . "." . $extension1[1]);

                $brand2 = "THERMO-";
                $invoice2 = $brand2 . $cur_date;
                $customer_id2 = rand(00000, 99999);
                $uRefNo2 = $invoice2 . '-ITEM-' . $customer_id2;

                $tmp2 = $_FILES["file1"]["tmp_name"];
                $extension2 = explode("/", $_FILES["file1"]["type"]);
                $name3 = $uRefNo2 . "." . $extension2[1];
                move_uploaded_file($tmp2, "img/" . $uRefNo2 . "." . $extension2[1]);
                $sql3r = "INSERT INTO cart_order VALUES(null,'$u_id','$address','$name2','$name3','$ref','$number','Pending','$option','$option1','$date','','$cart_pharmacy')";
                if (mysqli_query($conn, $sql3r)) {
                }
                $result1 = $conn->query("UPDATE `cart` SET `status`='Ordered',`cart_ref`='$ref' WHERE `cart_user`='$u_id' AND `status`='Pending'");
                $reduceMoney = $conn->query("UPDATE `cashin` SET `cashin_total`=`cashin_total` - $total_price_all  WHERE `cashin_user_id` = '$u_id' ");
                if ($result1) {
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
                              myFunction();
            				</script>';
                }
            }

        } else {

            $address = $_POST['address'];
            $cart_pharmacy = $_POST['cart_pharmacy'];
            $option = $_POST['option'];
            $number = $_POST['number'];
            $date = date('F d,Y - h:i:s A', time());
            $ref = 'MED-' . date('Ymidhs', time());
            $brand1 = "THERMO-";
            $invoice1 = $brand1 . $cur_date;
            $customer_id1 = rand(00000, 99999);
            $uRefNo1 = $invoice1 . '-ITEM-' . $customer_id1;

            $tmp1 = $_FILES["file"]["tmp_name"];
            $extension1 = explode("/", $_FILES["file"]["type"]);
            $name2 = $uRefNo1 . "." . $extension1[1];
            $ref = date("ydsimh", time());
            move_uploaded_file($tmp1, "img/" . $uRefNo1 . "." . $extension1[1]);

            $brand2 = "THERMO-";
            $invoice2 = $brand2 . $cur_date;
            $customer_id2 = rand(00000, 99999);
            $uRefNo2 = $invoice2 . '-ITEM-' . $customer_id2;

            $tmp2 = $_FILES["file1"]["tmp_name"];
            $extension2 = explode("/", $_FILES["file1"]["type"]);
            $name3 = $uRefNo2 . "." . $extension2[1];
            move_uploaded_file($tmp2, "img/" . $uRefNo2 . "." . $extension2[1]);
            $sql3r = "INSERT INTO cart_order VALUES(null,'$u_id','$address','$name2','$name3','$ref','$number','Pending','$option','$option1','$date','','$cart_pharmacy')";
            if (mysqli_query($conn, $sql3r)) {
            }
            $result1 = $conn->query("UPDATE `cart` SET `status`='Ordered',`cart_ref`='$ref' WHERE `cart_user`='$u_id' AND `status`='Pending'");
            if ($result1) {
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
                              myFunction();
            				</script>';
            }

        }

    }
    ?>

</section>
<!-- Footer-->
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
<!-- Core theme JS-->
<script>

    document.getElementById('file1').onchange = function () {
        const reg = /[a-zA-Z]*/
        const value = document.getElementById('changediscount').innerHTML;
        const discountedValue = (parseInt(value.replace(reg, "")) - 59) * 0.80;
        alert(discountedValue)
        document.getElementById('changediscount').innerHTML = '₱ ';
        document.getElementById('changediscount').innerHTML += (discountedValue + 59);
        document.getElementById('changediscount').innerHTML += ' <s style="color:red">' + parseInt(value.replace(reg, "")) + '</s> ';
    };
</script>
</body>
</html>