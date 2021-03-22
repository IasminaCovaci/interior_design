<!doctype html>
<html lang="en">

<head>
   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Design Interior</title>
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link rel="stylesheet" href="assets/css/loader/loaders.css">
    <link rel="stylesheet" href="assets/css/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/aos/aos.css">
    <link rel="stylesheet" href="assets/css/swiper/swiper.css">
    <link rel="stylesheet" href="assets/css/lightgallery.min.css">
	<link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
	
	
	
	<?php
	session_start();
	
	$con= mysqli_connect('localhost','root','','registration');
	mysqli_select_db($con, 'registration');
	
	$name = isset($_POST['user']) ? $_POST['user'] : '';
	$pass = isset($_POST['password']) ? $_POST['password'] : '';
	//$name = $_POST['user'];
	//$pass = $_POST['password'];  
	
	$s = "select * from usertable where name = '$name'";
	
	
	$result= mysqli_query($con, $s);
	$num = mysqli_num_rows($result);
	//echo print_r($result);
	
	if($num == 1){
		//echo "Usename Already Taken";
		
	}else{
		$reg = "insert into usertable(name,password) values ('$name','$pass')";
		mysqli_query($con, $reg);
		echo '<script>alert("Înregistrare reușită")</script>';
		
		}
	
	
	?>
	
	
	
	
</head>
	
	
	
<body>
	
    <div class="css-loader">
        <div class="loader-inner line-scale d-flex align-items-center justify-content-center"></div>
    </div>
	
<div id="id01" class="modal">
  <form class="modal-content animate" action="validation.php" method="post">
    <div class="imgcontainer" >
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
	  
    </div>
	
    <div class="container">
	
      <label for="uname"><b>Nume de utilizator</b></label>
      <input type="text" placeholder="Introduceți numele de utilizator" name="user" required>

      <label for="psw"><b>Parola</b></label>
      <input type="password" placeholder="Introduceți parola" name="password" required>
        
      <button type="submit">Autentificare</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Ține-mă minte
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button> 
   
	  <span class="psw">Ați uitat <a href="#">parola?</a></span>
	  
    </div>
  </form>
</div>
<div id="id02" class="modal">
  <form class="modal-content animate" action="home.php" method="post">
    <div class="imgcontainer" >
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
	  
    </div>
	
    <div class="container">
	
      <label for="uname"><b>Nume de utilizator</b></label>
      <input type="text" placeholder="Introduceți numele de utilizator" name="user" required>

      <label for="psw"><b>Parola</b></label>
      <input type="password" placeholder="Introduceți parola" name="password" required>
	  
	  <input type="hidden" name="form2submission" value="yes" >
        
      <button type="submit">Înregistrare</button>
      
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Anulare</button> 
	 
    </div>
  </form>
</div>



<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
var modal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
    <section class="hero">
        <div class="container">
			<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" >Autentificare</button>
			<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;" >Înregistrare</button>
            <div class="row">
                <div class="col-12 offset-md-1 col-md-11">
                    <div class="swiper-container hero-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide slide-content d-flex align-items-center">
                                <div class="single-slide">
                                    <h1 data-aos="fade-right" data-aos-delay="200">Design with style,<br>Design with smile
                                    </h1>
                                </div>
                            </div>
                            <div class="swiper-slide slide-content d-flex align-items-center">
                                <div class="single-slide">
                                    <h1 data-aos="fade-right" data-aos-delay="200">
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="texture"></div>
        <div class="diag-bg"></div>
    </section>
	<section style="background-color:#e6e6e6">
        <div class="container">
		 <div class="title"><h5 class="title-primary">Top cele mai cumparate produse</h5></div><br></br>
            <div class="row">
	<?php
	
						require_once("dbcontroller.php");
						$db_handle = new DBController();
						$product_array = $db_handle->runQuery("select * from produse where cumparari=(select max(cumparari) from produse)");
						if (!empty($product_array)) { 
							foreach($product_array as $key=>$value){
						?>
						<table>
						<form method="post" action="home.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
							<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
								<div class="full product">
									<div class="product_img">
										<div class="center"> <img src="<?php echo $product_array[$key]["product_image"]; ?>" alt="#"/>
										<div class="overlay_hover"> </div>
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
    </section>
    <section class="services">
        <div class="container">
             <section class="section background-white">
            <div class="s-12 m-12 l-4 center">
              <h4 class="text-size-20 margin-bottom-20 text-dark text-center">Contactează-ne</h4>
              <form class="customform"  method="post" action ="form.php">
                <div class="s-12">
                  <div class="margin">
                    <div class="s-12 m-12 l-6">
                      <input name="email" class="required email" placeholder="E-mail" title="Your e-mail" type="text">
                      <p class="email-error form-error">Introduceți e-mailul</p>
					  
                    </div>
					
                    <div class="s-12 m-12 l-6">
                      <input name="name" class="name" placeholder="Nume" title="Your name" type="text">
                      <p class="name-error form-error">Introduceți numele</p>
                    </div>
                  </div>
                </div>
                <div class="s-12"> 
                  <input name="subject" class="subject" placeholder="Subiect" title="Subject" type="text">
                  <p class="subject-error form-error">Introduceți subiectul</p>
                </div>
                <div class="s-12">
                  <textarea name="message" class="required message" placeholder="Mesajul dumneavoastră" rows="3"></textarea>
                  <p class="message-error form-error">Introduceți mesajul</p>
                </div>
                <div class="s-12"><button class="s-12 submit-form button background-primary text-white" name="send" type="submit">Trimite</button></div>
              </form>
            </div>           
          </section> 
        </article>
      </main>
        </div>
    </section>
   
    
    
        
        
      <footer>
        <div class="background-dark padding text-center footer-social">
          <a class="margin-right-10" target="_blank" href="https://www.facebook.com"><span class="text-strong text-white hide-s hide-m">FACEBOOK   </span></a>
          <a class="margin-right-10" target="_blank" href="https://www.twitter.com"> <span class="text-strong text-white hide-s hide-m">TWITTER  </span></a>
          <a class="margin-right-10" target="_blank" href="https://www.instagram.com"> <span class="text-strong text-white hide-s hide-m">INSTAGRAM  </span></a>                                                                       
        </div>
        <section class="section-small-padding text-center background-dark full-width" >
          <div class="line">
            <div class="margin">           
              <div class="s-12 m-12 l-4 margin-m-bottom-30">
                <h3 class="text-size-16">Adresa companiei</h3>
                <p class="text-size-14">
                   Strada Daliei nr.2<br>
                   Bucuresti,Romania
                </p>               
              </div>
              <div class="s-12 m-12 l-4 margin-m-bottom-30">
                <h3 class="text-size-16">E-mail</h3>
                <p class="text-size-14">
                   iasmina.covaci00@e-uvt.ro<br>
                </p>              
              </div>
              <div class="s-12 m-12 l-4 ">
                <h3 class="text-size-16">Numere de telefon</h3>
                <p class="text-size-14">
                   0733803886<br>
                   
                </p>             
              </div>
            </div>
          </div>  
        </section>
        <hr class="break margin-top-bottom-0" style="border-color: rgba(0, 0, 0, 0.80);">
        
        <section class="padding background-dark full-width">
          <div class="text-center">
            <p class="text-size-12">Copyright 2020, Vision Design </p>
            <p class="text-size-12"></p>
          </div>
        </section>
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