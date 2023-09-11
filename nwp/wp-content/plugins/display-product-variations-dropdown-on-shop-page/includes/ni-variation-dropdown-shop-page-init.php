<?php 
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'Ni_Variation_Dropdown_Shop_Page_Init' ) ) {
	class Ni_Variation_Dropdown_Shop_Page_Init{
		 public function __construct(){
			
			add_action( 'admin_menu',  array(&$this,'admin_menu' ));
			add_action( 'admin_enqueue_scripts',  array(&$this,'admin_enqueue_scripts' )); 
			add_action( 'wp_ajax_niwoovd',  array(&$this,'ajax_niwoovd' )); /*used in form field name="action" value="my_action"*/
			
			add_action('wp_footer',  array(&$this,'wp_footer' ));
			
			$this->include_page();
		 }
		 function admin_menu(){
		 	add_menu_page(__(  'Variation Dropdown', 'niwoovd')
			,__(  'Variation Dropdown', 'niwoovd')
			,'manage_options'
			,'niwoovd-dashboard'
			,array(&$this,'add_page')
			,'dashicons-media-document'
			,61.96);
			add_submenu_page('niwoovd-dashboard'
			,__( 'Dashboard', 'niwoovd' )
			,__( 'Dashboard', 'niwoovd' )
			,'manage_options'
			,'niwoovd-dashboard' 
			,array(&$this,'add_page'));
			add_submenu_page('niwoovd-dashboard'
			,__( 'Setting', 'niwoovd' )
			,__( 'Setting', 'niwoovd' )
			, 'manage_options', 'niwoovd-setting' 
			, array(&$this,'add_page'));
		
		 }
		 function admin_enqueue_scripts(){
			 $page= sanitize_text_field(isset($_REQUEST["page"])?$_REQUEST["page"]:"");
			 if ($page =="niwoovd-setting" || $page  == "niwoovd-dashboard"){
					wp_register_style('niwoovd-bootstrap-css', plugins_url('../admin/css/lib/bootstrap.min.css', __FILE__ ));
					wp_enqueue_style('niwoovd-bootstrap-css' );
					
					wp_enqueue_script('niwoovd-bootstrap-script', plugins_url( '../admin/js/lib/bootstrap.min.js', __FILE__ ));
					wp_enqueue_script('niwoovd-popper-script', plugins_url( '../admin/js/lib/popper.min.js', __FILE__ ));
				 
			 		wp_register_style('niwoovd-style', plugins_url('../admin/css/niwoovd-style.css', __FILE__ ));
			 		wp_enqueue_style('niwoovd-style' );
			 }
			 
				
			 if ($page =="niwoovd-setting"){
				 	
					wp_register_script( 'niwoovd-setting-script', plugins_url( '../admin/js/niwoovd-setting.js', __FILE__ ) );
					wp_enqueue_script('niwoovd-setting-script');
				 
				 
				wp_enqueue_script( 'niwoovd-script', plugins_url( '../admin/js/script.js', __FILE__ ), array('jquery') );
				wp_localize_script( 'niwoovd-script','niwoovd_ajax_object',array('niwoovd_ajaxurl'=>admin_url('admin-ajax.php')));
			 }
			 if ($page  == "niwoovd-dashboard") {
					wp_register_style( 'niwoovd-font-awesome-css', plugins_url( '../admin/css/font-awesome.css', __FILE__ ));
		 			wp_enqueue_style( 'niwoovd-font-awesome-css' );
					
					wp_register_script( 'niwoovd-amcharts-script', plugins_url( '../admin/js/amcharts/amcharts.js', __FILE__ ) );
					wp_enqueue_script('niwoovd-amcharts-script');
				
		
					wp_register_script( 'niwoovd-light-script', plugins_url( '../admin/js/amcharts/light.js', __FILE__ ) );
					wp_enqueue_script('niwoovd-light-script');
				
					wp_register_script( 'niwoovd-pie-script', plugins_url( '../admin/js/amcharts/pie.js', __FILE__ ) );
					wp_enqueue_script('niwoovd-pie-script');
			}
		 	
		 }
		 function add_page(){
			$page= sanitize_text_field(isset($_REQUEST["page"])?$_REQUEST["page"]:"");
		 	if($page == "niwoovd-dashboard"){
					include_once("ni-variation-dropdown-dashboard.php");
				$obj =  new  Ni_Variation_Dropdown_Dashboard();
				$obj->page_init();
			}
			if($page == "niwoovd-setting"){
				include_once("ni-variation-dropdown-setting.php");
				$obj =  new  Ni_Variation_Dropdown_Setting();
				$obj->page_init();
			}
		 }
		 function include_page(){
			 include_once("ni-variation-dropdown-hook.php");
			 $objhook = new Ni_Variation_Dropdown_Hook();
		 }
		 function ajax_niwoovd(){
		 	 $sub_action= sanitize_text_field(isset($_REQUEST["sub_action"])?$_REQUEST["sub_action"]:"");
			 if($sub_action =="niwoovd_setting"){
				 include_once("ni-variation-dropdown-setting.php");
				$obj =  new  Ni_Variation_Dropdown_Setting();
				$obj->ajax_init();
			 }die;
			 	
		 }
		 function wp_footer(){
		 	 if( is_shop() || is_product_category()) :
			  $niwoovd_setting =  get_option("niwoovd_setting",array());
			   $show_variation_description = sanitize_text_field(isset($niwoovd_setting["show_variation_description"])?$niwoovd_setting["show_variation_description"]:"no");
			   $maximum_description = sanitize_text_field(isset($niwoovd_setting["maximum_description"])?$niwoovd_setting["maximum_description"]:0);
		
			 ?>
             	<script>
                  jQuery(document).ready(function($){
					  	var show_variation_description = '<?php esc_html_e( $show_variation_description ); ?>';
					  	var maximum_description = ' <?php esc_html_e( $maximum_description ); ?>';
						$( ".single_variation_wrap" ).on( "show_variation", function ( event, variation ) {
							var niwoovd_variation_description  = '';
							niwoovd_variation_description = variation.variation_description;
							if ( $.trim( show_variation_description)  =='no'){
							
								$('.woocommerce-variation-description p').css('display','none');
							}else{
								$('.woocommerce-variation-description p').css('display','block');
								if (maximum_description > 0){
									niwoovd_variation_description = niwoovd_variation_description.split(/\s+/).slice(0,maximum_description).join(" ")
								}else{
									$('.woocommerce-variation-description').html('<p>'+niwoovd_variation_description+'</p>');
								}
								$('.woocommerce-variation-description').html(niwoovd_variation_description);
							}
						});
				  });
                </script>
            <?php
			endif ;
		 }
	}	
}
?>