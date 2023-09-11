<?php
/**
* A Simple Category Template
*/
get_header(); 

global $wpdb;
$term = get_queried_object();
$term_id = $term->term_id;
$slug = $term->slug;
$processor_value = '';
if(isset($_GET['processor']) && !empty($_GET['processor'])){
	$processor_value = $_GET['processor'];
}

if($slug == 'motherboard'){
	$brand_values = $wpdb->get_results("SELECT DISTINCT brand.meta_value FROM $wpdb->posts AS p LEFT JOIN $wpdb->postmeta AS brand ON p.ID = brand.post_id AND brand.meta_key = 'brand' LEFT JOIN $wpdb->postmeta AS processor ON p.ID = processor.post_id AND processor.meta_key = '".$processor_value."' AND p.post_type = 'pc_product' LEFT JOIN  $wpdb->term_relationships  as t ON p.ID = t.object_id AND t.term_taxonomy_id = ".$term_id." WHERE p.post_status = 'publish' AND processor.meta_value != '' AND t.term_taxonomy_id != '' ");
}else{
	$brand_values = $wpdb->get_results("SELECT DISTINCT brand.meta_value FROM $wpdb->posts AS p LEFT JOIN $wpdb->postmeta AS brand ON p.ID = brand.post_id AND brand.meta_key = 'brand' LEFT JOIN $wpdb->postmeta AS processor ON p.ID = processor.post_id AND p.post_type = 'pc_product' LEFT JOIN  $wpdb->term_relationships  as t ON p.ID = t.object_id AND t.term_taxonomy_id = ".$term_id." WHERE p.post_status = 'publish' AND processor.meta_value != '' AND t.term_taxonomy_id != '' ");
}

if($slug == 'motherboard'){
	$price_values = $wpdb->get_results("SELECT MAX(cast(price.meta_value as DECIMAL(10,2))) as max_price FROM $wpdb->posts AS p LEFT JOIN $wpdb->postmeta AS price ON p.ID = price.post_id AND price.meta_key = 'price' LEFT JOIN $wpdb->postmeta AS processor ON p.ID = processor.post_id AND processor.meta_key = '".$processor_value."' AND p.post_type = 'pc_product' LEFT JOIN  $wpdb->term_relationships  as t ON p.ID = t.object_id AND t.term_taxonomy_id = ".$term_id." WHERE p.post_status = 'publish' AND processor.meta_value != '' AND t.term_taxonomy_id != '' ");
}else{
	$price_values = $wpdb->get_results("SELECT MAX(cast(price.meta_value as DECIMAL(10,2))) as max_price FROM $wpdb->posts AS p LEFT JOIN $wpdb->postmeta AS price ON p.ID = price.post_id AND price.meta_key = 'price' LEFT JOIN $wpdb->postmeta AS processor ON p.ID = processor.post_id AND p.post_type = 'pc_product' LEFT JOIN  $wpdb->term_relationships  as t ON p.ID = t.object_id AND t.term_taxonomy_id = ".$term_id." WHERE p.post_status = 'publish' AND processor.meta_value != '' AND t.term_taxonomy_id != '' ");
}

if(empty($brand_values) && empty($price_values[0]->max_price) || empty($brand_values) && empty($price_values)){
	$brand_values = $wpdb->get_results("SELECT DISTINCT brand.meta_value FROM $wpdb->posts AS p LEFT JOIN $wpdb->postmeta AS brand ON p.ID = brand.post_id AND brand.meta_key = 'brand' LEFT JOIN $wpdb->postmeta AS processor ON p.ID = processor.post_id AND p.post_type = 'pc_product' LEFT JOIN  $wpdb->term_relationships  as t ON p.ID = t.object_id AND t.term_taxonomy_id = ".$term_id." WHERE p.post_status = 'publish' AND processor.meta_value != '' AND t.term_taxonomy_id != '' ");

	$price_values = $wpdb->get_results("SELECT MAX(cast(price.meta_value as DECIMAL(10,2))) as max_price FROM $wpdb->posts AS p LEFT JOIN $wpdb->postmeta AS price ON p.ID = price.post_id AND price.meta_key = 'price' LEFT JOIN $wpdb->postmeta AS processor ON p.ID = processor.post_id AND p.post_type = 'pc_product' LEFT JOIN  $wpdb->term_relationships  as t ON p.ID = t.object_id AND t.term_taxonomy_id = ".$term_id." WHERE p.post_status = 'publish' AND processor.meta_value != '' AND t.term_taxonomy_id != '' ");
	$empty_processor = '';
}else{
	$empty_processor = 'processor';
}
?>

