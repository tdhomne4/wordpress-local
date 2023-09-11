<?php 
/**
 * Template Name: Blog
 */
get_header();

?>
<div class="main_wrapper">
	<section class="inner-banner d-flex align-items-center" style="background-image: url('<?php echo  home_url(); ?>/wp-content/uploads/2021/04/inner-banner2.jpg')">
		<div class="container">
			<div class="inr-bnr-ttl text-center">
				<h2><?php echo get_the_title(); ?></h2>
			</div>
		</div>
	</section><!-- ./ inner-banner -->
	
	<section class="blogs-sec mb-lg-5 mb-md-4 mb-3 pb-2 mt-70">
		<div class="container">
			<div class="blogs-listing white-box box-shadow p-30">
			   	<div class="row">
                    <div class="col-md-8 aside-articles">
					
                   
                      	<div class="blog-filter d-md-none d-block mb-3">
                            <div class="search-posts mb-3 ">
                                <form class="search-form">
                                    <div class="search-grp-field">
                                        <input type="text" class="form-control" name="" value="" placeholder="Search">
                                        <button class="btn-search btn" type="button"><i class="fa fa-search"></i></button>
                                    </div>
				                </form>
                            </div><!-- ./ end search-posts -->
                           
						</div>
                        <div class="blog-articles">
						
                                	<div class="blog-article-item">
                                        <div class="blog-article-card">
										<?php     
					  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
					$args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 2,
					'paged' => $paged
                                    );
                    $the_query = new WP_Query( $args );
                    if ( $the_query->have_posts() ) :
                        while ( $the_query->have_posts() ) :
                                $the_query->the_post();
                ?>
                <figure class="blog-figure">
                <?php echo get_the_post_thumbnail(get_the_ID(),'custom-size' ); ?>
        		<span class="tag-button tag-rounded"><?php echo the_category(); ?></span>
               	</figure>
                <div class="blog-details">
                    <div class="blog-post-date mb-lg-4 mb-md-3 mb-2">
                		<strong class="author-name"><?php echo the_author(); ?></strong><span class="b-post-date"><?php echo the_date(); ?></span>
                    </div>
                	<h3 class="title-24 mb-lg-4 mb-md-3 mb-2">
						<?php echo the_title(); ?>
					</h3>
                    <a href="<?php the_permalink(); ?>" class="btn btn-theme"><?php echo the_excerpt(); ?></a>
                </div>
            	<?php endwhile;
				
                    endif; 
                    wp_reset_postdata();?>   
			</div>
      	</div> 	<!-- ./ blog-article-item -->
    </div>
    <div class="Page navigation pagination-page my-md-3 my-2">
		<ul class="pagination">
			<li class="page-item prev-btn disabled">
				<?php wp_pagenavi(array('query'=>$the_query,));?>
			</li>
		</ul>
	</div>
</div>
				    		<!-- ./ aside-articles end -->
				    		<div class="col-md-4 aside-sidebar">
				    			<div class="search-posts mb-lg-4 mb-3 d-md-block d-none">
				    				<form class="search-form">
				    					<div class="search-grp-field">
				    						<input type="text" class="form-control" name="" value="" placeholder="Search">
                                            <button class="btn-search btn" type="button"><i class="fa fa-search"></i></button>
				    					</div>
				    				</form>
				    			</div>
				    			<!-- ./ end search-posts -->
				    			<div class="sidebar-category mb-lg-4 mb-3 d-md-block d-none">
				    				<h4 class="aside-ttl mb-3">Categories</h4>
				    				<ul class="category-links">
				    					<li><a href="#">Cyber Security <span class="c-label">(5)</span></a></li>
				    					<li><a href="#">Protection <span class="c-label">(3)</span></a></li>
				    					<li><a href="#">Technology <span class="c-label">(8)</span></a></li>
				    					<li><a href="#">Support <span class="c-label">(2)</span></a></li>
				    					<li><a href="#">Networking <span class="c-label">(5)</span></a></li>
				    				</ul>
				    			</div>
				    			<!-- ./end sidebar-category  -->
				    			<div class="tags-listing my-lg-5 my-md-4 my-3">
				    				<h4 class="aside-ttl">Tags</h4>
				    				<div class="tags-list">
					    				<a class="tag-btn-sm" href="javascript:void(0);">Security</a>
					    				<a class="tag-btn-sm active" href="javascript:void(0);">Technology</a>
					    				<a class="tag-btn-sm" href="javascript:void(0);">Web</a>
					    				<a class="tag-btn-sm" href="javascript:void(0);">Support</a>
					    				<a class="tag-btn-sm" href="javascript:void(0);">Protection</a>
					    			</div>
				    			</div>
				    			<!-- ./end tags-listing -->
				    			<div class="recent-comment">
				    				<h4 class="aside-ttl mb-3">Recent Comment</h4>
				    				<ul class="recent-commt-list">
				    					<li class="rec-comment-item">
				    						<strong>Lorem Ipsum</strong> 
				    					    <span>is simply dummy text of the printing and typesetting industry.</span>
				    					</li>
				    					<li class="rec-comment-item">
				    						<strong>Lorem Ipsum</strong> 
				    					    <span>is simply dummy text of the printing and typesetting industry.</span>
				    					</li>
				    					<li class="rec-comment-item">
				    						<strong>Lorem Ipsum</strong> 
				    					    <span>is simply dummy text of the printing and typesetting industry.</span>
				    					</li>
				    					<li class="rec-comment-item">
				    						<strong>Lorem Ipsum</strong> 
				    					    <span>is simply dummy text of the printing and typesetting industry.</span>
				    					</li>
				    				</ul>
				    			</div>
				    		</div>
				    		<!-- ./ aside-sidebar end -->
				    	</div>
				    </div>
				</div>
			</section>
			<!-- /. case-study-destails -->
		</div>
		<!-- ./ main_wrapper -->
	<?php get_footer(); 