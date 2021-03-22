<?php
	   $con=mysqli_connect("localhost","root","","contact");
	   if($con === false){
		   die("ERROR:Could not connect." . mysqli_connect_error());
	   }
	   if(isset($_POST['send'])){
		   $EMAIL=mysqli_real_escape_string($con,$_POST['email']);
		   $NUME=mysqli_real_escape_string($con,$_POST['name']);
		   $SUBIECT=mysqli_real_escape_string($con,$_POST['subject']);
		   $MESSAGE=mysqli_real_escape_string($con,$_POST['message']);
		   if($EMAIL!="" && $NUME!="" && $SUBIECT!="" && $MESSAGE!=""){
			   $sql="INSERT INTO CONTACT (EMAIL, NUME, SUBIECT,MESSAGE) VALUES ('$EMAIL', '$NUME', '$SUBIECT','$MESSAGE')";
			   if(mysqli_query($con,$sql)){
				   echo '<script>alert("Mesajul dumneavoastră a fost înregistrat.")</script>'; 
			   }
			   else{
				   echo '<script>alert("Mesajul nu a putut fi înregistrat")</script>'; 
			   }
		   }
		   
	   }
	   
	?>