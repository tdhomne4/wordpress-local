<?php 
/**
 * Plugin Name: Read Me Later
 * Plugin URI: https://github.com/iamsayed/read-me-later
 * Description: This plugin allow you to add blog posts in read me later lists using Ajax
 * Version: 1.0.0
 * Author: Sayed Rahman
 * Author URI: https://github.com/iamsayed/
 * License: GPL3
 */

class ReadMeLater {
/*
 * Action hooks
 */
public function run() {     
    // Enqueue plugin styles and scripts
    add_action( 'plugin_loaded', array( $this, 'enqueue_rml_scripts' ) );
    add_action( 'plugin_loaded', array( $this, 'enqueue_rml_styles' ) );      
}   
/**
 * Register plugin styles and scripts
 */
public function register_rml_scripts() {
    wp_register_script( 'rml-script', plugins_url( 'js/read-me-later.js', __FILE__ ), array('jquery'), null, true );
    wp_register_style( 'rml-style', plugins_url( 'css/read-me-later.css' ) );
}   
/**
 * Enqueues plugin-specific scripts.
 */
public function enqueue_rml_scripts() {        
    wp_enqueue_script( 'rml-script' );
    wp_localize_script( 'rml-script', 'readmelater_ajax', array( 'ajax_url' => admin_url('admin-ajax.php')) );
}   
/**
 * Enqueues plugin-specific styles.
 */
public function enqueue_rml_styles() {         
    wp_enqueue_style( 'rml-style' ); 
}

/**
 * Hook into wp_ajax_ to save post ids, then display those posts using get_posts() function
 */
public function read_me_later() {
 
    $rml_post_id = $_POST['post_id'];
   
    $echo = array();

    if( get_user_meta( wp_get_current_user()->ID, 'rml_post_ids', true ) != null ) {
        $value = get_user_meta( wp_get_current_user()->ID, 'rml_post_ids', true );
    }

    if( $value ) {
        $echo = $value;
        array_push( $echo, $rml_post_id );
    }
    else {
        $echo = array( $rml_post_id );
    }

    update_user_meta( wp_get_current_user()->ID, 'rml_post_ids', $echo );
    $ids = get_user_meta( wp_get_current_user()->ID, 'rml_post_ids', true );

    // Query read me later posts
    $args = array( 
        'post_type' => 'casestudy',
        'orderby' => 'DESC', 
        'posts_per_page' => -1, 
        'numberposts' => -1,
        'post__in' => $ids
    );

    $rmlposts = get_posts( $args );
    if( $ids ) :
        global $post;
        foreach ( $rmlposts as $post ) :
            setup_postdata( $post );
            $img = wp_get_attachment_image_src( get_post_thumbnail_id() ); 
        ?>          
            <div class="rml_posts">                 
                <div class="rml_post_content">
                    <h5><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    <p><?php the_excerpt(); ?></p>
                </div>
                <img src="<?php echo $img[0]; ?>" alt="<?php echo get_the_title(); ?>" class="rml_img">                    
            </div>
        <?php 
        endforeach; 
        wp_reset_postdata(); 
    endif;      

    // Always die in functions echoing Ajax content
    die();

}   
}



 ?>