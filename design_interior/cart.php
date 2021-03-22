<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM produse WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["product_name"], 'code'=>$productByCode[0]["code"],'quantity'=>$_POST["quantity"], 'product_price'=>$productByCode[0]["product_price"],'image'=>$productByCode[0]["product_image"]));			
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
    <title>Coș</title>
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
	<link rel="stylesheet" href="assets/css/cart.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>

.row {
  display: -ms-flexbox; 
  display: flex;
  -ms-flex-wrap: wrap; 
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; 
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; 
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; 
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: white;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: transparent;
  color: black;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 2px;
  cursor: pointer;
  font-size: 15px;
}

.btn:hover {
  background-color: transparent;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}


</style>
	
<?php
       require_once("dbcontroller.php");
	   $db_handle = new DBController();
	   $con=mysqli_connect("localhost","root","","shop");
	   if($con === false){
		   die("ERROR:Could not connect." . mysqli_connect_error());
	   }
	   if(isset($_POST['send'])){
		   $NUME=mysqli_real_escape_string($con,$_POST['firstname']);
		   $EMAIL=mysqli_real_escape_string($con,$_POST['email']);
		   $ADRESA=mysqli_real_escape_string($con,$_POST['address']);
		   $ORAS=mysqli_real_escape_string($con,$_POST['city']);
		   $TARA=mysqli_real_escape_string($con,$_POST['state']);
		   $NUME_CARD=mysqli_real_escape_string($con,$_POST['cardname']);
		   $NUMAR_CARD=mysqli_real_escape_string($con,$_POST['cardnumber']);
		   $LUNA=mysqli_real_escape_string($con,$_POST['expmonth']);
		   $ANUL=mysqli_real_escape_string($con,$_POST['expyear']);
		   $CVV=mysqli_real_escape_string($con,$_POST['cvv']);
		   if($NUME!="" && $EMAIL!="" && $ADRESA!="" && $ORAS!="" && $TARA!="" && $NUME_CARD!="" && $NUMAR_CARD!="" && $LUNA!="" && $ANUL!="" && $CVV!="")
		   {
			
			foreach ($_SESSION["cart_item"] as $item){
				
				$cod = $item["code"];
				$res = $db_handle->runQuery("SELECT * FROM produse  where code=\"$cod\"");
				
				foreach($res as $k => $v){
					
					
					$var=$res[$k]["product_name"];
					$var1=$res[$k]["code"];
					
		   
			   $sql="INSERT INTO CHECKOUT (NUME, EMAIL, ADRESA,ORAS,TARA,NUME_CARD,NUMAR_CARD,LUNA,ANUL,CVV,nume_produs,cod_produs) VALUES ('$NUME', '$EMAIL', '$ADRESA','$ORAS','$TARA','$NUME_CARD','$NUMAR_CARD','$LUNA','$ANUL','$CVV','$var','$var1')";
			   if(mysqli_query($con,$sql)){
				   echo '<script>alert("Comanda dumneavoastră a fost înregistrată.")</script>'; 
			   }
			   else{
				   echo '<script>alert("Comanda nu a putut fi înregistrată")</script>'; 
			   }
		      }
			}
		   }
		   
	   
			   
				foreach ($_SESSION["cart_item"] as $item1){
						
					$cod1 = $item1["code"];
					$res1 = $db_handle->runQuery("SELECT cumparari FROM produse where code=\"$cod1\"");
					//echo '<p>' . print_r($res1) . '</p>';
					foreach($res1 as $k => $v){
							
						$res1[$k]["cumparari"] = $res1[$k]["cumparari"]+$item1["quantity"];
						
						$val=$res1[$k]["cumparari"];
						$db_handle->runCom("UPDATE produse SET cumparari=\"$val\" WHERE code=\"$cod1\"");
					}
								
						
						
					}
					 
			   }
		   


?>
	

</head>

<body>
    
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
					<li><a href="cart1.php">Coș </a></li>
					<li><a href="logout.php">Deconectare</a></li>
				  </ul>
                </nav>
  
    </nav>
	<div id="shopping-cart">
<div class="txt-heading"><h5>Coș de cumpărături</h5></div>

<a id="btnEmpty" href="cart.php?action=empty">Golește coșul</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	

<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Nume</th>
<th style="text-align:right;" width="5%">Cantitate</th>
<th style="text-align:right;" width="10%">Preț unitar</th>
<th style="text-align:right;" width="10%">Preț</th>
<th style="text-align:center;" width="5%">Șterge</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" width=100px; /><?php echo $item["name"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "RON ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "RON ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="assets/images/icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "RON ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Coșul dumneavoastră este gol</div>
<?php 
}
?>
</div>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="cart.php" method="post">
      
        <div class="row">
          <div class="col-50">
            <h5>Adresa de facturare</h5>
            <label for="fname"><i class="fa fa-user"></i> Nume</label>
            <input type="text" id="fname" name="firstname" >
            <label for="email"><i class="fa fa-envelope"></i> E-mail</label>
            <input type="text" id="email" name="email" >
            <label for="adr"><i class="fa fa-address-card-o"></i> Adresa</label>
            <input type="text" id="adr" name="address" >
            <label for="city"><i class="fa fa-institution"></i>Oraș</label>
            <input type="text" id="city" name="city">

            <div class="row">
              <div class="col-50">
                <label for="state">Țara</label>
                <input type="text" id="state" name="state" >
              </div>
            </div>
          </div>

          <div class="col-50">
            <h5>Plată</h5>
            <label for="fname">Carduri acceptate</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Numele de pe card</label>
            <input type="text" id="cname" name="cardname" >
            <label for="ccnum">Număr card</label>
            <input type="text" id="ccnum" name="cardnumber" >
            <label for="expmonth">Luna expirării</label>
            <input type="text" id="expmonth" name="expmonth" >
            <div class="row">
              <div class="col-50">
                <label for="expyear">Anul expirării</label>
                <input type="text" id="expyear" name="expyear" >
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" >
              </div>
            </div>
          </div>
          
        </div>
        <input type="submit" name = "send" value="Finalizați comanda" class="btn">
      </form>
    </div>
  </div>
</div>


	
	
	
	
	
	
	
	
	</div>
</body>
</html>