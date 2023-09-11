<?php
get_header();
 
$obj = get_queried_object();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


	$args = array(
	   'post_type' => 'casestudy',
	   'post_per_page'=> 3,
	   'paged'=> $paged,
	   'cat' => $obj->term_id,
		);
		$the_query = new WP_Query( $args );
		?>

<div class="main_wrapper">
	<section class="inner-banner d-flex align-items-center" 
    	style="background-image: url('<?php echo  home_url(); ?>/wp-content/uploads/2021/04/inner-banner1.jpg')">
			<div class="container">
				<div class="inr-bnr-ttl text-center">
					<h2><?php the_archive_title(  );?></h2>
				</div>
			</div>
	</section>
	<div class="row">
	<?php 
	if($the_query->have_posts()):
		while ($the_query-> have_posts() ) :
		$the_query->the_post();
	?>
		<div class="col-md-4">
			<div class="card case-card-box">
				<div class="case-card-head">
					<img src="<?php echo  get_the_post_thumbnail();?>">
				</div>
				<div class="card-body">
					<div class="tag-button">
						<a href="#"><?php echo the_category(); ?></a>
					</div>
					<h4 class="card-title my-lg-4 my-md-3 my-2"><?php echo the_title(); ?></h4>
					<a href="<?php the_permalink(); ?>" class="read_more_btn"><?php echo the_excerpt(); ?></a>
				</div>
			</div>
		</div>	
		<?php endwhile;?>
	</div>
	
	<div class="Page navigation pagination-page my-md-3 my-2">
		<ul class="pagination">
			<?php 		
				wp_pagenavi(array('query'=>$the_query,));
		endif;
				wp_reset_postdata();?>
		</ul>
	</div>
				    
</div>
<?php get_footer();