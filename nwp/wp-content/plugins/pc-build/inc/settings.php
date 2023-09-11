<style type="text/css">

	.vm_table {
		border-collapse: collapse;
		margin: 20px 0px;
	} 

	.vm_table tr th, 
	.vm_table tr td {
		border: solid #000000 1px;
		padding: 5px;
	}

</style>
<form method = 'post' action = 'options.php' >

	<?php
	settings_fields ( 'pc-build-optiongroup' );
	$affiliate_key = get_option('affiliate_key');
	$amazon_key = get_option('amazon_key');
	$secret_key = get_option('secret_key');
	$partner_tag = get_option('partner_tag');
	?>

	<h1>Pc Build Settings</h1>

	<?php if(empty($affiliate_key) || empty($amazon_key) || empty($secret_key) || empty($partner_tag)): ?>
		<table class = "vm_table">
			<tr>
				<th>Affiliate Id</th>
				<td><input type = 'text' name = 'affiliate_key' value = '<?php echo $affiliate_key; ?>'></td>
			</tr>
			<tr>
				<th>Access Key</th>
				<td><input type = 'text' name = 'amazon_key' value = '<?php echo $amazon_key; ?>'></td>
			</tr>
			<tr>
				<th>Secret Key</th>
				<td><input type = 'password' name = 'secret_key' value = '<?php echo $secret_key; ?>'></td>
			</tr>
			<tr>
				<th>Partner Tag</th>
				<td><input type = 'text' name = 'partner_tag' value = '<?php echo $partner_tag; ?>'></td>
			</tr>
		</table>
		<input type = 'submit' class = 'button-primary' value = 'Save Changes'>
	<?php else: ?>
		<div><img src="<?php echo plugins_url( '../images/icon.png', __FILE__ ); ?>"><p>Key already saved</p></div>
		<input type = 'hidden' name = 'affiliate_key' value = ''>
		<input type = 'hidden' name = 'amazon_key' value = ''>
		<input type = 'hidden' name = 'secret_key' value = ''>
		<input type = 'hidden' name = 'partner_tag' value = ''>
		<input type = 'submit' class = 'button-secondary' value = 'Reset'>
	<?php endif; ?>

</form>	