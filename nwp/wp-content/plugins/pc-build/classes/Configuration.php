<?php

/**
 * Configuration
 */


class PcBuild { 

	public function __construct() {

		add_shortcode( 'pc_build', array( $this, 'pc_build_form' ) );

		add_action( 'init', array( $this, 'product_init' ) );

		// add_action( 'init', array( $this, 'amazon_product_fetch' ) );
		// add_action( 'amazon_product_fetch', array( $this, 'cron_amazon_product_fetch_a731e366' ) , 10, 1 );

		add_action("add_meta_boxes", array( $this, "add_custom_meta_box"));
		add_action("add_meta_boxes", array( $this, "add_filter_meta_box"));

		add_action('save_post', array($this, 'onPostSave') );

		if ( is_admin() ) {
			add_action ( 'admin_menu', array( $this, 'pc_build_menu' ) );
			add_action ( 'admin_init', array( $this, 'pc_build_register' ) );
		}

	}

	// Amazon Product Api Cron
	public function amazon_product_fetch($args){
		setcookie('cron_value', 'RAM', (time()+3600), "/");
		require_once plugin_dir_path( __FILE__ ) . '../api/amazonapi.php';
	}

	// Register Admin Settings
	public function pc_build_register() {

		register_setting ( 'pc-build-optiongroup', 'affiliate_key' );
		register_setting ( 'pc-build-optiongroup', 'amazon_key' );
		register_setting ( 'pc-build-optiongroup', 'secret_key' );
		register_setting ( 'pc-build-optiongroup', 'partner_tag' );

		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_cpu' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_motherboard' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_ram' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_ssd' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_hdd' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_gpu' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_cpu_cooler' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_psu' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_case' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_sound_card' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_display_monitor' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_odd' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_gaming_chair' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_gaming_headsets' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_keyboard' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_mouse' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_operating_system' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_desktop_printer' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_vr_headset' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_external_speaker' );
		register_setting ( 'pc-build-tooltip-optiongroup', 'pc_external_hard_drive' );

