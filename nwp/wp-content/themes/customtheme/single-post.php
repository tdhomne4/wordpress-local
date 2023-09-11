<?php get_header(); ?>
<div class="main_wrapper">
			<section class="inner-banner d-flex align-items-center" style="background-image: url('<?php echo  home_url(); ?>/wp-content/uploads/2021/04/inner-banner2.jpg')">
				<div class="container">
					<div class="inr-bnr-ttl text-center">
                    <?php 
						while ( have_posts() ) :
						the_post();?>
					 <h2><?php echo the_title(); ?></h2>
					 <?php  endwhile; ?>
					</div>
				</div>
			</section>
			<!-- ./ inner-banner -->
	<section class="blogs-destails-sec mb-lg-5 mb-md-4 mb-3 pb-2  mt-70">
		<div class="container">
			<div class="blog-details-cont white-box box-shadow p-30">
			    <div class="blogs_content">
					<div class="row">
                    <?php //loop
					while ( have_posts() ) :
					the_post();
				
					get_template_part( 'template-parts/content/content', 'blog' );
				
							endwhile; // End the loop.
							?> 		
					    <!-- ./ end post-comment -->
					</div>
				</div>
            </div>
        </div>
	</section>
			<!-- /. blogs-destails-sec -->
		</div>
		<!-- ./ main_wrapper -->
    <?php get_footer();