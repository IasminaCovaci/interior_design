
<?php
	   session_start();
	   require_once("dbcontroller.php");
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
			   
			    $db_handle = new DBController();
				foreach ($_SESSION["cart_item"] as $item){
					
					$cod = $item["code"];
					$res = $db_handle->runQuery("SELECT * FROM produse  where code=\"$cod\"");
					
					foreach($res as $k => $v){

						$var=$res[$k]["product_name"];
						$var1=$res[$k]["code"];
						
			   $sql="INSERT INTO CHECKOUT (NUME, EMAIL, ADRESA,ORAS, TARA, NUME_CARD, NUMAR_CARD, LUNA,ANUL,CVV) VALUES ('$NUME', '$EMAIL', '$ADRESA','$ORAS', '$TARA','$NUME_CARD','$NUMAR_CARD','$LUNA', '$ANUL', '$CVV')";
			   if(mysqli_query($con,$sql)){
				   echo '<script>alert("Comanda dumneavoastră a fost finalizată cu succes!")</script>'; 
			   }
			   else{
				   echo '<script>alert("Comanda dumneavoastră nu s-a putut finaliza!")</script>'; 
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
