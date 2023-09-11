<?php // phpcs:ignore WordPress.NamingConventions
/**
 * Variable product add to cart in loop
 *
 * @author  Francesco Licandro
 * @package YITH\ColorAndLabelVariationsPremium
 * @version 1.0.0
 */

defined( 'YITH_WCCL' ) || exit; // Exit if accessed directly.

?>

<div class="variations_form cart in_loop" data-product_id="<?php echo intval( $product_id ); ?>" data-active_variation=""
		data-product_variations="<?php echo $data_product_variations; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>">
	<?php
	foreach ( $attributes as $name => $options ) :

		// check for default attribute.
		if ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) {
			$selected_value = $selected_attributes[ sanitize_title( $name ) ];
		} else {
			$selected_value = '';
		}

		$sanitized_name = esc_attr( sanitize_title( $name ) );

		?>
		<div class="<?php echo 'variations ' . esc_attr( $sanitized_name ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>">
			<select id="<?php echo esc_attr( $sanitized_name );	?>" name="attribute_<?php echo esc_attr( $sanitized_name );	?>" data-attribute_name="attribute_<?php echo esc_attr( $sanitized_name ); ?>"
				<?php
				if ( isset( $attributes_types[ $name ] ) ) {
					echo 'data-type="' . esc_attr( $attributes_types[ $name ] ) . '"';
				}
				?>
					data-default_value="<?php echo esc_attr( $selected_value ); ?>">
				<?php
				/**
				 * APPLY_FILTER: yith_wccl_empty_option_loop_label
				 *
				 * Empty option loop label.
				 *
				 * @param string $label the default label
				 * @param string $name  attribute name
				 *
				 * @return array
				 *
				 */
				?>
				<option value=""><?php echo esc_html( apply_filters( 'yith_wccl_empty_option_loop_label', __( 'Choose an option', 'yith-woocommerce-color-label-variations' ), $name ) ); ?></option>
				<?php

				if ( is_array( $options ) ) {

					// Get terms if this is a taxonomy - ordered.
					if ( taxonomy_exists( $name ) ) {

						$terms = wc_get_product_terms( $product_id, $name, array( 'fields' => 'all' ) );

						foreach ( $terms as $term ) { //phpcs:ignore
							if ( ! in_array( $term->slug, $options, true ) ) {
								continue;
							}
							$value   = ywccl_get_term_meta( $term->term_id, '_yith_wccl_value', true, $name );
							$tooltip = ywccl_get_term_meta( $term->term_id, '_yith_wccl_tooltip', true, $name );
							echo '<option value="' . esc_attr( $term->slug ) . '"' . selected( sanitize_title( $selected_value ), sanitize_title( $term->slug ), false ) . ' data-value="' . esc_attr( $value ) . '" data-tooltip="' . esc_attr( $tooltip ) . '">' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) ) . '</option>';
						}
					} else {

						foreach ( $options as $option ) {
							echo '<option value="' . esc_attr( $option ) . '"' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
						}
					}
				}
				?>
			</select>
		</div>
	<?php endforeach; ?>
</div>
