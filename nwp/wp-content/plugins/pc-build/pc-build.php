<?php
/*
Plugin name: Pc Build
Description: Add to posts and pages with [pc_build cpu='input'](input = 'intel' or 'amd')
Author: Zoltan Benjei
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

require 'classes/ajaxHandler.php';