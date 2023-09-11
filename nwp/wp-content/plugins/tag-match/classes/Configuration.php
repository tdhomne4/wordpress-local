<?php

/**
 * Configuration
 */


class TagMatch { 

	public function __construct() {

		if ( is_admin() ) {
			add_action ( 'admin_menu', array( $this, 'tag_match_menu' ) );
		}

	}

	// Admin Menu And Submenu For Backend Settings 
	public function tag_match_menu() {

		add_menu_page(
			__('Tag Match Menu'),// the page title
			__('Tag Match Menu'),//menu title
			'edit_themes',//capability 
			'tag-match-settings',//menu slug/handle this is what you need!!!
			array( $this, 'tag_match_search_page' ),//callback function
			'',//icon_url,
			8//position
		);

	}

	// Tag Match Credential Backend Setting
	public function tag_match_search_page() {

		$adminUrl = admin_url( 'admin.php?page=tag-match-search' );
		require_once plugin_dir_path( __FILE__ ) . '../inc/search.php';

	}

}

new TagMatch();