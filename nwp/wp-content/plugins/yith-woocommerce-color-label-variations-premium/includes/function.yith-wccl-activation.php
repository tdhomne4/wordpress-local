<?php // phpcs:ignore WordPress.NamingConventions
/**
 * Activate/Deactivate function
 *
 * @author  YITH
 * @package YITH\ColorAndLabelVariationsPremium
 * @version 1.0.0
 */

defined( 'YITH_WCCL' ) || exit; // Exit if accessed directly.

if ( ! function_exists( 'yith_wccl_activation' ) ) {
	/**
	 * Function triggered on activation for create table on db
	 *
	 * @author Francesco Licandro
	 * @return void
	 */
	function yith_wccl_activation() {
		global $wpdb;

		$installed_ver = get_option( 'yith_wccl_db_version', '' );

		if ( YITH_WCCL_DB_VERSION !== $installed_ver ) {

			$table_name      = $wpdb->prefix . 'yith_wccl_meta';
			$charset_collate = $wpdb->get_charset_collate();

			$sql = "CREATE TABLE $table_name (
		meta_id bigint(20) NOT NULL AUTO_INCREMENT,
		wc_attribute_tax_id bigint(20) NOT NULL,
		meta_key varchar(255) DEFAULT '',
		meta_value longtext DEFAULT '',
		PRIMARY KEY (meta_id)
		) $charset_collate;";

			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
			dbDelta( $sql );

			update_option( 'yith_wccl_db_version', YITH_WCCL_DB_VERSION );
		}
	}
}
