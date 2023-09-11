<style type="text/css">

	.vm_table {
		border-collapse: collapse;
		margin: 20px 0px;
		width: 50%;
	} 

	.vm_table tr th, 
	.vm_table tr td {
		border: solid #000000 1px;
		padding: 5px;
	}

	.vm_table tr th{
		width: 20%;
	}

	.vm_table td textarea{
		width: 100%;
	}

</style>
<form method = 'post' action = 'options.php' >

	<?php settings_fields ( 'pc-build-tooltip-optiongroup' ); ?>

	<h1>Pc Tooltip Settings</h1>

	<table class = "vm_table">
		<tr>
			<th>CPU</th>
			<td><textarea name = 'pc_cpu' value = '<?php echo get_option('pc_cpu'); ?>'><?php echo get_option('pc_cpu'); ?></textarea></td>
		</tr>
		<tr>
			<th>Motherboard</th>
			<td><textarea name = 'pc_motherboard' value = '<?php echo get_option('pc_motherboard'); ?>'><?php echo get_option('pc_motherboard'); ?></textarea></td>
		</tr>
		<tr>
			<th>RAM</th>
			<td><textarea name = 'pc_ram' value = '<?php echo get_option('pc_ram'); ?>'><?php echo get_option('pc_ram'); ?></textarea></td>
		</tr>
		<tr>
			<th>SSD/NVMe</th>
			<td><textarea name = 'pc_ssd' value = '<?php echo get_option('pc_ssd'); ?>'><?php echo get_option('pc_ssd'); ?></textarea></td>
		</tr>
		<tr>
			<th>HDD</th>
			<td><textarea name = 'pc_hdd' value = '<?php echo get_option('pc_hdd'); ?>'><?php echo get_option('pc_hdd'); ?></textarea></td>
		</tr>
		<tr>
			<th>GPU</th>
			<td><textarea name = 'pc_gpu' value = '<?php echo get_option('pc_gpu'); ?>'><?php echo get_option('pc_gpu'); ?></textarea></td>
		</tr>
		<tr>
			<th>CPU Cooler</th>
			<td><textarea name = 'pc_cpu_cooler' value = '<?php echo get_option('pc_cpu_cooler'); ?>'><?php echo get_option('pc_cpu_cooler'); ?></textarea></td>
		</tr>
		<tr>
			<th>PSU</th>
			<td><textarea name = 'pc_psu' value = '<?php echo get_option('pc_psu'); ?>'><?php echo get_option('pc_psu'); ?></textarea></td>
		</tr>
		<tr>
			<th>PC Case</th>
			<td><textarea name = 'pc_case' value = '<?php echo get_option('pc_case'); ?>'><?php echo get_option('pc_case'); ?></textarea></td>
		</tr>
		<tr>
			<th>Sound Card</th>
			<td><textarea name = 'pc_sound_card' value = '<?php echo get_option('pc_sound_card'); ?>'><?php echo get_option('pc_sound_card'); ?></textarea></td>
		</tr>
		<tr>
			<th>Display Monitor</th>
			<td><textarea name = 'pc_display_monitor' value = '<?php echo get_option('pc_display_monitor'); ?>'><?php echo get_option('pc_display_monitor'); ?></textarea></td>
		</tr>
		<tr>
			<th>ODD</th>
			<td><textarea name = 'pc_odd' value = '<?php echo get_option('pc_odd'); ?>'><?php echo get_option('pc_odd'); ?></textarea></td>
		</tr>
		<tr>
			<th>Gaming Chair</th>
			<td><textarea name = 'pc_gaming_chair' value = '<?php echo get_option('pc_gaming_chair'); ?>'><?php echo get_option('pc_gaming_chair'); ?></textarea></td>
		</tr>
		<tr>
			<th>Gaming Headsets</th>
			<td><textarea name = 'pc_gaming_headsets' value = '<?php echo get_option('pc_gaming_headsets'); ?>'><?php echo get_option('pc_gaming_headsets'); ?></textarea></td>
		</tr>
		<tr>
			<th>Keyboard</th>
			<td><textarea name = 'pc_keyboard' value = '<?php echo get_option('pc_keyboard'); ?>'><?php echo get_option('pc_keyboard'); ?></textarea></td>
		</tr>
		<tr>
			<th>Mouse</th>
			<td><textarea name = 'pc_mouse' value = '<?php echo get_option('pc_mouse'); ?>'><?php echo get_option('pc_mouse'); ?></textarea></td>
		</tr>
		<tr>
			<th>Operating System</th>
			<td><textarea name = 'pc_operating_system' value = '<?php echo get_option('pc_operating_system'); ?>'><?php echo get_option('pc_operating_system'); ?></textarea></td>
		</tr>
		<tr>
			<th>Desktop Printers</th>
			<td><textarea name = 'pc_desktop_printer' value = '<?php echo get_option('pc_desktop_printer'); ?>'><?php echo get_option('pc_desktop_printer'); ?></textarea></td>
		</tr>		<tr>
			<th>VR Headset</th>
			<td><textarea name = 'pc_vr_headset' value = '<?php echo get_option('pc_vr_headset'); ?>'><?php echo get_option('pc_vr_headset'); ?></textarea></td>
		</tr>
		<tr>
			<th>External Speaker</th>
			<td><textarea name = 'pc_external_speaker' value = '<?php echo get_option('pc_external_speaker'); ?>'><?php echo get_option('pc_external_speaker'); ?></textarea></td>
		</tr>		<tr>
			<th>External Hard Drive</th>
			<td><textarea name = 'pc_external_hard_drive' value = '<?php echo get_option('pc_external_hard_drive'); ?>'><?php echo get_option('pc_external_hard_drive'); ?></textarea></td>
		</tr>
	</table>
	<input type = 'submit' class = 'button-primary' value = 'Save Changes'>

</form>	