<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM produse WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["product_name"], 'code'=>$productByCode[0]["code"],'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["product_price"],'image'=>$productByCode[0]["product_image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;
	}
}

?>
<!doctype html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Living</title>
    <link rel="stylesheet" href="assets/css/fonts.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/loader/loaders.css">
    <link rel="stylesheet" href="assets/css/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/aos/aos.css">
    <link rel="stylesheet" href="assets/css/swiper/swiper.css">
    <link rel="stylesheet" href="assets/css/lightgallery.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-grid.css">
    <link rel="stylesheet" href="assets/css/page.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
	<style>
	.vertical-center {
	  margin: -200px;
	  position: absolute;
	  top: 130%;
	  -ms-transform: translateY(50%);
	  transform: translateY(50%);
	}
	.vertical-center1 {
	  margin: -80px;
	  position: absolute;
	  top: 97.5%;
	  -ms-transform: translateY(50%);
	  transform: translateY(50%);
	}
</style>

	

</head>

<body>
    <div class="css-loader">
        <div class="loader-inner line-scale d-flex align-items-center justify-content-center"></div>
    </div>
	<div style="background-image: url('assets/images/r3.jpg');background-repeat: no-repeat;
    background-attachment: fixed;  
    background-size: cover;">
	<nav class="navbar navbar-expand-md tm-main-nav-container">
				<nav id="mainav">
				   <ul class="clear">
					<li class="active"><a href="home.php">Acasă</a></li>
					<li><a class="drop" href="#">Produse</a>
					  <ul>
						<li><a href="living.php">Living</a></li>
						<li><a href="dormitor.php">Dormitor</a></li>
						<li><a href="baie.php">Baie</a></li>
						<li><a href="bucatarie.php">Bucătărie</a></li>
					  </ul>
					</li>
					<li><a href="cart.php">Coș </a></li>
					<li><a href="logout.php">Deconectare</a></li>
				  </ul>
                </nav>
  
    </nav>
	<div class="ourproduct">
  <div class="container">
     <div class="row product_style_3" ">
	 <!--produse-->
	  
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM produse WHERE categorie='living' ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
	<table>
	<form method="post" action="living.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
		<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
			<div class="full product">
				<div class="product_img">
					<div class="center"> <img src="<?php echo $product_array[$key]["product_image"]; ?>" alt="#"/>
					<div class="overlay_hover"> </div>
						 <div class="cart-action">
						 <input type="text" class="vertical-center1" name="quantity" value="1" size="2" />
						 <input type="submit" value="Adaugă în coș" class="vertical-center" />
						 </div>
				    </div>
                </div>
				<div class="product_detail text_align_center">
					<p class="product_price"><?php echo $product_array[$key]["product_price"]; ?> RON</p>
					<p class="product_descr"><?php echo $product_array[$key]["product_name"]; ?></p>
				</div>

			</div>
		</div>				
	</form>
	</table>
	<?php
			}
		}
	?>	    	   
    </div>
  </div>
	
     <footer>
        <div class="foot-note">
            <div class="container">
                <div
                    class="footer-content text-center text-lg-left d-lg-flex justify-content-between align-items-center">
                    <p class="mb-0" data-aos="fade-right" data-aos-offset="0"><b>&copy;2020 All Rights Reserved</b></p>
                    <p class="mb-0" data-aos="fade-left" data-aos-offset="0"><a href="#"><b>Terms Of Use</a><a
                            href="#">Privacy & Security
                            Statement</b></a></p>
                </div>
            </div>
        </div>
	
    </footer>
    <script src="assets/js/jquery-3.3.1.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="assets/js/loaders.css.js"></script>
    <script src="assets/js/aos.js"></script>
    <script src="assets/js/swiper.min.js"></script>
    <script src="assets/js/lightgallery-all.min.js"></script>
    <script src="assets/js/main.js"></script>
	


</body>
</html>