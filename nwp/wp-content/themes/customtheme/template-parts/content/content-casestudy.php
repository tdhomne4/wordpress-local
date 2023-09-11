
<div class="col-md-12 mb-lg-4 mb-md-3 mb-0 lead-block2">
	<h3 class="title-24 my-lg-4 my-md-3 my-2"><?php echo the_title(); ?></h3>
	<p class="lead-text"><?php echo the_content(); ?></p>
</div>
</div>
		   
</div>
	</div>
</section>
<!-- /. case-study-destails -->
<section class="same-caseStudy-sec mb-lg-5 mb-md-4 mb-3 pb-2">
	<div class="container">
		<div class="main-heading text-center">
		   <h2 class="title">Similar Case Study</h2>
		</div>
		<div class="caseStudy_listing">
			<div class="row">
			<?php  
			 $myarray = array(476,479,482);
			 $args = array(
			 'post_type' => 'casestudy',
			  'post__in' => $myarray,
			 );
				
			$the_query = new WP_Query( $args );
				// The Loop
			if ( $the_query->have_posts() ) :
					// echo '<ul>';
				while ( $the_query->have_posts() ) :
						$the_query->the_post();
			?>
				<div class="col-md-4">
					<div class="card case-card-box">
					  <div class="case-card-head">
						 <img src="<?php echo  get_the_post_thumbnail();?>" class="card-img-top" alt="">
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
				<?php endwhile; 
					endif; 
					/* Restore original Post Data */
					wp_reset_postdata();	?>
				</div>
				
			</div>
		</div>
	</div>
</section>
<!-- ./ same-caseStudy-sec-->
</div>
<!-- ./ main_wrapper -->
<?php get_footer(); 
