<?php
/*
Plugin name: Tag Match
Description: Create tags and assign tags to posts
Author: Cis
Version: 1.0.1
*/

/**
 * Exit if accessed this file directly
 */
if (!defined('ABSPATH')) die( 'Invalid request.' );

/**
 * Plugin activation hook
 */
register_activation_hook(__FILE__, function() {

});

/**
 * Plugin deactivation hook
 */
register_deactivation_hook(__FILE__, function() {
});

require 'classes/Configuration.php';

// require 'classes/ajaxHandler.php';