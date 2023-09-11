<?php
$attr_slug = strtolower($atts['cpu']);
$slug = $attr_slug.'-cpu';
$user = wp_get_current_user();
$user_id = $user->ID;
$args = array(
			'taxonomy' => 'pc_product_category',
			'orderby' => 'name',
			'order'   => 'ASC',
			'hide_empty' => false
		);
$cats = get_categories($args);
$cat_val_prod_id = array();
$cat_link = array();
$i = 1;
foreach ($cats as $cat) {
	$cat_link_val = get_category_link($cat->cat_ID);
	if (strpos($cat_link_val, '?') !== false) {
		$cat_link[$cat->slug] = get_category_link($cat->cat_ID).'&processor='.$attr_slug;
	}else{
		$cat_link[$cat->slug] = get_category_link($cat->cat_ID).'?processor='.$attr_slug;
	}
	$meta_value = $_COOKIE[$attr_slug.'-'.$cat->slug];
	if (isset($meta_value) && !empty($meta_value)){
		if($cat->slug == 'ram'){
			$ram_val_slash_rm = stripslashes($meta_value);    // string is stored with escape double quotes 
			$ram_val_arr = json_decode($ram_val_slash_rm, true);
			$ram_val_arr_count = array_count_values($ram_val_arr);
			$ram_val_count = count($ram_val_arr_count);
		}elseif($cat->slug == 'ssd'){
			$ssd_val_slash_rm = stripslashes($meta_value);    // string is stored with escape double quotes 
			$ssd_val_arr = json_decode($ssd_val_slash_rm, true);
			$ssd_val_arr_count = array_count_values($ssd_val_arr);
			$ssd_val_count = count($ssd_val_arr_count);
		}elseif($cat->slug == 'hdd'){
			$hdd_val_slash_rm = stripslashes($meta_value);    // string is stored with escape double quotes 
			$hdd_val_arr = json_decode($hdd_val_slash_rm, true);
			$hdd_val_arr_count = array_count_values($hdd_val_arr);
			$hdd_val_count = count($hdd_val_arr_count);
		}else{
			$pc_val = explode('_',$meta_value);
			$cat_val_prod_id[$attr_slug.'-'.$cat->slug] = $pc_val[1];
		}
	}
	$i++;
}
?>
<div class="top-copy-div">
	<div class="upper-box">
		<div class="action-box">
			<div class="action-box-item "><?php echo __('Markup:','PcBuild'); ?></div>
			<div id="html html-markup" class="action-box-item action-tooltip" data-toggle="tooltip" title="" data-original-title="Copy Html Markup!"><span class="action-tooltiptext"><?php echo __('Copy Html Markup!','PcBuild'); ?></span><i class="fa fa-code" id="btnCopy" aria-hidden="true"></i></div>
			<div id="text text-markup" class="action-box-item action-tooltip" data-toggle="tooltip" title="" data-original-title="Copy Text Markup!"> <span class="action-tooltiptext"><?php echo __('Copy Text Markup!','PcBuild'); ?></span><i class="fa fa-text-width" id="cpybtn" aria-hidden="true"></i></div>
		</div>
		<div class="social-icon">
			<!-- Add font awesome icons -->
			<div class="action-box-item "><?php echo __('Social Share:','PcBuild'); ?></div>
			<a class="action-box-item fa fa-facebook social-link" href="https://www.facebook.com/sharer/sharer.php?u=" target="_blank" rel="noopener" aria-label="Share on Facebook"></a>
			<a class="action-box-item fa fa-twitter social-link" href="http://twitter.com/share?url=" target="_blank" rel="noopener" aria-label="Share on Twitter"></a>
			<a class="action-box-item fa fa-envelope" id="mail_btn" href="#" target="_self" rel="noopener" aria-label="Share by E-Mail"></a>
		</div>
	</div>
