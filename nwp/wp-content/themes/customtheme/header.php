
<!DOCTYPE html>
	<html dir="ltr" <?php language_attributes(); ?>>
	<head>
		<!-- Meta Tags -->
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width,initial-scale=1.0, user-scalable=no"/>
		<!-- Page Title -->
		<title><?php wp_title('');  bloginfo( 'name' ); ?></title>
		<!-- Style sheet -->
		<!--[if lt IE 9]>
		 <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
         <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

		<header class="main_header">
			<?php dynamic_sidebar('Title Bar');?>

			<!--*************navbar menu*******************-->
			<nav class="navbar navbar-expand-lg navbar-header">
				<div class="container">
					<a class="navbar-brand brand_logo" href="#">
						<?php
						if(function_exists('the_custom_logo'))
						{
							$custom_logo_id = get_theme_mod('custom_logo');
							$logo = wp_get_attachment_image_src($custom_logo_id);
						}
						?>
						<img  src="<?php  echo $logo[0] ?>" alt="LOGO">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					    <span class="navbar-toggler-icon"></span>
			        </button>
			
         
            
					<!-- mobile search -->
					<div class="mobile-search">
				        <button class="btn_search" type="button">
							<i class="fa fa-search" aria-hidden="true"></i>
						</button>

				        <div class="cust_search">
				           <form class="form_search">
				           	   <input type="text" name="" value="" placeholder="">
                               <button class="btn_search" type="button">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
				           </form>
				        </div> <!-- <div class="cust_search">-->
					</div><!-- <div class="mobile-search">-->
						
				
					<!--************ mobile search ./navbar menu**********************  -->
			
					<div class="collapse navbar-collapse navbar_menu " id="navbarNavDropdown">
					<?php 	wp_nav_menu(
						   array(
							   	'menu' => 'Main Menu',
								'container'=>'collapse navbar-collapse navbar_menu ',
								'items_wrap'=> '<ul class="navbar-nav main_navmenu">%3$s</ul>'
						   )
						   );
					
					?>	
		
						<?php dynamic_sidebar('Search Bar');?>
					</div><!--collapse navbar-collapse navbar_menu-->
				</div><!--container-->
			</nav>
		</header>
		<!-- /.End Header -->