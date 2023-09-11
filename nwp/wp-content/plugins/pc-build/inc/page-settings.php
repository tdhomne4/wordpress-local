<h1>Page Settings</h1>

<form method = 'post' action = 'options.php' >
	<table class = "vm_table">
		<?php 
			settings_fields ( 'pc-build-page-optiongroup' );
			$intel_page_id = get_option( 'intel_page_id' );
			$amd_page_id = get_option( 'amd_page_id' );
			?>
		<tr>
			<th>Intel Page</th>
			<td>
				<select name="intel_page_id"> 
					<option selected="selected" name disabled="disabled" value=""><?php echo esc_attr( __( 'Select page' ) ); ?></option> 
					<?php
					$pages = get_pages(); 
						foreach ( $pages as $page ) {
							$option = '<option value="' . $page->ID . '" ';
							$option .= ( $page->ID == $intel_page_id ) ? 'selected="selected"' : '';
							$option .= '>';
							$option .= $page->post_title;
							$option .= '</option>';
							echo $option;
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<th>Amd Page</th>
			<td>
				<select name="amd_page_id"> 
					<option selected="selected" name disabled="disabled" value=""><?php echo esc_attr( __( 'Select page' ) ); ?></option> 
					<?php
						$pages = get_pages(); 
						foreach ( $pages as $page ) {
							$option = '<option value="' . $page->ID . '" ';
							$option .= ( $page->ID == $amd_page_id ) ? 'selected="selected"' : '';
							$option .= '>';
							$option .= $page->post_title;
							$option .= '</option>';
							echo $option;
						}
					?>
				</select>
			</td>
		</tr>
	</table>
	<input type = 'submit' class = 'button-primary' value = 'Save Changes'>
</form>