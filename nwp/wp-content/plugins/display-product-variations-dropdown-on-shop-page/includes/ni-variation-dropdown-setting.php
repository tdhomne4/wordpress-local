<?php 
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'Ni_Variation_Dropdown_Setting' ) ) {
	class Ni_Variation_Dropdown_Setting{
		 public function __construct(){
		 }
		 function page_init(){
		 $niwoovd_setting = array();	 
		 $niwoovd_setting =  get_option("niwoovd_setting",array());
		 
		 $enable_variation_dropdown = sanitize_text_field(isset($niwoovd_setting["enable_variation_dropdown"])?$niwoovd_setting["enable_variation_dropdown"]:"no");
		 $show_variation_description = sanitize_text_field(isset($niwoovd_setting["show_variation_description"])?$niwoovd_setting["show_variation_description"]:"no");
		$maximum_description = sanitize_text_field(isset($niwoovd_setting["maximum_description"])?$niwoovd_setting["maximum_description"]:0);
		$variation_text = sanitize_text_field(isset($niwoovd_setting["variation_text"])?$niwoovd_setting["variation_text"]:"default_text");
		 ?>
          <div id="niwoovd-notice" class="notice notice-success" style="display:none"></div>
          <form method="post" id="frm_niwoovd_setting" name="frm_niwoovd_setting">
          	  <h2><?php esc_html_e(  'Shop page variation dropdown setting', 'niwoovd'); ?></h2>	
              <table class="form-table">
                <tbody>
                    <tr>
                        <th><label for="enable_variation_dropdown"><?php esc_html_e(  'Enable', 'niwoovd'); ?></label></th>
                        <td> <input type="checkbox" name="enable_variation_dropdown" id="enable_variation_dropdown"  <?php echo esc_attr ($enable_variation_dropdown=='yes')?'checked':'';?> /> </td>
                    </tr>
                    <tr>
                        <th><label for="show_variation_description"><?php esc_html_e(  'Show Variation Description', 'niwoovd'); ?></label></th>
                        <td> <input type="checkbox" name="show_variation_description" id="show_variation_description" <?php echo esc_attr ($show_variation_description=='yes')?'checked':'';?> /> </td>
                    </tr>
                    <tr>
                        <th><label for="maximum_description"><?php esc_html_e( 'Maximum words of variation description', 'niwoovd'); ?></label></th>
                        <td> <input type="number" id="maximum_description" name="maximum_description" value="<?php echo esc_attr( $maximum_description);  ?>" /></td>
                    </tr>
                    
                    <tr>
                        <th><label for="maximum_description"><?php esc_html_e( 'Change variation default drop-down', 'niwoovd'); ?></label></th>
                        <td>
                        	<table>
                            	<tr>
                                	<td><input type="radio" name="variation_text" id="default_text" value="default_text" <?php  echo esc_attr ($variation_text=='default_text')?'checked':'';?>/> </td>
                                    <th><label for="default_text"><?php esc_html_e( 'Default text', 'niwoovd'); ?></label></th>
                                </tr>
                               	<tr>
                                	<td><input type="radio" id="variation_attribute" name="variation_text" value="variation_attribute" <?php echo esc_attr($variation_text=='variation_attribute')?'checked':'';?>/></td>
                                     <th><label for="variation_attribute"><?php esc_html_e( 'Variation attribute', 'niwoovd'); ?></label></th>
                                </tr>
                               	<tr>
                                	<td><input type="radio" id="custom_text" name="variation_text"  value="custom_text" value="variation_attribute" <?php  echo esc_attr($variation_text=='custom_text')?'checked':'';?> /></td>
                                     <th><label for="custom_text"><?php esc_html_e( 'Custom text', 'niwoovd'); ?></label></th>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    
                </tbody>
              </table>
              <input type="hidden"  id="action" name="action" value="niwoovd"/>
              <input type="hidden"  id="sub_action" name="sub_action" value="niwoovd_setting"/>
               <input type="submit" value="<?php  esc_html_e("Save",'niwoovd'); ?>">
          </form>
         <?php	
		 }
		 function ajax_init(){
		 	$niwoovd_setting = array();
			$niwoovd_setting["enable_variation_dropdown"] = sanitize_text_field( isset($_REQUEST["enable_variation_dropdown"])?"yes":"no");
			$niwoovd_setting["show_variation_description"] =sanitize_text_field( isset($_REQUEST["show_variation_description"])?"yes":"no");
			$niwoovd_setting["maximum_description"] =sanitize_text_field( isset($_REQUEST["maximum_description"])?$_REQUEST["maximum_description"]:"0");
			
			
			$niwoovd_setting["variation_text"] = sanitize_text_field( isset($_REQUEST["variation_text"])?$_REQUEST["variation_text"]:"default_text");
			
			
			update_option("niwoovd_setting", $niwoovd_setting );
			esc_html_e( "settings saved successfully.",'niwoovd');
			die;
		 }
	}
}
			