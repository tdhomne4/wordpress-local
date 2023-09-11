<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>
<div class="main_wrapper">
			<section class="banner-sec">
				<div class="hero_slider owl-carousel">
	        		<div class="item">
	        			<img src="<?php bloginfo('template_directory')?>/assets/images/hero-slide1.jpg">
	        			<div class="slider_baner">
			        		<div class="container">
			        			<div class="baner_content">
			        				<h1 class="wow fadeInTop animated">Cybersecurity An Art Form To Secure Your Connected World.</h1>
			        				<div class="hero_btns wow fadeInUp animated" data-wow-duration="2s">
			        					<a href="#" class="btn btn-theme btn-border">About Us</a>
			        					<a href="#" class="btn btn-theme">Read More</a>
			        				</div>
			        			</div>	
			        		</div>
			        	</div>
	        		</div>
					<div class="item">
	        			<img src="<?php bloginfo('template_directory')?>/assets/images/hero-slide2.jpg">
	        			<div class="slider_baner">
			        		<div class="container">
			        			<div class="baner_content">
			        				<h1 class="wow fadeInLeft animated">REALLY PROTECTING WHAT MATTERS </h1>
			        				<div class="hero_btns waw fadeInUp  animated" data-wow-duration="2s">
			        					<a href="#" class="btn btn-theme btn-border">About Us</a>
			        					<a href="#" class="btn btn-theme">Read More</a>
			        				</div>
			        			</div>	
			        		</div>
			        	</div>
	        		</div>
	        		<div class="item">
	        			<img src="<?php bloginfo('template_directory')?>/assets/images/hero-slide3.jpg">
	        			<div class="slider_baner">
			        		<div class="container">
			        			<div class="baner_content">
			        				<h1 class="wow fadeInRight animated text-uppercase">Reducing Risk with Technology</h1>
			        				<div class="hero_btns waw fadeInUp  animated" data-wow-duration="2s">
			        					<a href="#" class="btn btn-theme btn-border">About Us</a>
			        					<a href="#" class="btn btn-theme">Read More</a>
			        				</div>
			        			</div>	
			        		</div>
			        	</div>
	        		</div>
	        	</div>	
			</section>
			<!-- ./ banner section -->
			<section class="services-sec mb-lg-5 mb-md-4 mb-3">
				<div class="container">
					<div class="services_box white-box box-shadow">
						<div class="main-heading text-center">
							<h2 class="title">Our Services</h2>
							<p class="sub-title">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
						</div>
						<div class="services-card">
							<div class="row">
								<div class="col-md-4 srv_card_box">
					              <div class="card">
					              	<div class="card_serv">
						              	<div class="service-fig"><img class="card-img-top" src="<?php bloginfo('template_directory')?>/assets/images/service-img1.jpg" alt=""></div>
						                <div class="srvs_h_capt d-flex align-items-end flex-wrap">
						                	<div class="srvs_capt_inr">
							                	<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula rient.</p>
							                	<a href="#" class="read_more">Read More</a>
							                </div>
						                </div>
						            </div>
					                <h4 class="mb-0">User Protection</h4>
					              </div>
					            </div>
					            <!-- / col-md-4 -->
					            <div class="col-md-4 srv_card_box">
					              <div class="card">
					              	<div class="card_serv">
						              	<div class="service-fig"><img class="card-img-top" src="<?php bloginfo('template_directory')?>/assets/images/service-img2.jpg" alt=""></div>
						                <div class="srvs_h_capt d-flex align-items-end flex-wrap">
						                	<div class="srvs_capt_inr">
							                	<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula rient.</p>
							                	<a href="#" class="read_more">Read More</a>
							                </div>
						                </div>
						            </div>
					                <h4 class="mb-0">Network Security</h4>
					              </div>
					            </div>
					            <!-- / col-md-4 -->
					            <div class="col-md-4 srv_card_box">
					              <div class="card">
					              	<div class="card_serv">
						              	<div class="service-fig"><img class="card-img-top" src="<?php bloginfo('template_directory')?>/assets/images/service-img3.jpg" alt=""></div>
						                <div class="srvs_h_capt d-flex align-items-end flex-wrap">
						                	<div class="srvs_capt_inr">
							                	<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula rient.</p>
							                	<a href="#" class="read_more">Read More</a>
							                </div>
						                </div>
						            </div>
					                <h4 class="mb-0">Physical Security</h4>
					              </div>
					            </div>
					            <!-- / col-md-4 -->
							</div>
						</div>
						<!-- ./ services-card -->
				    </div>
				</div>
			</section>
			<!-- ./ services-sec -->
			<section class="intelligence-sec my-lg-5 my-md-4 my-3 py-md-4 pt-3">
			   <div class="container">
			   	   <div class="row">
				   	   <div class="col-md-6 col-lg-7">
				   	   	   <div class="main-heading">
							  <h2 class="title">Threat Intelligence </h2>
							  <p class="sub-title ml-0 mr-0">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
						   </div>
						   <div class="thread_desc">
						   	   <div class="abt_int_item d-flex align-items-start flex-wrap mb-4">
						   	   	  <figure>
						   	   	      <img src="<?php bloginfo('template_directory')?>/assets/images/icon-1.png" alt="">	
						   	   	  </figure>
						   	   	  <div class="abt_int_capt">
						   	   	  	  <h4>Ransom ware</h4>
						   	   	  	  <p>Lorem ipsum dolor sit amet, consectetuer Aenean commodo ligula eget dolor.Cum sociis natoque penatibus et magnis dis parturient montes a enean commodo ligula ege. </p>
						   	   	  </div>
						   	   </div>
						   	   <!-- ./.abt_int_item -->
						   	   <div class="abt_int_item d-flex align-items-start flex-wrap mb-4">
						   	   	  <figure>
						   	   	      <img src="<?php bloginfo('template_directory')?>/assets/images/icon-2.png" alt="">	
						   	   	  </figure>
						   	   	  <div class="abt_int_capt">
						   	   	  	  <h4>Phishing</h4>
						   	   	  	  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.Cum sociis natoque penatibus et magnis disent montes. </p>
						   	   	  </div>
						   	   </div>
						   	   <!-- ./.abt_int_item -->
						   	   <div class="abt_int_item d-flex align-items-start flex-wrap mb-4">
						   	   	  <figure>
						   	   	      <img src="<?php bloginfo('template_directory')?>/assets/images/icon-3.png" alt="">	
						   	   	  </figure>
						   	   	  <div class="abt_int_capt">
						   	   	  	  <h4>Cloud Security</h4>
						   	   	  	  <p>Lorem ipsum dolor sit amet, consectetuer Aenean commodo ligula eget dolor.Cum sociis natoque penatibus et magnis dis parturient montes a enean commodo ligula ege. </p>
						   	   	  </div>
						   	   </div>
						   	   <!-- ./.abt_int_item -->
						   </div>
				   	   </div>
				   	   <div class="col-md-6 col-lg-5">
	                       <figure>		
	                           <img src="<?php bloginfo('template_directory')?>/assets/images/inte-abt.png" alt="">	   	   	 
				   	   	   </figure>
				   	   </div>
				   	</div>
			   </div>	
			</section>
			<!-- / intelligence-sec -->
			<section class="we-impact-sec py-lg-5 py-4 sec-bg-gray">
				<div class="container">
					<div class="main-heading text-center">
					  <h2 class="title">Industries We Impact </h2>
				   </div>
				   <div class="impact_slider owl-carousel pt-md-4 pb-lg-5 pb-md-4 py-3">
		        		<div class="item">
		        			<div class="impact_capt text-center">
		        				<a href="#">
		        				  <figure><img src="<?php bloginfo('template_directory')?>/assets/images/impact-img1.png" alt=""></figure>
		        				  <h4>Construction</h4>
		        				</a>
		        			</div>
		        		</div>
						<div class="item">
		        			<div class="impact_capt text-center">
		        				<a href="#">
			        				<figure><img src="<?php bloginfo('template_directory')?>/assets/images/impact-img2.png" alt=""></figure>
			        				<h4>Education</h4>
			        			</a>
		        			</div>
		        		</div>
		        		<div class="item">
		        			<a href="#">
			        			<div class="impact_capt text-center">
			        				<figure><img src="<?php bloginfo('template_directory')?>/assets/images/impact-img3.png" alt=""></figure>
			        				<h4>Transportation</h4>
			        			</div>
			        		</a>
		        		</div>
		        		<div class="item">
		        			<div class="impact_capt text-center">
		        				<a href="#">
			        				<figure><img src="<?php bloginfo('template_directory')?>/assets/images/impact-img4.png" alt=""></figure>
			        				<h4>Transportation</h4>
			        			</a>
		        			</div>
		        		</div>
		        		<div class="item">
		        			<div class="impact_capt text-center">
		        				<a href="#">
			        				<figure><img src="<?php bloginfo('template_directory')?>/assets/images/impact-img1.png" alt=""></figure>
			        				<h4>Construction</h4>
			        			</a>
		        			</div>
		        		</div>
						<div class="item">
		        			<div class="impact_capt text-center">
		        				<a href="#">
			        				<figure><img src="<?php bloginfo('template_directory')?>/assets/images/impact-img2.png" alt=""></figure>
			        				<h4>Education</h4>
			        			</a>
		        			</div>
		        		</div>
		        		<div class="item">
		        			<div class="impact_capt text-center">
		        				<a href="#">
			        				<figure><img src="<?php bloginfo('template_directory')?>/assets/images/impact-img3.png" alt=""></figure>
			        				<h4>Transportation</h4>
			        			</a>
		        			</div>
		        		</div>
		        	</div>
		        	<!-- ./ impact_slider -->
				</div>
			</section>
			<!-- ./ we-impact sec -->
			<section class="security-srvs-sec mb-lg-5 mb-md-4 mb-4 pb-lg-4 pb-md-3 pb-2">
			    <div class="container">
			    	<div class="services_box white-box box-shadow">
						<div class="main-heading text-center">
							<h2 class="title mx-w-630">Reach Out To The World’s Most Reliable Cyber Security Services</h2>						
						</div>
						<div class="services-card">
							<div class="row">
								<div class="col-md-4 srv_card_box">
					              <div class="card">
					              	<div class="card_serv">
						              	<div class="service-fig"><img class="card-img-top" src="<?php bloginfo('template_directory')?>/assets/images/service-img4.jpg" alt=""></div>
						            </div>
					                <a href="#" class="btn btn-theme">Get A Quote</a>
					              </div>
					            </div>
					            <!-- / col-md-4 -->
					            <div class="col-md-4 srv_card_box">
					              <div class="card">
					              	<div class="card_serv">
						              	<div class="service-fig"><img class="card-img-top" src="<?php bloginfo('template_directory')?>/assets/images/service-img5.jpg" alt=""></div>
						            </div>
					                <a href="#" class="btn btn-theme">Book Demo</a>
					              </div>
					            </div>
					            <!-- / col-md-4 -->
					            <div class="col-md-4 srv_card_box">
					              <div class="card">
					              	<div class="card_serv">
						              	<div class="service-fig"><img class="card-img-top" src="<?php bloginfo('template_directory')?>/assets/images/service-img6.jpg" alt=""></div>
						            </div>
					                 <a href="#" class="btn btn-theme">Talk To Expert</a>
					              </div>
					            </div>
					            <!-- / col-md-4 -->
							</div>
						</div>
						<!-- ./ services-card -->
				    </div>
			    </div>	
			</section>
			<!-- ./ security-srvs-sec -->
			<section class="case-study-sec my-lg-5 my-md-4 my-3">
				<div class="container">
					<div class="main-heading text-center">
					   <h2 class="title">Case Study</h2>
				    </div>
				    <div class="caseStudy_listing">
				    	<div class="row">
				    		<div class="col-md-4">
				    			<div class="card case-card-box">
			    				  <div class="case-card-head">
								     <img src="<?php bloginfo('template_directory')?>/assets/images/case-s-img1.jpg" class="card-img-top" alt="">
								  </div>
								  <div class="card-body">
								  	<a href="#" class="tag-button">Education</a>
								    <h4 class="card-title my-lg-4 my-md-3 my-2">Preparing people for a successful career</h4>
								    <a href="#" class="read_more_btn">Read More</a>
								  </div>
								</div>
				    		</div>
				    		<!-- ./col-md-4  -->
				    		<div class="col-md-4">
				    			<div class="card case-card-box">
			    				  <div class="case-card-head">
								     <img src="<?php bloginfo('template_directory')?>/assets/images/case-s-img2.jpg" class="card-img-top" alt="">
								  </div>
								  <div class="card-body">
								  	<a href="#" class="tag-button">Technology</a>
								    <h4 class="card-title my-lg-4 my-md-3 my-2">Preparing people for a successful career</h4>
								    <a href="#" class="read_more_btn">Read More</a>
								  </div>
								</div>
				    		</div>
				    		<!-- ./col-md-4  -->
				    		<div class="col-md-4">
				    			<div class="card case-card-box">
			    				  <div class="case-card-head">
								     <img src="<?php bloginfo('template_directory')?>/assets/images/case-s-img3.jpg" class="card-img-top" alt="">
								  </div>
								  <div class="card-body">
								  	<a href="#" class="tag-button">Cyber</a>
								    <h4 class="card-title my-lg-4 my-md-3 my-2">Preparing people for a successful career</h4>
								    <a href="#" class="read_more_btn">Read More</a>
								  </div>
								</div>
				    		</div>
				    		<!-- ./col-md-4  -->
				    	</div>
				    	<div class="load-more-post mt-lg-5 mt-md-4 mt-3  pb-3 text-center">
				    		<button type="button" class="btn btn-theme">Load More</button>
				    	</div>
				    </div>

				</div>
			</section>
			<!-- ./ case-study-sec-->
			<section class="blog-sec mb-lg-5 mb-md-4 mb-3 pb-2">
				<div class="container">
					<div class="main-heading text-center">
					   <h2 class="title">Blogs</h2>
				    </div>
				</div>
				<div class="blog_slider owl-carousel">
	        		<div class="item">
	        			<div class="blog-post">
	        				<div class="blog-details">
	        					<span class="blog-date">8-6-2019</span>
		        				<div class="blog-fig"><img src="<?php bloginfo('template_directory')?>/assets/images/blog-post1.png" alt=""></div>
		        				<div class="blog-capt">
		        					<p>Web Camera Security Armtec inc.</p>
		        				</div>
		        			</div>
	        				<div class="overlay d-flex align-items-center justify-content-center">
	        				   <a href="#"><img src="<?php bloginfo('template_directory')?>/assets/images/plus_icon.png" alt=""></a>
	        				</div>
	        			</div>
	        		</div>

	        		<div class="item">
	        			<div class="blog-post">
	        				<div class="blog-details">
	        					<span class="blog-date">8-6-2019</span>
		        				<div class="blog-fig"><img src="<?php bloginfo('template_directory')?>/assets/images/blog-post2.png" alt=""></div>
		        				<div class="blog-capt">
		        					<p>Web Camera Security Armtec inc.</p>
		        				</div>
		        			</div>
	        				<div class="overlay d-flex align-items-center justify-content-center">
	        				   <a href="#"><img src="<?php bloginfo('template_directory')?>/assets/images/plus_icon.png" alt=""></a>
	        				</div>
	        			</div>
	        		</div>

	        		<div class="item">
	        			<div class="blog-post">
	        				<div class="blog-details">
	        					<span class="blog-date">8-6-2019</span>
		        				<div class="blog-fig"><img src="<?php bloginfo('template_directory')?>/assets/images/blog-post3.png" alt=""></div>
		        				<div class="blog-capt">
		        					<p>Web Camera Security Armtec inc.</p>
		        				</div>
		        			</div>
	        				<div class="overlay d-flex align-items-center justify-content-center">
	        				   <a href="#"><img src="<?php bloginfo('template_directory')?>/assets/images/plus_icon.png" alt=""></a>
	        				</div>
	        			</div>
	        		</div>

	        		<div class="item">
	        			<div class="blog-post">
	        				<div class="blog-details">
	        					<span class="blog-date">8-6-2019</span>
		        				<div class="blog-fig"><img src="<?php bloginfo('template_directory')?>/assets/images/blog-post4.png" alt=""></div>
		        				<div class="blog-capt">
		        					<p>Web Camera Security Armtec inc.</p>
		        				</div>
		        			</div>
	        				<div class="overlay d-flex align-items-center justify-content-center">
	        				   <a href="#"><img src="<?php bloginfo('template_directory')?>/assets/images/plus_icon.png" alt=""></a>
	        				</div>
	        			</div>
	        		</div>

	        		<div class="item">
	        			<div class="blog-post">
	        				<div class="blog-details">
	        					<span class="blog-date">8-6-2019</span>
		        				<div class="blog-fig"><img src="<?php bloginfo('template_directory')?>/assets/images/blog-post5.png" alt=""></div>
		        				<div class="blog-capt">
		        					<p>Web Camera Security Armtec inc.</p>
		        				</div>
		        			</div>
	        				<div class="overlay d-flex align-items-center justify-content-center">
	        				   <a href="#"><img src="<?php bloginfo('template_directory')?>/assets/images/plus_icon.png" alt=""></a>
	        				</div>
	        			</div>
	        		</div>

	        		<div class="item">
	        			<div class="blog-post">
	        				<div class="blog-details">
	        					<span class="blog-date">8-6-2019</span>
		        				<div class="blog-fig"><img src="<?php bloginfo('template_directory')?>/assets/images/blog-post1.png" alt=""></div>
		        				<div class="blog-capt">
		        					<p>Web Camera Security Armtec inc.</p>
		        				</div>
		        			</div>
	        				<div class="overlay d-flex align-items-center justify-content-center">
	        				   <a href="#"><img src="<?php bloginfo('template_directory')?>/assets/images/plus_icon.png" alt=""></a>
	        				</div>
	        			</div>
	        		</div>
		        </div>
			</section>
		     
<?php
get_footer();