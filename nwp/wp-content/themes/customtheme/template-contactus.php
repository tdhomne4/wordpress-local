<?php
/**
 * Template Name: Contact Us
 */
get_header();
?>
<div class="main_wrapper">
    <section class="inner-banner d-flex align-items-center" style="background-image: url('<?php echo  home_url(); ?>/wp-content/uploads/2021/04/inner-banner3.jpg')">
	    <div class="container">
			<div class="inr-bnr-ttl text-center">
				<h2><?php echo get_the_title(81); ?></h2>
			</div>
		</div>
	</section>
	<!-- ./ inner-banner -->
    <section class="contact-security-sec mb-lg-5 mb-md-4 mb-4 pb-2">
        <div class="container">
            <div class="services_box white-box box-shadow">
                <div class="main-heading text-center">
                    <h2 class="title mx-w-630">Reach Out To The World’s Most Reliable Cyber Security Services</h2>
                </div>
                <div class="services-card pt-lg-4 pt-md-3 pt-0">
                    <div class="row">
                        <?php  $args = array(
	 		            'post_type' => 'reach',
	 			        'post_status' => 'publish',
	 			        'posts_per_page' => -1
 				        );
                        $the_query = new WP_Query( $args );
                        if ( $the_query->have_posts() ) :
                        while ( $the_query->have_posts() ) :
                            $the_query->the_post();
						?>
                            
                        <div class="col-md-4 srv_card_box">
                            <div class="card">
                                <div class="card_serv">
                                    <div class="service-fig">
                                        <img class="card-img-top" src="<?php echo  get_the_post_thumbnail();?>"></div>
                                    </div>
                                    <a href="#" class="btn btn-theme"><?php echo the_title(); ?></a>
                                </div>
                            </div>
                            <?php endwhile; 
							endif;
							wp_reset_postdata();	
                            ?>
                        </div>
                    </div>
                    <!-- ./ services-card -->
                </div>
            </div>  
        </section>
            <!-- ./ contact-security-sec -->
            <section class="contact-sec my-lg-5 my-md-4 my-3 py-md-2 py-0">
                <div class="container"> 
                    <div class="row">
                        <div class="col-md-12 col-lg-4 mb-lg-0 mb-3">
                            <div class="contact-block quick-contact">
                            <?php $heading = get_field('heading',81);
                            $text = get_field('text',81);
                            $address_field = get_field('address_field',81);
                            $addrestext = get_field('addrestext',81);
                            $emailfield = get_field('emailfield',81);
                            $email = get_field('email',81);
                            $phone = get_field('phone',81);
                            $number = get_field('number',81);
                         ?>
                                <h4 class="title-24 mb-md-4 mb-3 mt-md-1 mt-0"><?php echo $heading ?></h4>
                                <h5 class="mb-md-4 mb-3"><?php echo $text ?></h5>
                                <ul class="contact-info">
                                    <li class="cnt-addres">
                                        <h5><?php echo $address_field ?></h5>
                                        <span><?php echo $addrestext ?></span>
                                    </li>
                                    <li class="cnt-email">
                                        <h5><?php echo $emailfield ?></h5>
                                        <span><?php echo $email ?></span>
                                    </li>
                                    <li class="cnt-phone">
                                        <h5><?php echo $phone ?></h5>
                                        <span><?php echo $number; ?></span>
                                    </li>
                                </ul>
                                <ul class="social-links">
                                    <li>
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                    </li> 
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4 mb-lg-0 mb-3">
                            <div class="contact-block contact-form">
                                <h4 class="title-24 mb-md-4 mb-3 mt-md-1 mt-0">Send Message Us</h4>
                                <div class="cont-mail-form">
                                   
                                       
                                    <?php echo do_shortcode( '[contact-form-7 id="652" title="Send Message Us"]') ?>
                                   
                                </div>
                            </div>
                        </div>
                        <?php   
                           ?>
                        <div class="col-md-12 col-lg-4  mb-lg-0 mb-3">
                            <div class="contact-block contact-map p-0">
                                <div class="map-frame">
                                <?php $image = get_field('textarea',81); 
					    ?>
                                    <iframe src="<?php echo $image; ?>" width="337" height="441" 
                                    style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>
                  
                    </div>
                </div>
            </section>
            <!-- ../ contact-sec-->
		</div>

        <?php get_footer();