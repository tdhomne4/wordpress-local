<?php /*
    Plugin Name: Api Plugin
    Plugin URI: https://www.enovathemes.com
    Description:  Api Plugin Tutorials
    Author: Enovathemes
    Version: 1.0
    Author URI: http://enovathemes.com
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;

}




function envato_register_rest_fields(){
 
	register_rest_field('tutorial',
			'tutorial_category_attr',
			array(
					'get_callback'    => 'envato_tutorial_categories',
					'update_callback' => null,
					'schema'          => null
			)
	);

	register_rest_field('tutorial',
			'tutorial_tag_attr',
			array(
					'get_callback'    => 'envato_tutorial_tags',
					'update_callback' => null,
					'schema'          => null
			)
	);

	register_rest_field('tutorial',
			'tutorial_image_src',
			array(
					'get_callback'    => 'envato_tutorial_image',
					'update_callback' => null,
					'schema'          => null
			)
	);

}
add_action('rest_api_init','envato_register_rest_fields');


function envato_tutorial_categories($object,$field_name,$request){
	$terms_result = array();
	$terms =  wp_get_post_terms( $object['id'], 'tutorial-category');
	foreach ($terms as $term) {
			$terms_result[$term->term_id] = array($term->name,get_term_link($term->term_id));
	}
	return $terms_result;
}

function envato_tutorial_tags($object,$field_name,$request){
	$terms_result = array();
	$terms =  wp_get_post_terms( $object['id'], 'tutorial-tag');
	foreach ($terms as $term) {
			$terms_result[$term->term_id] = array($term->name,get_term_link($term->term_id));
	}
	return $terms_result;
}

function envato_tutorial_image($object,$field_name,$request){

	$img = wp_get_attachment_image_src($object['featured_media'],'full');
	 
	return $img[0];
}



function envato_styles_scripts(){
	wp_enqueue_style( 'tuts', plugins_url('/css/tuts.css', __FILE__ ));
	wp_register_script( 'tuts', plugins_url('/js/tuts.js', __FILE__ ), array('jquery'), '', true);
	wp_localize_script( 
    'tuts', 
    'tuts_opt', 
    array('jsonUrl' => rest_url('wp/v2/tutorial'))
);
}
add_action( 'wp_enqueue_scripts', 'envato_styles_scripts' );




function envato_tutorial_shortcode_callback($atts, $content = null) {
	extract(shortcode_atts(
			array(
					'layout'     => 'grid', // grid / list
					'per_page'   => '3',     // int number
					'start_cat'  => '',  // starting category ID
			), $atts)
	);

	global $post;

	$query_options = array(
			'post_type'           => 'tutorial',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'orderby'             => 'date',
			'order'               => 'DESC',
			'posts_per_page'      => absint($per_page) 
	);

	if (isset($start_cat) & !empty($start_cat)) {

			$tax_query_array = array(
					'tax_query' => array(
					array(
							'taxonomy' => 'tutorial-category',
							'field'    => 'ID',
							'terms'    => $start_cat,
							'operator' => 'IN'
					))
			);

			$query_options = array_merge($query_options,$tax_query_array);
	}

	$tuts = new WP_Query($query_options);

	if($tuts->have_posts()){

			wp_enqueue_script('tuts');

			$output = '';
			$class  = array();

			$class[] = 'recent-tuts';
			$class[] = esc_attr($layout);

			$output .= '<div class="recent-tuts-wrapper">';

					$args = array(
							'orderby'           => 'name', 
							'order'             => 'ASC',
							'fields'            => 'all', 
							'child_of'          => 0, 
							'parent'            => 0,
							'hide_empty'        => true, 
							'hierarchical'      => false, 
							'pad_counts'        => false, 
					);

					$terms = get_terms('tutorial-category',$args);


					if (count($terms) != 0){
							$output .= '<div class="term-filter" data-per-page="'.absint($per_page).'">';

									if (empty($start_cat)) {
											$output .= '<a href="'.esc_url(get_post_type_archive_link('tutorial')).'" class="active">'.esc_html__('All','envato').'</a>';
									}

									foreach($terms as $term){

											$term_class = (isset($start_cat) && !empty($start_cat) && $start_cat == $term->term_id) ? $term->slug.' active' : $term->slug;
											$term_data  = array();

											$term_data[] = 'data-filter="'.$term->slug.'"';
											$term_data[] = 'data-filter-id="'.$term->term_id.'"';

											$output .= '<a href="'.esc_url(get_term_link($term->term_id, 'tutorial-category')).'" class="'.esc_attr($term_class).'" '.implode(' ', $term_data).'>'.$term->name.'</a>';
									}

							$output .= '</div>';
					}

					$output .= '<ul class="'.implode(' ', $class).'">';
							while ($tuts->have_posts() ) {
									$tuts->the_post();

									$IMAGE = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);

									$output .= '<li>';

											$output .= '<img src="'.esc_url($IMAGE[0]).'" alt="'.esc_attr(get_the_title()).'" />';

											$output .='<div class="tutorial-content">';

													$output .='<div class="tutorial-category">';
															$output .= get_the_term_list( get_the_ID(), 'tutorial-category', '', ', ', '' );
													$output .='</div>';

													if ( '' != get_the_title() ){
															$output .='<h4 class="tutorial-title entry-title">';
																	$output .= '<a href="'.get_the_permalink().'" title="'.get_the_title().'" rel="bookmark">';
																			$output .= get_the_title();
																	$output .= '</a>';
															$output .='</h4>';
													}

													if ( '' != get_the_excerpt() && $layout == 'grid'){
															$output .='<div class="tutorial-excerpt">';
																			$output .= get_the_excerpt();
															$output .='</div>';
													}

													$output .='<div class="tutorial-tag">';
															$output .= get_the_term_list( get_the_ID(), 'tutorial-tag', '', ' ', '' );
													$output .='</div>';

											$output .='</div>';

									$output .= '</li>';

							}
							wp_reset_postdata();
					$output .= '</ul>';

			$output .= '</div>';

			return $output;
	}
}
add_shortcode('tuts', 'envato_tutorial_shortcode_callback');