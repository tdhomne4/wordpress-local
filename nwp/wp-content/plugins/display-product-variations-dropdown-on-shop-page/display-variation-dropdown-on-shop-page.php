<?php
/*
Plugin Name: Display product variations dropdown on shop page
Description: Display product variations dropdown on shop page and category page
Author: anzia
Version: 1.0.8
Author URI: http://naziinfotech.com/
Plugin URI: https://wordpress.org/plugins/display-variation-dropdown-on-shop-page/
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/agpl-3.0.html
Requires at least: 4.7
Tested up to: 5.9.2
WC requires at least: 3.0.0
WC tested up to: 6.3.1
Last Updated Date: 26-March-2022
Requires PHP: 7.0
*/
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'Ni_Variation_Dropdown_Shop_Page' ) ) {
	class Ni_Variation_Dropdown_Shop_Page{
		var $nidsrfw_constant = array();  
		 public function __construct(){
			include("includes/ni-variation-dropdown-shop-page-init.php");
			$obj_init =  new Ni_Variation_Dropdown_Shop_Page_Init($this->nidsrfw_constant);
		 }
	}
	$obj = new Ni_Variation_Dropdown_Shop_Page();
}
?>