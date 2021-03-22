<?php
	session_start();
	
	
	$con= mysqli_connect('localhost','root','','registration');
	mysqli_select_db($con, 'registration');
	
	$name = isset($_POST['user']) ? $_POST['user'] : '';
	$pass = isset($_POST['password']) ? $_POST['password'] : '';
	//$name = $_POST['user'];
	//$pass = $_POST['password'];  
	
	$s = "select * from usertable where name = '$name' && password =$pass";
	
	
	$result= mysqli_query($con, $s);
	$num = mysqli_num_rows($result);
	
	if($num == 1){
		header ('location:living.php');
		
	}else{
		header('location:home.php');
		
		}
	
	
	?>
	