		register_setting ( 'pc-build-page-optiongroup', 'intel_page_id' );
		register_setting ( 'pc-build-page-optiongroup', 'amd_page_id' );

	}

	// Admin Menu And Submenu For Backend Settings 
	public function pc_build_menu() {

		add_menu_page(
			__('Pc Build Menu'),// the page title
			__('Pc Build Menu'),//menu title
			'edit_themes',//capability 
			'pc-build-settings',//menu slug/handle this is what you need!!!
			array( $this, 'pc_build_settings' ),//callback function
			'',//icon_url,
			8//position
		);

		add_submenu_page(
			'pc-build-settings',
			'Tooltip Menu', //page title
			'Tooltip Menu', //menu title
			'edit_themes', //capability,
			'pc-tooltip-setting',//menu slug
			array( $this, 'pc_tooltip_settings' ) //callback function
		);

		add_submenu_page(
			'pc-build-settings',
			'Pc Page Menu', //page title
			'Pc Page Menu', //menu title
			'edit_themes', //capability,
			'pc-page-menu',//menu slug
			array( $this, 'pc_page_menu' ) //callback function
		);

	}

	// Pc Build Credential Backend Setting
	public function pc_build_settings() {

		$adminUrl = admin_url( 'admin.php?page=pc-build-settings' );
		require_once plugin_dir_path( __FILE__ ) . '../inc/settings.php';

	}

	// Pc Build Tooltip Backend Setting
	public function pc_tooltip_settings() {

		$adminUrl = admin_url( 'admin.php?page=pc-tooltip-setting' );
		require_once plugin_dir_path( __FILE__ ) . '../inc/tooltip-settings.php';

	}

	// Pc Build Shortcode Page Backend Setting
	public function pc_page_menu() {

		$adminUrl = admin_url( 'admin.php?page=page-settings' );
		require_once plugin_dir_path( __FILE__ ) . '../inc/page-settings.php';
	}

	// Pc Build Template for Listing Page
	public function pc_build_form($atts){

		wp_register_style( 'pc_build_frontend_css', plugins_url( '../css/pc_build_frontend.css', __FILE__ ), '', time() );
		wp_enqueue_style( 'pc_build_frontend_css' );
		if (!wp_style_is( 'fontawesome', 'enqueued' )) {
			wp_register_style( 'Font_Awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
			wp_enqueue_style('Font_Awesome');
		}

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'remove_cookie_js', plugins_url( '../js/remove_cookie.js', __FILE__ ), array(), '1.0', true );
  		wp_localize_script( 'remove_cookie_js', 'remove_cookie_js', admin_url('admin-ajax.php?action=remove_cookie_js') );
  		wp_enqueue_script( 'remove_cookie_js' );
		wp_enqueue_script( 'mail_js', plugins_url( '../js/remove_cookie.js', __FILE__ ), array(), '1.0', true );
  		wp_localize_script( 'mail_js','mail_js', admin_url('admin-ajax.php?action=mail_js') );
  		wp_enqueue_script( 'mail_js' );

		ob_start();

		require_once plugin_dir_path( __FILE__ ) . '../templates/pc-listing.php';
		$html_code = ob_get_clean();

		return $html_code;

	}

	// Product Custom Post Type
	public function product_init() {
		// set up product labels
		$labels = array(
			'name' => 'Pc Products',
			'singular_name' => 'Pc Product',
			'add_new' => 'Add New Pc Product',
			'add_new_item' => 'Add New Pc Product',
			'edit_item' => 'Edit Pc Product',
			'new_item' => 'New Pc Product',
			'all_items' => 'All Pc Products',
			'view_item' => 'View Pc Product',
			'search_items' => 'Search Pc Products',
			'not_found' =>  'No Pc Products Found',
			'not_found_in_trash' => 'No Pc Products found in Trash', 
			'parent_item_colon' => '',
			'menu_name' => 'Pc Products',
		);

		// register post type
		$args = array(
			'labels' => $labels,
			'public' => true,
			'has_archive' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array('slug' => 'pc_product'),
			'query_var' => true,
			'menu_icon' => 'dashicons-randomize',
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'trackbacks',
				'custom-fields',
				'comments',
				'revisions',
				'thumbnail',
				'author',
				'page-attributes'
			)
		);
		register_post_type( 'pc_product', $args );

		// register taxonomy
		register_taxonomy('pc_product_category', 'pc_product', array('hierarchical' => true, 'label' => 'Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'pc-product-category' )));

		add_filter('template_include', array( $this, 'taxonomy_template'),12 );

	}

	// Product taxonomy template 
	public function taxonomy_template( $template ){

		if( is_tax('pc_product_category')){

			wp_register_style( 'pc_build_filter_css', plugins_url( '../css/pc_build_filter.css', __FILE__ ), '', time() );
			wp_enqueue_style( 'pc_build_filter_css' );

			// wp_register_style( 'Bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
			// wp_enqueue_style('Bootstrap_css');
			wp_register_style( 'Datatable_css', 'https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css' );
			wp_enqueue_style('Datatable_css');
			wp_register_style( 'Smoothness_css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css' );
			wp_enqueue_style('Smoothness_css');

			wp_enqueue_script( 'jquery' );
			wp_register_script( 'jquery_latest', 'https://code.jquery.com/jquery-3.6.0.min.js', null, null, true );
			wp_enqueue_script('jquery_latest');
			wp_register_script( 'jquery_ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', null, null, true );
			wp_enqueue_script('jquery_ui');
			wp_register_script( 'jquery_dt', 'https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js', null, null, true );
			wp_enqueue_script('jquery_dt');
			wp_register_script( 'jquery_boot_dt', 'https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js', null, null, true );
			wp_enqueue_script('jquery_boot_dt');

			wp_enqueue_script( 'pc_build_datatable', plugins_url( '../js/pc_build_frontend.js', __FILE__ ), array(), '1.0', true );
  			wp_localize_script( 'pc_build_datatable', 'ajax_url', admin_url('admin-ajax.php?action=pc_build_datatable') );
			wp_enqueue_script( 'redirect_ajax_url', plugins_url( '../js/pc_redirect_frontend.js', __FILE__ ), array(), '1.0', true );
  			wp_localize_script( 'redirect_ajax_url', 'redirect_ajax_url', admin_url('admin-ajax.php?action=redirect_ajax_url') );
			wp_enqueue_script( 'pc_build_frontend_js' );

			if (!wp_style_is( 'fontawesome', 'enqueued' )) {
				wp_register_style( 'Font_Awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
				wp_enqueue_style('Font_Awesome');
			}

			$template =  plugin_dir_path( __FILE__ ) . '../templates/taxonomy-pc_product_category.php';

		}

		return $template;

	}

	// Custom Meta Box For Processor
	public function add_custom_meta_box(){ add_meta_box("demo-meta-box", "Supported Processor", array( $this, "custom_meta_box_markup"), "pc_product", "side", "high", null); }

	// Custom Meta Box Callback Function
	public function custom_meta_box_markup($object){
		wp_nonce_field(basename(__FILE__), "meta-box-nonce");
		?>
			<div>
				<label for="meta-box-checkbox">Intel</label>
				<?php
				$intel_checkbox_value = get_post_meta($object->ID, "intel", true);

				if($intel_checkbox_value == ""){ ?>
					<input name="intel" type="checkbox" value="intel">
				<?php } else if($intel_checkbox_value == "intel") { ?>
					<input name="intel" type="checkbox" value="intel" checked>
				<?php } ?>
			</div>
			<div>
				<label for="meta-box-checkbox">Amd</label>
				<?php
				$amd_checkbox_value = get_post_meta($object->ID, "amd", true);

				if($amd_checkbox_value == ""){ ?>
					<input name="amd" type="checkbox" value="amd">
				<?php } else if($amd_checkbox_value == "amd") { ?>
					<input name="amd" type="checkbox" value="amd" checked>
				<?php } ?>
			</div>
		<?php
	}

	// Save Meta value on save Post
	public function onPostSave($post_id) {
		$intel_checkbox_value = "";
		$amd_checkbox_value = "";
		if(isset($_POST["intel"])){
			$intel_checkbox_value = $_POST["intel"];
		}
		update_post_meta($post_id, "intel", $intel_checkbox_value);

		if(isset($_POST["amd"])){
			$amd_checkbox_value = $_POST["amd"];
		}
		update_post_meta($post_id, "amd", $amd_checkbox_value);

		if(isset($_POST["asin"])){
			$asin_checkbox_value = $_POST["asin"];
		}
		update_post_meta($post_id, "asin", $asin_checkbox_value);

		if(isset($_POST["brand"])){
			$brand_checkbox_value = $_POST["brand"];
		}
		update_post_meta($post_id, "brand", $brand_checkbox_value);

		if(isset($_POST["price"])){
			$price_checkbox_value = $_POST["price"];
		}
		update_post_meta($post_id, "price", $price_checkbox_value);

		if(isset($_POST["rating"])){
			$rating_checkbox_value = $_POST["rating"];
		}
		update_post_meta($post_id, "rating", $rating_checkbox_value);
	}

	// Meta box for filter 
	public function add_filter_meta_box(){ add_meta_box("filter-meta-box", "Filter Box", array( $this, "filter_meta_box_markup"), "pc_product", "normal", "high", null); }

	// Meta box for filter callback function
	public function filter_meta_box_markup($object){
		wp_nonce_field(basename(__FILE__), "meta-box-nonce");
		?>
			<style type="text/css">
				.filter-margin{
					margin-bottom: 20px;
				}
				.filter-margin label{
					display: inline-block;
					width: 5%;
				}
			</style>
			<div class="filter-margin">
				<label for="meta-box-checkbox">Asin</label>
				<?php
				$asin_checkbox_value = get_post_meta($object->ID, "asin", true);

				if($asin_checkbox_value == ""){ ?>
					<input name="asin" type="text" value="">
				<?php } else { ?>
					<input name="asin" type="text" value="<?php echo $asin_checkbox_value; ?>">
				<?php } ?>
			</div>
			<div class="filter-margin">
				<label for="meta-box-checkbox">Brand</label>
				<?php
				$brand_checkbox_value = get_post_meta($object->ID, "brand", true);

				if($brand_checkbox_value == ""){ ?>
					<input name="brand" type="text" value="">
				<?php } else { ?>
					<input name="brand" type="text" value="<?php echo $brand_checkbox_value; ?>">
				<?php } ?>
			</div>
			<div class="filter-margin">
				<label for="meta-box-checkbox">Price</label>
				<?php
				$price_checkbox_value = get_post_meta($object->ID, "price", true);

				if($price_checkbox_value == ""){ ?>
					<input name="price" type="text" value="">
				<?php } else { ?>
					<input name="price" type="text" value="<?php echo $price_checkbox_value; ?>">
				<?php } ?>
			</div>
			<div class="filter-margin">
				<label for="meta-box-checkbox">Rating</label>
				<?php
				$rating_checkbox_value = get_post_meta($object->ID, "rating", true);

				if($rating_checkbox_value == ""){ ?>
					<input name="rating" type="text" value="">
				<?php } else { ?>
					<input name="rating" type="text" value="<?php echo $rating_checkbox_value; ?>">
				<?php } ?>
			</div>
		<?php
	}

}

new PcBuild();