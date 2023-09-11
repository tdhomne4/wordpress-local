			<footer class="main_footer">
			<div class="container">
				<div class="footer-top white-box box-shadow mb-2">
					<div class="row">
						<div class="col-md-4 ftr_abtus text-center">
						<?php $image = get_field('image',8); ?>
                            <a class="ftr_logo d-inline-block" href="#"><img src="<?php echo $image?>" alt=""></a>
                            <div class="ftr_abt_desc mt-lg-4 mt-md-3 mt-2">
								<?php $text = get_field('text',8)?>
                            	<p class="mb-0"><?php echo $text ?></p>
                            </div>
						</div>

						<!--***********footer menus*********-->
						<div class="col-md-5 ftr_manus">
						<div class="ftr_infoLinks row">
							<!--first footer menu-->
						<?php 	wp_nav_menu(
							array(
									'menu' => 'footer-menu',
									'container'=>'ftr_infoLinks row',
									'items_wrap'=> '<ul class="info_links col-md-6">%3$s</ul>',
									)
							);
							?>
								<!--second footer menu-->
							<?php 	wp_nav_menu(
							array(
									'menu' => 'footer-second',
									'container'=>'ftr_infoLinks row',
									'items_wrap'=> '<ul class="info_links col-md-6">%3$s</ul>',
									)
							);
							?>
						
								
							</div><!--ftr_infoLinks row"-->
						</div><!--col-md-5 ftr_manus-->
					
						<div class="col-md-3 ftr_cont">
						<?php $text = get_field('contact_us',8); ?>
                             <h6><?php echo $text?></h6>
                             <div class="cont_info">
							 <?php $email = get_field('email',8); ?>
						<?php $phone = get_field('phone',8); ?>
                             	 <h5 class="call_info"><i class="fa fa-phone"></i><?php echo $phone?></h5>
                             	 <p class="mail_info"><a href="mailto:info@securi.com"><i class="fa fa-envelope"></i><?php echo $email?></a></p>
                             </div>
						</div>
					</div>
				</div>
				<div class="footer-btm text-center py-md-3 py-2">
				<?php $footer_text = get_field('footer_text',8); ?>
					<p class="mb-0"><?php echo $footer_text?></p>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>

<!-- get tips checkbox price value-->
<script>

// function getValue(value){
// 	var custom_p_id = jQuery('#custom_p_id').val();
// 	var custom_p_price = jQuery('#custom_p_price').val();
// 	// var price = parseInt(value.replace('$','')) + custom_p_price;
// 	 var custom_price = parseInt(value);
// 	 var regular_price = parseInt(custom_p_price);
// 	 var total_price = custom_price+regular_price; // should now alert 20


// 	jQuery(".price").html('<bdi>'+total_price+'<span class="woocommerce-Price-currencySymbol">$</span></bdi>');

// 	jQuery.ajax
//     ({
//        url : 'http://localhost/nwp/wp-admin/admin-ajax.php',
//        type :'post',
//        data : { value : value,custom_p_id : custom_p_id, action: "get_custom_price"},
//        success: function(data)
//        {
//          alert(data);
//         }
//      }); //ajax close
// }

jQuery(document).ready(function(e) {
	e.preventDefault();
	jQuery("input[name='five-doller']").change(function(){
		var value = jQuery(this).val();
		alert(value);
		//var custom_p_id = jQuery('#custom_p_id').val();
		//var custom_p_price = jQuery('#custom_p_price').val();
		// var price = parseInt(value.replace('$','')) + custom_p_price;
	 	//var custom_price = parseInt(value);
	 	//var regular_price = parseInt(custom_p_price);
	 	//var total_price = custom_price+regular_price; // should now alert 20


		//jQuery(".price").html('<bdi>'+total_price+'<span class="woocommerce-Price-currencySymbol">$</span></bdi>');

		jQuery.ajax
    	({
      	 	url : 'http://localhost/nwp/wp-admin/admin-ajax.php',
       		type :'post',
       		data : { value : value, action: "get_custom_price"},
       		success: function(data)
       		{
         		//alert(data);
        	}
     	}); //ajax close

	});
});
	
</script>
  
	</body>
</html>

						   	   	  	
					