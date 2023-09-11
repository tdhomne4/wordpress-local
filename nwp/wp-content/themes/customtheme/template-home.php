 <?php
/**
 * Template Name: Home
 */
get_header();
?>

<!--Slider image-->
<div class="main_wrapper">
    <section class="banner-sec">
        <div class="hero_slider owl-carousel">
            <?php
                $sliders = get_posts(array(
                    'post_type'     => ['slider'],
                    'numberposts'   => -1
                ));
                foreach ( $sliders as $slider)
                {
                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($slider->ID), 'post'); 
                    $thumb = $thumb[0];
                    $about = get_field('about_us',$slider->ID);
                    $readmore = get_field('read_more',$slider->ID);
                    $about_link = get_field('about_link',$slider->ID);
                    $readmore_link = get_field('readmore_link',$slider->ID);
            ?>
            <div class="item">
                <img src="<?php echo $thumb; ?>" alt="not">
                    <div class="slider_baner">
                        <div class="container">
                            <div class="baner_content">
                                <h1 class="wow fadeInTop animated">
                                    <?php echo $slider->post_title; ?>
                                </h1>
                                
                                <div class="hero_btns wow fadeInUp animated" data-wow-duration="2s">
                                    <a href="<?php echo $about_link ?>" class="btn btn-theme btn-border"><?php echo $about ?></a>
                                    <a href="<?php echo $readmore_link ?>" class="btn btn-theme"><?php echo $readmore ?></a>
                                </div>
                            </div><!--baner_content"-->
                        </div><!--container-->
                    </div><!--slider_baner"-->
                </div><!--item-->
            <?php } ?>
					
	    </div><!--hero_slider owl-carousel-->	
	</section>
	<!-- --------------------------------./ banner section -->

	<!-------------OUR SERVICES-------------------------->	
	<section class="services-sec mb-lg-5 mb-md-4 mb-3">
				<div class="container">
					<div class="services_box white-box box-shadow">
						<div class="main-heading text-center">
						<?php $our_heading = get_field('our_heading',8); ?>
							<h2 class="title"><?php echo $our_heading?></h2>
							<p class="sub-title"><?php $ourtext = get_field('our_text',8);
							echo $ourtext; ?></p>
						</div>
						<div class="services-card">
							<div class="row">
							<?php 
						$one_group = get_field('one_group');
						while( have_rows('one_group') ): the_row(); 

							// Get sub field values.
							$oneimage = get_sub_field('oneimage');
							$one_bodytext = get_sub_field('one_bodytext');
							$onereadmore = get_sub_field('onereadmore');
							$onereadmorelink = get_sub_field('onereadmorelink');
							$onetext = get_sub_field('onetext');
							?>
								<div class="col-md-4 srv_card_box">
					              <div class="card">
					              	<div class="card_serv">
									  <img src="<?php echo $oneimage;  ?>" class="card-img-top" alt="">
						                <div class="srvs_h_capt d-flex align-items-end flex-wrap">
						                	<div class="srvs_capt_inr">
											<h4 class="card-title my-lg-4 my-md-3 my-2"><?php echo $one_bodytext;  ?></h4>
							                	<a href="<?php echo $onereadmorelink ?>" class="read_more"><?php  echo $onereadmore?></a>
							                </div>
						                </div>
						            </div>
					                <h4 class="mb-0"><?php echo $onetext ?></h4>
					              </div>
					            </div>
								<?php endwhile; ?>

						<?php 
						$two_group = get_field('two_group');
						while( have_rows('two_group') ): the_row(); 

						// Get sub field values.
						$twoimage = get_sub_field('twoimage');
						$two_bodytext = get_sub_field('two_bodytext');
						$tworeadmore = get_sub_field('tworeadmore');
						$tworeadmorelink = get_sub_field('tworeadmorelink');
						$twotext = get_sub_field('twotext');
?>
								<div class="col-md-4 srv_card_box">
					              <div class="card">
					              	<div class="card_serv">
									  <img src="<?php echo $twoimage;  ?>" class="card-img-top" alt="">
						                <div class="srvs_h_capt d-flex align-items-end flex-wrap">
						                	<div class="srvs_capt_inr">
											<h4 class="card-title my-lg-4 my-md-3 my-2"><?php echo $two_bodytext;  ?></h4>
							                	<a href="<?php echo $tworeadmorelink ?>" class="read_more"><?php  echo $tworeadmore?></a>
							                </div>
						                </div>
						            </div>
					                <h4 class="mb-0"><?php echo $twotext ?></h4>
					              </div>
					            </div>
								<?php endwhile; ?>



								<?php 
						$three_group = get_field('three_group_');
						while( have_rows('three_group_') ): the_row(); 

						// Get sub field values.
						$threeimage = get_sub_field('threeimage');
						$three_bodytext = get_sub_field('three_bodytext');
						$threereadmore = get_sub_field('threereadmore');
						$threereadmorelink = get_sub_field('threereadmorelink');
						$threetext = get_sub_field('threetext');
