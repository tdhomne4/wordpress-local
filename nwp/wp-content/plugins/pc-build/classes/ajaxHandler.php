<?php

/**
 * Ajaxhandler
 */
class PcBuildAjaxhandler
{
	
	public function __construct() {

		add_action('wp_ajax_pc_build_datatable', array( $this, 'datatables_server_side_callback'));
		add_action('wp_ajax_nopriv_pc_build_datatable', array( $this, 'datatables_server_side_callback'));

		add_action('wp_ajax_redirect_ajax_url', array( $this, 'data_redirect_ajax_url'));
		add_action('wp_ajax_nopriv_redirect_ajax_url', array( $this, 'data_redirect_ajax_url'));

		add_action('wp_ajax_remove_cookie_js', array( $this, 'data_remove_cookie_js'));
		add_action('wp_ajax_nopriv_remove_cookie_js', array( $this, 'data_remove_cookie_js'));

		add_action('wp_ajax_mail_js', array( $this, 'data_mail_js'));
		add_action('wp_ajax_nopriv_mail_js', array( $this, 'data_mail_js'));
	}

	// Datatable Ajax Content
	public function datatables_server_side_callback() {

		header("Content-Type: application/json");

		$draw = $_POST['draw'];
		$row = $_POST['start'];
		$rowperpage = $_POST['length']; // Rows display per page
		$columnIndex = $_POST['order'][0]['column']; // Column index
		$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = $_POST['search']['value']; // Search value
		$order_arr = array();

		## Custom Field value
		$title = $_POST['title'];
		$minprice = $_POST['minprice'];
		$maxprice = $_POST['maxprice'];
		$rating = $_POST['rating'];
		$term_slug = $_POST['term_slug'];
		$processor = $_POST['processor'];
		$brand_filter = $_POST['brand_filter'];
		$empty_processor = $_POST['empty_processor'];

		$args = array(
			'post_type' => 'pc_product',
			'post_status' => 'publish',
			'tax_query' => array( // NOTE: array of arrays!
		        array(
		            'taxonomy' => 'pc_product_category',
		            'field'    => 'slug',
		            'terms'    => $term_slug
		        )
		    ),
			'posts_per_page' => $rowperpage,
			'offset' => $row,
			'order' => $columnSortOrder,
		);
		if($columnIndex >= 1){
			$meta_val_key = '';
			if($columnIndex == 1){
				$meta_val_key = 'prod_title';
			}else if($columnIndex == 2){
				$meta_val_key = 'rating';
			}else if($columnIndex == 3){
				$meta_val_key = 'brand';
			}else if($columnIndex == 4){
				$meta_val_key = 'price';
			}
			$args['meta_key'] = $meta_val_key;
			$args['orderby'] = 'meta_value_num';
		}
		if(!empty($empty_processor) && $term_slug == 'motherboard'){
			$args['meta_query'] = array(
				'relation' => 'AND',
				array(
				  'key' => $processor,
				  'value' => $processor,
				  'compare' => 'LIKE'
				),
			);

			$meta_arr = array(
						  'key' => $processor,
						  'value' => $processor,
						  'compare' => 'LIKE'
						);
		}else{
			$meta_arr = '';
		}
		if($minprice == 0 ){
			$minprice = 1;
		}

		if(!empty($minprice) && !empty($maxprice) && !empty($brand_filter) && !empty($rating)){
			$args['meta_query'] = array(
				'relation' => 'AND',
				array( 
					'key'      => 'price',
					'value'    =>  array($minprice,$maxprice),
					'type'     => 'numeric',
					'compare'  => 'between'
				),
				array(
				  'key' => 'brand',
				  'value' => $brand_filter,
				  'compare' => 'IN'
				),
				array(
				  'key' => 'rating',
				  'value' => $rating,
				  'compare' => 'AND'
				),
				$meta_arr
			);
		}else if(!empty($minprice) && !empty($maxprice) && !empty($brand_filter)){
			$args['meta_query'] = array(
				'relation' => 'AND',
				array( 
					'key'      => 'price',
					'value'    =>  array($minprice,$maxprice),
					'type'     => 'numeric',
					'compare'  => 'between'
				),
				array(
				  'key' => 'brand',
				  'value' => $brand_filter,
				  'compare' => 'IN'
				),
				$meta_arr
			);
		}else if(!empty($minprice) && !empty($maxprice) && !empty($rating)){
			$args['meta_query'] = array(
				'relation' => 'AND',
				array( 
					'key'      => 'price',
					'value'    =>  array($minprice,$maxprice),
					'type'     => 'numeric',
					'compare'  => 'between'
				),
				array(
				  'key' => 'rating',
				  'value' => $rating,
				  'compare' => 'AND'
				),
				$meta_arr
			);
		}else if(!empty($brand_filter) && !empty($rating)){
			$args['meta_query'] = array(
				'relation' => 'AND',
				array(
				  'key' => 'brand',
				  'value' => $brand_filter,
				  'compare' => 'IN'
				),
				array(
				  'key' => 'rating',
				  'value' => $rating,
				  'compare' => 'AND'
				),
				$meta_arr
			);
		}else if(!empty($minprice) && !empty($maxprice)){
			$args['meta_query'] = array(
				'relation' => 'AND',
				array( 
					'key'      => 'price',
					'value'    =>  array($minprice,$maxprice),
					'type'     => 'numeric',
					'compare'  => 'between'
				),
				$meta_arr
			);
		}else if(!empty($brand_filter)){
			$args['meta_query'] = array(
				'relation' => 'AND',
				array(
				  'key' => 'brand',
				  'value' => $brand_filter,
				  'compare' => 'IN'
				),
				$meta_arr
			);
		}else if(!empty($rating)){
			$args['meta_query'] = array(
				'relation' => 'AND',
				array(
				  'key' => 'rating',
				  'value' => $rating,
				  'compare' => 'AND'
				),
				$meta_arr
			);
		}

		if($searchValue != ''){ // When datatables search is used

			$args['meta_query'] = array(
				'relation' => 'AND',
				array(
				  'key' => 'prod_title',
				  'value' => $searchValue,
				  'compare' => 'LIKE'
				),
				$meta_arr
			);
		}

		$product_query = new WP_Query($args);
		$totalRecords = $product_query->found_posts;

		if($processor == 'intel'){
			$permalink = get_permalink( get_option( 'intel_page_id' ) );
		}else if($processor == 'amd'){
			$permalink = get_permalink( get_option( 'amd_page_id' ) );
		}

		if ( $product_query->have_posts() ) {
			while ( $product_query->have_posts() ) {

				$product_query->the_post();
				if(empty(get_post_meta(get_the_ID(), 'price', TRUE))){
					wp_delete_post(get_the_ID(), true);
				}

				$rating_star = get_post_meta(get_the_ID(), 'rating', TRUE);
				$star = '';
				if($rating_star == 0){
					$star = '0';
				}else{
					for ($i=1; $i <= $rating_star; $i++) { 
						$star .= '<i class="fa fa-star" aria-hidden="true"></i>';
					}
				}

				$nestedData = array();
				$nestedData[] = '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' )[0].'">';
				$nestedData[] = get_the_title();
				$nestedData[] = $star;
				$nestedData[] = get_post_meta(get_the_ID(), 'brand', TRUE);
				$nestedData[] = '$'.get_post_meta(get_the_ID(), 'price', TRUE);
				$nestedData[] = '<a target="_blank" class="category_btn" data-product-id='.get_the_ID().' rel="nofollow" data-href='.$permalink.'>SELECT</a>';

				$data[] = $nestedData;

			}

			wp_reset_query();

			$response = array(
				"draw" => intval($draw),
				"iTotalRecords" => intval($totalRecords),
				"iTotalDisplayRecords" => intval($totalRecords),
				"aaData" => $data
			);

			echo json_encode($response);

		} else {

			$response = array(
				"data" => array()
			);

			echo json_encode($response);

		}