</div>
<form method="GET" action="https://www.amazon.com/gp/aws/cart/add.html" target="_blank">
	<input type="hidden" name="AWSAccessKeyId" value="<?php echo get_option('amazon_key'); ?>" />
	<input type="hidden" name="AssociateTag" value="<?php echo get_option('partner_tag'); ?>" />
	<div class="table-mobile-scroll" id="copyTable">
		<table class="table-list-sec">
			<tr>
				<th class="th__component"><?php echo __('Component','PcBuild'); ?></th>
				<th class="th__tooltip"></th>
				<th class="th__image"></th>
				<th class="th__selection" colspan="2"><?php echo __('Selection','PcBuild'); ?></th>
				<th class="th__rating"><?php echo __('Rating','PcBuild'); ?></th>
				<th class="th__price"><?php echo __('Price','PcBuild'); ?></th>
				<th class="th__settings"><?php echo __('Quantity','PcBuild'); ?></th>
				<th class="th__buy"></th>
				<th class="th__remove"></th>
			</tr>
			<tr>
				<td><?php echo __('CPU (Processor)','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_cpu'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-'.$slug])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-'.$slug] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-'.$slug])) ? get_the_title($cat_val_prod_id[$attr_slug.'-'.$slug]) : "<a href = '".$cat_link[$slug]."' class = 'button'>Choose a CPU</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-'.$slug])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-'.$slug] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-'.$slug])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-'.$slug] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-'.$slug])) ? "<input type='hidden' class='asin_val' name='ASIN.1' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-'.$slug], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.1' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-'.$slug])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-'.$slug], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-'.$slug], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-'.$slug])) ? "<a data-remove-key = '".$attr_slug.'-'.$slug."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-'.$slug].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('Motherboard','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_motherboard'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-motherboard'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-motherboard'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-motherboard'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-motherboard']) : "<a href = '".$cat_link['motherboard']."' class = 'button'>Choose a Motherboard</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-motherboard'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-motherboard'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-motherboard'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-motherboard'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-motherboard'])) ? "<input type='hidden' class='asin_val' name='ASIN.2' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-motherboard'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.2' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-motherboard'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-motherboard'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-motherboard'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-motherboard'])) ? "<a data-remove-key = '".$attr_slug.'-motherboard'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-motherboard'].">x</a>" : ""; ?></td>
			</tr>
			<?php if(empty($ram_val_count)){ ?>
					<tr>
						<td><?php echo __('RAM (Memory)','PcBuild'); ?></td>
						<td>
							<div class="tooltip">
								<a class="tooltip-new">?</a>
								<div class="top">
									<p><?php echo get_option('pc_ram'); ?></p>
									<i></i>
								</div>
							</div>
						</td>
						<td></td>
						<td colspan="2"><?php echo "<a href = '".$cat_link['ram']."' class = 'button'>Choose RAM</a>"; ?></td>
						<td></td>
						<td class="price_val"></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
			<?php }else{ 
					foreach ($ram_val_arr_count as $ram_key => $ram_value) {
						$ram_key = explode('_',$ram_key);
						?>
						<tr>
							<td><?php echo __('RAM (Memory)','PcBuild'); ?></td>
							<td>
								<div class="tooltip">
									<a class="tooltip-new">?</a>
									<div class="top">
										<p><?php echo get_option('pc_ram'); ?></p>
										<i></i>
									</div>
								</div>
							</td>
							<td><?php echo '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $ram_key[1] ), 'single-post-thumbnail' )[0].'">'; ?></td>
							<td colspan="2"><?php echo get_the_title($ram_key[1]); ?></td>
							<td><?php echo get_post_meta($ram_key[1] , 'rating', TRUE); ?></td>
							<td class="price_val"><?php echo  '$'.get_post_meta($ram_key[1] , 'price', TRUE); ?></td>
							<td><?php echo "<input type='hidden' class='asin_val' name='ASIN.".$i."' value='".get_post_meta($ram_key[1], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.".$i."' value='".$ram_value."' placeholder='' min='1' max='10'>"; ?></td>
							<td><?php echo "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($ram_key[1], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($ram_key[1], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>"; ?></td>
							<td><?php echo "<a data-remove-key = '".$attr_slug.'-ram'."' class = 'remove-button' data-remove-id=".$ram_key[1].">x</a>"; ?></td>
						</tr>
					<?php 
					$i++;
					} ?>
					<tr>
						<td><?php echo __('Additional RAM (Memory)','PcBuild'); ?></td>
						<td>
							<div class="tooltip">
								<a class="tooltip-new">?</a>
								<div class="top">
									<p><?php echo get_option('pc_ram'); ?></p>
									<i></i>
								</div>
							</div>
						</td>
						<td></td>
						<td colspan="2"><?php echo "<a href = '".$cat_link['ram']."' class = 'button'>Add Additional RAM</a>"; ?></td>
						<td></td>
						<td class="price_val"></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
			<?php
			} ?>
			<?php if(empty($ssd_val_count)){ ?>
					<tr>
						<td><?php echo __('SSD/NVMe (Primary Storage)','PcBuild'); ?></td>
						<td>
							<div class="tooltip">
								<a class="tooltip-new">?</a>
								<div class="top">
									<p><?php echo get_option('pc_ssd'); ?></p>
									<i></i>
								</div>
							</div>
						</td>
						<td></td>
						<td colspan="2"><?php echo "<a href = '".$cat_link['ssd']."' class = 'button'>Choose SSD</a>"; ?></td>
						<td></td>
						<td class="price_val"></td>
						<td></td>
						<td></td>
						<td></td>
					</tr> 	 	
			<?php }else{ 
					foreach ($ssd_val_arr_count as $ssd_key => $ssd_value) {
						$ssd_key = explode('_',$ssd_key);
						?>
						<tr>
							<td><?php echo __('SSD/NVMe (Primary Storage)','PcBuild'); ?></td>
							<td>
								<div class="tooltip">
									<a class="tooltip-new">?</a>
									<div class="top">
										<p><?php echo get_option('pc_ssd'); ?></p>
										<i></i>
									</div>
								</div>
							</td>
							<td><?php echo '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $ssd_key[1] ), 'single-post-thumbnail' )[0].'">'; ?></td>
							<td colspan="2"><?php echo get_the_title($ssd_key[1]); ?></td>
							<td><?php echo get_post_meta($ssd_key[1] , 'rating', TRUE); ?></td>
							<td class="price_val"><?php echo  '$'.get_post_meta($ssd_key[1] , 'price', TRUE); ?></td>
							<td><?php echo "<input type='hidden' class='asin_val' name='ASIN.".$i."' value='".get_post_meta($ssd_key[1], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.".$i."' value='".$ssd_value."' placeholder='' min='1' max='10'>"; ?></td>
							<td><?php echo "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($ssd_key[1], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($ssd_key[1], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>"; ?></td>
							<td><?php echo "<a data-remove-key = '".$attr_slug.'-ssd'."' class = 'remove-button' data-remove-id=".$ssd_key[1].">x</a>"; ?></td>
						</tr>
					<?php 
					$i++;
					} ?>
					<tr>
						<td><?php echo __('SSD/NVMe (Primary Storage)','PcBuild'); ?></td>
						<td>
							<div class="tooltip">
								<a class="tooltip-new">?</a>
								<div class="top">
									<p><?php echo get_option('pc_ssd'); ?></p>
									<i></i>
								</div>
							</div>
						</td>
						<td></td>
						<td colspan="2"><?php echo "<a href = '".$cat_link['ssd']."' class = 'button'>Add Additional SSD</a>"; ?></td>
						<td></td>
						<td class="price_val"></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
			<?php
			} ?>
			<?php if(empty($hdd_val_count)){ ?>
					<tr>
						<td><?php echo __('HDD (Secondary storage)','PcBuild'); ?></td>
						<td>
							<div class="tooltip">
								<a class="tooltip-new">?</a>
								<div class="top">
									<p><?php echo get_option('pc_hdd'); ?></p>
									<i></i>
								</div>
							</div>
						</td>
						<td></td>
						<td colspan="2"><?php echo "<a href = '".$cat_link['hdd']."' class = 'button'>Choose HDD</a>"; ?></td>
						<td></td>
						<td class="price_val"></td>
						<td></td>
						<td></td>
						<td></td>
					</tr> 	 	
			<?php }else{ 
					foreach ($hdd_val_arr_count as $hdd_key => $hdd_value) {
						$hdd_key = explode('_',$hdd_key);
						?>
						<tr>
							<td><?php echo __('HDD (Secondary storage)','PcBuild'); ?></td>
							<td>
								<div class="tooltip">
									<a class="tooltip-new">?</a>
									<div class="top">
										<p><?php echo get_option('pc_hdd'); ?></p>
										<i></i>
									</div>
								</div>
							</td>
							<td><?php echo '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $hdd_key[1] ), 'single-post-thumbnail' )[0].'">'; ?></td>
							<td colspan="2"><?php echo get_the_title($hdd_key[1]); ?></td>
							<td><?php echo get_post_meta($hdd_key[1] , 'rating', TRUE); ?></td>
							<td class="price_val"><?php echo  '$'.get_post_meta($hdd_key[1] , 'price', TRUE); ?></td>
							<td><?php echo "<input type='hidden' class='asin_val' name='ASIN.".$i."' value='".get_post_meta($hdd_key[1], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.".$i."' value='".$hdd_value."' placeholder='' min='1' max='10'>"; ?></td>
							<td><?php echo "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($hdd_key[1], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($hdd_key[1], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>"; ?></td>
							<td><?php echo "<a data-remove-key = '".$attr_slug.'-hdd'."' class = 'remove-button' data-remove-id=".$hdd_key[1].">x</a>"; ?></td>
						</tr>
					<?php 
					$i++;
					} ?>
					<tr>
						<td><?php echo __('HDD (Secondary storage)','PcBuild'); ?></td>
						<td>
							<div class="tooltip">
								<a class="tooltip-new">?</a>
								<div class="top">
									<p><?php echo get_option('pc_hdd'); ?></p>
									<i></i>
								</div>
							</div>
						</td>
						<td></td>
						<td colspan="2"><?php echo "<a href = '".$cat_link['hdd']."' class = 'button'>Add Additional HDD</a>"; ?></td>
						<td></td>
						<td class="price_val"></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
			<?php
			} ?>
			<tr>
				<td><?php echo __('GPU (Graphics Card)','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_gpu'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gpu'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-gpu'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gpu'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-gpu']) : "<a href = '".$cat_link['gpu']."' class = 'button'>Choose a GPU</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gpu'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-gpu'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gpu'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-gpu'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gpu'])) ? "<input type='hidden' class='asin_val' name='ASIN.6' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-gpu'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.6' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gpu'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-gpu'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-gpu'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gpu'])) ? "<a data-remove-key = '".$attr_slug.'-gpu'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-gpu'].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('CPU Cooler','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_cpu_cooler'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-cooler'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-cooler'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-cooler'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-cooler']) : "<a href = '".$cat_link['cooler']."' class = 'button'>Choose a CPU Cooler</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-cooler'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-cooler'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-cooler'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-cooler'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-cooler'])) ? "<input type='hidden' class='asin_val' name='ASIN.7' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-cooler'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.7' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-cooler'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-cooler'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-cooler'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-cooler'])) ? "<a data-remove-key = '".$attr_slug.'-cooler'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-cooler'].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('PSU (Power Supply)','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_psu'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-psu'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-psu'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-psu'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-psu']) : "<a href = '".$cat_link['psu']."' class = 'button'>Choose a PSU</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-psu'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-psu'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-psu'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-psu'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-psu'])) ? "<input type='hidden' class='asin_val' name='ASIN.8' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-psu'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.8' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-psu'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-psu'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-psu'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-psu'])) ? "<a data-remove-key = '".$attr_slug.'-psu'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-psu'].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('PC Case','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_case'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-case'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-case'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-case'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-case']) : "<a href = '".$cat_link['case']."' class = 'button'>Choose a PC Case</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-case'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-case'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-case'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-case'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-case'])) ? "<input type='hidden' class='asin_val' name='ASIN.9' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-case'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.9' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-case'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-case'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-case'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-case'])) ? "<a data-remove-key = '".$attr_slug.'-case'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-case'].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('Sound Card','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_sound_card'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-sound-card'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-sound-card'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-sound-card'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-sound-card']) : "<a href = '".$cat_link['sound-card']."' class = 'button'>Choose a Sound Card</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-sound-card'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-sound-card'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-sound-card'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-sound-card'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-sound-card'])) ? "<input type='hidden' class='asin_val' name='ASIN.10' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-sound-card'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.10' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-sound-card'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-sound-card'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-sound-card'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-sound-card'])) ? "<a data-remove-key = '".$attr_slug.'-sound-card'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-sound-card'].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('Display Monitor','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_display_monitor'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-display-monitor'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-display-monitor'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-display-monitor'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-display-monitor']) : "<a href = '".$cat_link['display-monitor']."' class = 'button'>Choose a Display Monitor</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-display-monitor'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-display-monitor'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-display-monitor'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-display-monitor'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-display-monitor'])) ? "<input type='hidden' class='asin_val' name='ASIN.11' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-display-monitor'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.11' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-display-monitor'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-display-monitor'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-display-monitor'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-display-monitor'])) ? "<a data-remove-key = '".$attr_slug.'-display-monitor'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-display-monitor'].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('ODD (Optical Drive)','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_odd'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-odd'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-odd'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-odd'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-odd']) : "<a href = '".$cat_link['odd']."' class = 'button'>Choose an ODD</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-odd'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-odd'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-odd'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-odd'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-odd'])) ? "<input type='hidden' class='asin_val' name='ASIN.12' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-odd'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.12' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-odd'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-odd'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-odd'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-odd'])) ? "<a data-remove-key = '".$attr_slug.'-odd'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-odd'].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('Gaming Chair','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_gaming_chair'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gaming-chair'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-gaming-chair'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gaming-chair'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-gaming-chair']) : "<a href = '".$cat_link['gaming-chair']."' class = 'button'>Choose a Gaming Chair</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gaming-chair'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-gaming-chair'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gaming-chair'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-gaming-chair'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gaming-chair'])) ? "<input type='hidden' class='asin_val' name='ASIN.13' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-gaming-chair'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.13' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gaming-chair'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-gaming-chair'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-gaming-chair'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gaming-chair'])) ? "<a data-remove-key = '".$attr_slug.'-gaming-chair'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-gaming-chair'].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('Gaming Headset','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_gaming_headsets'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gaming-headset'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-gaming-headset'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gaming-headset'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-gaming-headset']) : "<a href = '".$cat_link['gaming-headset']."' class = 'button'>Choose a Gaming Headset</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gaming-headset'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-gaming-headset'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gaming-headset'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-gaming-headset'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gaming-headset'])) ? "<input type='hidden' class='asin_val' name='ASIN.14' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-gaming-headset'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.14' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gaming-headset'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-gaming-headset'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-gaming-headset'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-gaming-headset'])) ? "<a data-remove-key = '".$attr_slug.'-gaming-headset'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-gaming-headset'].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('Keyboard','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_keyboard'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-keyboard'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-keyboard'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-keyboard'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-keyboard']) : "<a href = '".$cat_link['keyboard']."' class = 'button'>Choose a Keyboard</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-keyboard'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-keyboard'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-keyboard'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-keyboard'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-keyboard'])) ? "<input type='hidden' class='asin_val' name='ASIN.15' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-keyboard'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.15' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-keyboard'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-keyboard'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-keyboard'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-keyboard'])) ? "<a data-remove-key = '".$attr_slug.'-keyboard'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-keyboard'].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('Mouse','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_mouse'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-mouse'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-mouse'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-mouse'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-mouse']) : "<a href = '".$cat_link['mouse']."' class = 'button'>Choose a Mouse</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-mouse'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-mouse'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-mouse'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-mouse'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-mouse'])) ? "<input type='hidden' class='asin_val' name='ASIN.16' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-mouse'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.16' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-mouse'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-mouse'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-mouse'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-mouse'])) ? "<a data-remove-key = '".$attr_slug.'-mouse'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-mouse'].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('Operating System','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_operating_system'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-os'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-os'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-os'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-os']) : "<a href = '".$cat_link['os']."' class = 'button'>Choose an Operating System</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-os'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-os'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-os'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-os'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-os'])) ? "<input type='hidden' class='asin_val' name='ASIN.17' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-os'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.17' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-os'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-os'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-os'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-os'])) ? "<a data-remove-key = '".$attr_slug.'-os'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-os'].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('Desktop Printer','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_desktop_printer'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-desktop-printer'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-desktop-printer'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-desktop-printer'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-desktop-printer']) : "<a href = '".$cat_link['desktop-printer']."' class = 'button'>Choose a Desktop Printer</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-desktop-printer'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-desktop-printer'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-desktop-printer'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-desktop-printer'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-desktop-printer'])) ? "<input type='hidden' class='asin_val' name='ASIN.18' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-desktop-printer'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.18' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-desktop-printer'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-desktop-printer'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-desktop-printer'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-desktop-printer'])) ? "<a data-remove-key = '".$attr_slug.'-desktop-printer'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-desktop-printer'].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('VR Headset','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_vr_headset'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-vr-headset'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-vr-headset'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-vr-headset'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-vr-headset']) : "<a href = '".$cat_link['vr-headset']."' class = 'button'>Choose a VR Headset</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-vr-headset'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-vr-headset'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-vr-headset'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-vr-headset'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-vr-headset'])) ? "<input type='hidden' class='asin_val' name='ASIN.19' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-vr-headset'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.19' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-vr-headset'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-vr-headset'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-vr-headset'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-vr-headset'])) ? "<a data-remove-key = '".$attr_slug.'-vr-headset'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-vr-headset'].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('External Speaker','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_external_speaker'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-external-speaker'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-external-speaker'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-external-speaker'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-external-speaker']) : "<a href = '".$cat_link['external-speaker']."' class = 'button'>Choose an External Speaker</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-external-speaker'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-external-speaker'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-external-speaker'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-external-speaker'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-external-speaker'])) ? "<input type='hidden' class='asin_val' name='ASIN.20' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-external-speaker'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.20' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-external-speaker'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-external-speaker'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-external-speaker'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-external-speaker'])) ? "<a data-remove-key = '".$attr_slug.'-external-speaker'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-external-speaker'].">x</a>" : ""; ?></td>
			</tr>
			<tr>
				<td><?php echo __('External Hard Drive','PcBuild'); ?></td>
				<td>
					<div class="tooltip">
						<a class="tooltip-new">?</a>
						<div class="top">
							<p><?php echo get_option('pc_external_hard_drive'); ?></p>
							<i></i>
						</div>
					</div>
				</td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-external-hard-drive'])) ? '<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id( $cat_val_prod_id[$attr_slug.'-external-hard-drive'] ), 'single-post-thumbnail' )[0].'">' : ""; ?></td>
				<td colspan="2"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-external-hard-drive'])) ? get_the_title($cat_val_prod_id[$attr_slug.'-external-hard-drive']) : "<a href = '".$cat_link['external-hard-drive']."' class = 'button'>Choose an External Hard Drive</a>"; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-external-hard-drive'])) ? get_post_meta($cat_val_prod_id[$attr_slug.'-external-hard-drive'] , 'rating', TRUE) : ""; ?></td>
				<td class="price_val"><?php echo (!empty($cat_val_prod_id[$attr_slug.'-external-hard-drive'])) ? '$'.get_post_meta($cat_val_prod_id[$attr_slug.'-external-hard-drive'] , 'price', TRUE) : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-external-hard-drive'])) ? "<input type='hidden' class='asin_val' name='ASIN.21' value='".get_post_meta($cat_val_prod_id[$attr_slug.'-external-hard-drive'], 'asin', TRUE)."'/><input type='number' class='quantity_val' name='Quantity.21' value='1' placeholder='' min='1' max='10'>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-external-hard-drive'])) ? "<a data-href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-external-hard-drive'], 'asin', TRUE)."&Quantity.1=1&add=add' href='https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=".get_option('amazon_key')."&AssociateTag=".get_option('partner_tag')."&ASIN.1=".get_post_meta($cat_val_prod_id[$attr_slug.'-external-hard-drive'], 'asin', TRUE)."&Quantity.1=1&add=add' class='button button--small button--success amazon-link' rel='nofollow' target='_blank'>Buy</a>" : ""; ?></td>
				<td><?php echo (!empty($cat_val_prod_id[$attr_slug.'-external-hard-drive'])) ? "<a data-remove-key = '".$attr_slug.'-external-hard-drive'."' class = 'remove-button' data-remove-id=".$cat_val_prod_id[$attr_slug.'-external-hard-drive'].">x</a>" : ""; ?></td>
			</tr>
			<tr class="tr__total tr__total--final">
				<td class="td__label" colspan="6"><?php echo __('Total:','PcBuild'); ?></td>
				<td class="td_total_price"></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>
	<div class="btn-group-sec">
		<input type='submit' name='add' value='Buy From Amazon' class="xs-float-right button button--small button--success amazon-btn" />
	</div>
</form>
<!-- The Modal -->
<div id="myModal" class="modal">

	<!-- Modal content -->
	<div class="modal-content">
		<span class="close">&times;</span>
		<p class="email-display"><input type="email" name="email" value="" class="email_field" placeholder="enter your email"><button class="email_btn"><?php echo __('Send','PcBuild'); ?></button></p>
		<p class="error-msg"><span class="msg"><?php echo __('Email is not valid or empty.','PcBuild'); ?></span></p>
	</div>

</div>
<div id="mailTable"></div>