<section id="primary" class="site-content">
	<input type='hidden' class="term_slug" name="term_slug" value="<?php echo $slug; ?>">
	<input type='hidden' class="processor" name="processor" value="<?php echo $processor_value; ?>">
	<input type='hidden' class="empty_processor" name="empty_processor" value="<?php echo $empty_processor; ?>">
	<div id="content" role="main">
		<div class="container product-filter-sec">
			<div class="box-left">
				<!-- Custom Filter -->
				<h3><?php echo __('Product Filter','PcBuild'); ?></h3>
				<table class="prod-filter-table">
					<tr>
						<td>
							<a class="clear-filter"><?php echo __('Clear Filter','PcBuild'); ?></a>
						</td>
					</tr>
					<tr>
						<td>
							<h4><?php echo __('Price','PcBuild'); ?></h4>
							<div id="price-range">
								<div class="section price">
								    <div class="price-slider"></div>
								    <p class="price-value"></p>
								    <?php if( !empty($price_values)){ 
								    		foreach ($price_values as $price_value) { ?>
											    <input type="hidden" min="0" max="<?php echo $price_value->max_price; ?>" value="0" id="lower">
									      		<input type="hidden" min="0" max="<?php echo $price_value->max_price; ?>" value="<?php echo $price_value->max_price; ?>" id="upper">
									      		<input type="hidden" value="<?php echo round($price_value->max_price); ?>" id="max-val">
								    		<?php 
								    		}
								    	?>
						      		<?php }else{ ?>
											    <input type="hidden" min="0" max="0" value="0" id="lower">
									      		<input type="hidden" min="0" max="0" value="0" id="upper">
						      		<?php } ?>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<h4><?php echo __('Rating','PcBuild'); ?></h4>
							<div class="rating-star">
								<div class="rating-box">
									<input type="radio" id="5" class="rating" name="rating" value="5">
									<label for="5"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></label>
								</div>
								<div class="rating-box">
									<input type="radio" id="4" class="rating" name="rating" value="4">
									<label for="4"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></label>
								</div>
								<div class="rating-box">
									<input type="radio" id="3" class="rating" name="rating" value="3">
									<label for="3"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></label>
								</div>
								<div class="rating-box">
									<input type="radio" id="2" class="rating" name="rating" value="2">
									<label for="2"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></label>
								</div>
								<div class="rating-box">
									<input type="radio" id="1" class="rating" name="rating" value="1">
									<label for="1"></i><i class="fa fa-star" aria-hidden="true"></i></label>
								</div>
								<div class="rating-box">
									<input type="radio" id="0" class="rating" name="rating" value="0">
									<label for="0"><?php echo __('All','PcBuild'); ?></label>
								</div>
							</div>
						</td>
					</tr>
					<?php if(!empty($brand_values)){ ?>
						<tr>
							<td>
								<h4><?php echo __('Brand','PcBuild'); ?></h4>
								<ul id="myList">
									<?php foreach ($brand_values as $brand_value) { 
										if(!empty($brand_value->meta_value)){?>
										<li><input type="checkbox" class="brand-check" name="brand_filter[]" value="<?php echo $brand_value->meta_value; ?>">
										<label><?php echo $brand_value->meta_value; ?></label></li>
									<?php
									}}
									?>
									<div id="loadMore"><?php echo __('Show more','PcBuild'); ?></div>
									<div id="showLess"><?php echo __('Show less','PcBuild'); ?></div>
								</ul>
							</td>
						</tr>
					<?php } ?>
				</table>
			</div>
			<div class="box-right table-inner">
				<div class="filter-tab display-hidden">
					<span class="filter-heading"><?php echo __('Filter:','PcBuild'); ?></span>
					<span class="price-hidden">
						<span class="tag label label-info">
						  <span><?php echo __('Price:','PcBuild'); ?> <span class="price-filter-val"></span></span>
						  <a><i class="remove-price glyphicon glyphicon-remove-sign glyphicon-white fa fa-close"></i></a> 
						</span>
					</span>
					<span class="rating-hidden">
						<span class="tag label label-info">
						  <span><?php echo __('Rating:','PcBuild'); ?> <span class="rating-filter-val"></span></span>
						  <a><i class="remove-rating glyphicon glyphicon-remove-sign glyphicon-white fa fa-close"></i></a> 
						</span>
					</span>
					<span class="brand-div">
					</span>
				</div>
				<div>
					<!-- Table -->
					<div class="table-mobile-s">
						<table id='empTable' class='display dataTable'>
							<thead>
								<tr>
									<th></th>
									<th><?php echo __('Prod Title','PcBuild'); ?></th>
									<th><?php echo __('Rating','PcBuild'); ?></th>
									<th><?php echo __('Brand','PcBuild'); ?></th>
									<th><?php echo __('Price','PcBuild'); ?></th>
									<th></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>