		wp_die();

	}

	// Redirect from table page
	public function data_redirect_ajax_url(){
		$user = wp_get_current_user();
		$user_id = $user->ID;
		$cookie_value = $_POST['term_slug'].'_'.$_POST['prod_id'];
		if($_POST['term_slug'] == 'ram' || $_POST['term_slug'] == 'ssd' || $_POST['term_slug'] == 'hdd'){
			$ram_arr = array();
			$meta_value = $_COOKIE[$_POST['processor'].'-'.$_POST['term_slug']];
			if (empty($meta_value)){
				$cookie_name = $_POST['processor'].'-'.$_POST['term_slug'];
				$ram_arr[] = $cookie_value;
				setcookie($cookie_name, json_encode($ram_arr), (time()+3600), "/");
			}else{
				$cookie_name = $_POST['processor'].'-'.$_POST['term_slug'];
				$cookie_val_slash_rm = stripslashes($meta_value);    // string is stored with escape double quotes 
				$cookie_val_arr = json_decode($cookie_val_slash_rm, true);
				$cookie_val_arr[] = $cookie_value;
				setcookie($cookie_name, json_encode($cookie_val_arr), (time()+3600), "/");
			}
		}else{
			$cookie_name = $_POST['processor'].'-'.$_POST['term_slug'];
			setcookie($cookie_name, $cookie_value, (time()+3600), "/");
		}
		echo json_encode($_POST);
		wp_die();
	}

	// Remove cookie value
	public function data_remove_cookie_js(){
		$remove_key = $_POST['remove_key'];
		if (strpos($remove_key, 'ram') !== false || strpos($remove_key, 'ssd') !== false || strpos($remove_key, 'hdd') !== false) {
			$meta_value = $_COOKIE[$remove_key];
			$remove_value = explode('-',$remove_key);
			$val = $remove_value[1];
			$del_val = $val."_".$_POST['remove_id'];
			$cookie_val_slash_rm = stripslashes($meta_value);    // string is stored with escape double quotes 
			$cookie_val_arr = json_decode($cookie_val_slash_rm, true);
			$cookie_val = array_diff($cookie_val_arr, array($del_val));
			setcookie($remove_key, json_encode($cookie_val), (time()+3600), "/");
		}else{
			unset($_COOKIE[$remove_key]);
			setcookie($remove_key, '', (time()-3600), "/");
		}
		echo "success";
		wp_die();
	}

	// Mail Function
	public function data_mail_js(){
		$message ='';
		$table = stripslashes($_POST['mail_table']);
		$email = $_POST['mail_email'];
		$subject = 'Pc Builder';
		$message .= '<html><body></p>Hi Folks,</p>';
		$message .= '<p>Thanks for selecting products from pcbuilder.net .</p>';
		$message .= '<p>Here is your best selected products which you can order by single click.</p>';
		$message .= $table;
		$message .= '</body></html>';
		$headers = array('Content-Type: text/html; charset=UTF-8','From: Pc Builder <pcbuilder@example.com>');
		$mailSend = wp_mail($email, $subject, $message,$headers);
		if($mailSend){
			echo "send";
		}else{
			echo "not send";
		}
		wp_die();
	}

}
new PcBuildAjaxhandler();