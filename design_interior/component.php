<?php


function component($name, $price, $img){
    $element = "
     <div class=\"col-xl-4 col-lg-4 col-md-6 col-sm-12\">
        <div class=\"full product\">
          <div class=\"product_img\">
            <div class=\"center\"> <img src=\"$img\" alt=\"#\"/>
              <div class=\"cart-action\"><input type=\"text\" class=\"product-quantity\" name=\"quantity\" value=\"1\" size=\"2\" /><input type=\"submit\" value=\"Adaugă în coș\" class=\"btnAddAction\" /></div>
            </div>
          </div>
          <div class=\"product_detail text_align_center\">
            <p class=\"product_price\">$price RON</p>
            <p class=\"product_descr\">$name</p>
          </div>
        </div>
      </div>
	  
	  
		
    ";
    echo $element;
}

?>