?>
								<div class="col-md-4 srv_card_box">
					              <div class="card">
					              	<div class="card_serv">
									  <img src="<?php echo $threeimage;  ?>" class="card-img-top" alt="">
						                <div class="srvs_h_capt d-flex align-items-end flex-wrap">
						                	<div class="srvs_capt_inr">
											<h4 class="card-title my-lg-4 my-md-3 my-2"><?php echo $three_bodytext;  ?></h4>
							                	<a href="<?php echo $threereadmorelink ?>" class="read_more"><?php  echo $threereadmore?></a>
							                </div>
						                </div>
						            </div>
					                <h4 class="mb-0"><?php echo $threetext ?></h4>
					              </div>
					            </div>
								<?php endwhile; ?>
								 <!-- / col-md-4 -->
							</div>
						</div>
						<!-- ./ services-card -->
				    </div>
				</div>
			</section>
			<!-- ./ services-sec -->

  
			          <!-------------THREAT INTELLIGENCE-------------->
			<section class="intelligence-sec my-lg-5 my-md-4 my-3 py-md-4 pt-3">
			   <div class="container">
			   	   <div class="row">
				   	   <div class="col-md-6 col-lg-7">
				   	   	   <div class="main-heading">
                                 <?php $threat_heading = get_field('threat_heading',8); ?>
							  <h2 class="title"><?php echo $threat_heading?> </h2>
                              <?php $threat_text = get_field('threat_text',8); ?>
							  <p class="sub-title ml-0 mr-0"> <?php echo $threat_text?> </p>
						   </div>
						   <div class="thread_desc">
						   	   <div class="abt_int_item d-flex align-items-start flex-wrap mb-4">
						   	   	  <figure>
                                        <?php $icon1 = get_field('icon1',8); ?>
						   	   	      <img src="<?php echo $icon1?>" alt="">	
						   	   	  </figure>
						   	   	  <div class="abt_int_capt">
                                        <?php $threat_h1 = get_field('threat_h1',8); ?>
						   	   	  	  <h4><?php echo $threat_h1 ?></h4>
                                        <?php $threat_h1_text = get_field('threat_h1_text',8); ?>
						   	   	  	  <p><?php echo $threat_h1_text ?></p>
						   	   	  </div>
						   	   </div>
						   	   <!-- ./.abt_int_item -->
						   	   <div class="abt_int_item d-flex align-items-start flex-wrap mb-4">
						   	   	  <figure>
                                        <?php $icon2 = get_field('icon2',8); ?>
						   	   	      <img src="<?php echo $icon2?>" alt="">		
						   	   	  </figure>
						   	   	  <div class="abt_int_capt">
                                        <?php $threat_h2 = get_field('threat_h2',8); ?>
						   	   	  	  <h4><?php echo $threat_h2 ?></h4>
                                        <?php $threat_h2_text = get_field('threat_h2_text',8); ?>
						   	   	  	  <p><?php echo $threat_h2_text ?></p>
						   	   	  </div>
						   	   </div>
						   	   <!-- ./.abt_int_item -->
						   	   <div class="abt_int_item d-flex align-items-start flex-wrap mb-4">
						   	   	  <figure>
                                        <?php $icon3 = get_field('icon3',8); ?>
						   	   	      <img src="<?php echo $icon3?>" alt="">	
						   	   	  </figure>
						   	   	  <div class="abt_int_capt">
                                        <?php $threat_h3 = get_field('threat_h3',8); ?>
						   	   	  	  <h4><?php echo $threat_h3 ?></h4>
                                        <?php $threat_h3_text = get_field('threat_h3_text',8); ?>
						   	   	  	  <p><?php echo $threat_h3_text ?></p>
						   	   	  </div>
						   	   </div>
						   	   <!-- ./.abt_int_item -->
						   </div>
				   	   </div>
				   	   <div class="col-md-6 col-lg-5">
	                       <figure>		
                           <?php $threat_image = get_field('threat_image',8); ?>
						   	   	      <img src="<?php echo $threat_image?>" alt="">		  	   	 
				   	   	   </figure>
				   	   </div>
				   	</div>
			   </div>	
			</section>
			<!-- / intelligence-sec -->

					<!----------INDUSTRIES WE IMPACT--------->
			<section class="we-impact-sec py-lg-5 py-4 sec-bg-gray">
				<div class="container">
					<div class="main-heading text-center">
						   <?php $heading = get_field('heading',8); ?>
						   <h2 class="title"><?php echo $heading; ?></h2>
				   	</div>

				   	<div class="impact_slider owl-carousel pt-md-4 pb-lg-5 pb-md-4 py-3">
					   
				  		<?php
							$sliders = get_posts(array(
								'post_type'     => ['slider2'],
								'numberposts'   => -1 
									));
								foreach ( $sliders as $slider)
								{
								$icon = wp_get_attachment_image_src( get_post_thumbnail_id($slider->ID), 'post');
								$icon = $icon[0]; 
								$text_impact = get_field('text_impact',$slider->ID);
            				?>
							
					
		        			<div class="item">
		        				<div class="impact_capt text-center">
		        					<a href="#">
		        				  		<figure><img src="<?php echo $icon; ?>" alt=""></figure>
		        				  			<h4> <?php echo $text_impact; ?></h4>
		        					</a>
		        				</div>
		        			</div><!--item"-->
						<?php }?>
		        	</div><!--impact_slider owl-carousel pt-md-4 pb-lg-5 pb-md-4 py-3""-->
		        	<!-- ./ impact_slider -->
				</div><!--container-->
			</section><!--we-impact-sec py-lg-5 py-4 sec-bg-gray-->
			<!-- ./ we-impact sec -->

	<!------------------------reach out  post type------------------------->
	<section class="security-srvs-sec mb-lg-5 mb-md-4 mb-4 pb-lg-4 pb-md-3 pb-2">
	    <div class="container">
			<div class="services_box white-box box-shadow">
				<div class="main-heading text-center">
					<h2 class="title mx-w-630"><?php $reachheading = get_field('reach_heading'); 
					echo $reachheading; ?></h2>
				</div>
				
				<div class="services-card">
				<div class="card">
					<div class="row">
					<?php 	$reachs = get_posts(array(
                    		'post_type'     => ['reach'],
                    		'numberposts'   => -1
                			));
                			foreach ( $reachs as $r)
                			{
							$image = wp_get_attachment_image_src( get_post_thumbnail_id($r->ID), 'post'); 
                    		$image = $image[0];
							?>
						<div class="col-md-4 srv_card_box">
							
					        	<div class="card_serv">
						        	<div class="service-fig">
										<img class="card-img-top" src="<?php echo $image ?>" alt="">
						            </div>
									<a href="#" class="btn btn-theme"><?php echo get_the_title($r->ID); ?></a>
								</div>
				        </div> <?php } ?>
					</div>	       <!-- / col-md-4 -->
					</div>
				</div><!-- ./ services-card -->
			</div>
		</div>	
	</section>


			<!-- ./ security-srvs-sec -->
			<section class="case-study-sec my-lg-5 my-md-4 my-3">
				<div class="container">
					<div class="main-heading text-center">
					   <h2 class="title"><?php $heading = get_field('case_study_heading'); 
					    echo $heading ; ?></h2>
				    </div>
				    <div class="caseStudy_listing">
				    	<div class="row">
						<?php $myarray = array(476,479,482);  
					   $args = array(
	 		            'post_type' => 'casestudy',
	 			        'post__in' => $myarray,
 				        );
                           
						$the_query = new WP_Query( $args );
						if ( $the_query->have_posts() ) :
						while ( $the_query->have_posts() ) :
								$the_query->the_post();
						?>
				    	<div class="col-md-4">
							<div class="card case-card-box">
			    				<div class="case-card-head">
									<img src="<?php echo  get_the_post_thumbnail();?>" class="card-img-top" alt="">
								</div>
										
								<div class="card-body ">
									<div class="tag-button">
										<a href="#"><?php echo the_category() ; ?></a>
									</div>
									<h4 class="card-title my-lg-4 my-md-3 my-2"><?php echo the_title() ; ?></h4>
								 	<a href="<?php the_permalink(); ?>" class="read_more_btn"><?php echo the_excerpt();?></a>
								</div> 
							</div>		
						</div><!--<div class="col-md-4">-->
						<?php endwhile; 
								endif; 
							/* Restore original Post Data */
						wp_reset_postdata();	?>
				    </div><!--row-->

				    <div class="load-more-post mt-lg-5 mt-md-4 mt-3  pb-3 text-center">
				    	<button type="button" class="btn btn-theme">View More</button>
						
				    </div>
				</div><!--caseStudy_listing-->
			</div><!--container-->
		</section>
			<!-- ./ case-study-sec-->

	<!-----------------------------BLOGS--------------------------->
	<section class="blog-sec mb-lg-5 mb-md-4 mb-3 pb-2">
		<div class="container">
    		<div class="main-heading text-center">
				<h2 class="title"><?php $heading = get_field('blogheading',8);?>
					<?php echo $heading; ?></h2>
			</div>
		</div>
		<div class="blog_slider owl-carousel">
			<?php
    		$args = array(
         'post_type' => 'post',
         'post_status' => 'publish',
         'posts_per_page' => 3
         );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) :
                $the_query->the_post();
                ?>
    <div class="item">
        <div class="blog-post">
            <div class="blog-details">
                <span class="blog-date"><?php echo get_the_date() ; ?></span>
                    <div class="blog-fig">
                        <img src="<?php echo get_the_post_thumbnail(); ?>">
                    </div>
                        <div class="blog-capt">
                            <p><?php echo get_the_title() ; ?></p>
                        </div>
            </div>
            <div class="overlay d-flex align-items-center justify-content-center">
               <a href="<?php the_permalink(); ?>">
               <img src="<?php echo home_url(); ?>/wp-content/uploads/2021/04/plus_icon.png" alt="">
                 </a>
            </div>
        </div>
    </div> 
            
        <?php endwhile; //while loop
			endif; //if close
     

        /* Restore original Post Data */
        wp_reset_postdata();
?>		</div>

    

   
		
	</section>
</div><!-- ./ main_wrapper -->
        <?php get_footer();?>
		
		