<?php 
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'Ni_Variation_Dropdown_Hook' ) ) {
	class Ni_Variation_Dropdown_Hook{
		 public function __construct(){
			
			add_action( 'woocommerce_before_shop_loop',  array($this,'nivariation_woocommerce_before_shop_loop'),110 );
			add_filter( 'woocommerce_dropdown_variation_attribute_options_args',  array($this,'nivariation_variation_attribute_options_args'), 10 );
			add_action( 'woocommerce_product_options_inventory_product_data', array($this,'woocommerce_product_custom_fields') ); 
			add_action('woocommerce_process_product_meta',  array($this,'woocommerce_product_custom_fields_save'));
			
		 }
		 function nivariation_variation_attribute_options_args( $args ) {
			 global $product;
			 //error_log( json_encode($args["product"]));
			 
			 //print_r($args["product"]->get_id());
			 $niwoovd_setting = array();
			
			 	$niwoovd_setting =  get_option("niwoovd_setting",array());
				$variation_text = sanitize_text_field(isset($niwoovd_setting["variation_text"])?$niwoovd_setting["variation_text"]:"default_text");
				if ($variation_text =='custom_text'){
					$product_id = $args["product"]->get_id();
					$custom_text = get_post_meta($product_id,"_variation_option_custom_text",true);
					if (!empty(trim($custom_text)) && trim($custom_text) != "" )
					$args['show_option_none'] =$custom_text;	
				}
				if ($variation_text =='variation_attribute'){
					$var_tax = get_taxonomy( $args['attribute'] );
					if(isset($var_tax->labels->name)){
						 $args['show_option_none'] = apply_filters( 'the_title', $var_tax->labels->name );
					}
				}

			  
		 	 			
			
			return $args;
		}	
		function nivariation_woocommerce_before_shop_loop() {
			$niwoovd_setting =  get_option("niwoovd_setting",array());
		 	$enable_variation_dropdown = sanitize_text_field(isset($niwoovd_setting["enable_variation_dropdown"])?$niwoovd_setting["enable_variation_dropdown"]:"no");
			if ($enable_variation_dropdown  =="yes"){
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
				add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_add_to_cart', 30 );
			}
		}
		function woocommerce_product_custom_fields(){
			global $woocommerce, $post,  $product;
			
			echo '<div class="show_if_variable">';
				woocommerce_wp_text_input(
				  array(
					'id'          => '_variation_option_custom_text',
					'label'       => __( 'Variation option text', 'woocommerce' ),
					'placeholder' => 'Variation option custom text',
					'desc_tip'    => 'true'
				  )
				);

			echo '</div>';

		}
		function woocommerce_product_custom_fields_save($post_id){
			// Variation option custom text
			$variation_option_custom_text = $_POST['_variation_option_custom_text'];
			if (!empty($variation_option_custom_text))
				update_post_meta($post_id, '_variation_option_custom_text', absint($variation_option_custom_text));
		}
	}	
}
?>