<?php 
/**
 * Template Name: Product And Services
 */
get_header(); ?>
		<div class="main_wrapper">
			<section class="inner-banner d-flex align-items-center" 
      style="background-image: url('<?php echo  home_url(); ?>/wp-content/uploads/2021/04/inner-banner2.jpg')">
				<div class="container">
					<div class="inr-bnr-ttl text-center">
						 <h2><?php echo get_the_title(); ?></h2>
					</div>
				</div>
			</section>
			<!-- ./ inner-banner -->
  <section class="prod-service-sec mb-lg-5 mb-md-4 mb-3 pb-lg-5 pb-md-4 pb-3 mt-70">
    <div class="container">
      <div class="prod-srvs-cont white-box box-shadow p-30">
                        <!-- Nav tabs -->
        <div class="prod-srvs-tabs">
          <div class="row">
            <div class="col-md-4 tabs-aside">
              <h4 class="title-24 mb-3">
              <?php echo get_the_title(63); ?>
              </h4>
              <div class="tabs_side_menu">
                <ul class="treeview_menu">
                 <?php
                 
                  $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                  );
                  $the_query = new WP_Query($args);
                  if ($the_query->have_posts()) :
                    while ($the_query->have_posts()) :
                    $the_query->the_post();
                      $categories = get_the_category();
                      ?>
                  <li class="treeview">
                    <a href="javascript:void(0);">
                      <span class="fa fa-plus tree-icon"></span> 
                      <?php echo $categories[0]->name;  ?></a>
                    
                      <ul class="nav tabs-nav-menu treeview-submenu">
                        <?php     
                         $posts = get_posts(array(
                        'post_type'    => 'product'
                        ));
                        $i =1;
                        foreach($posts as $p):
                        ?>
                        <li class="tab-menu-item">
                            <?php 
                            if($i  == 1){?>
                            <a class="tab-link active" data-toggle="tab"
                              href="#tabs-menu<?php echo $i; ?>">
                              <?php echo  $p->post_title;  ?></a>
                              <?php  }
                            else  {  ?>
                          <a class="tab-link " data-toggle="tab"
                              href="#tabs-menu<?php echo $i; ?>">
                              <?php echo  $p->post_title;  ?></a>
                              <?php   } ?>
                          
                        </li><!--tab-menu-item-->
                        <?php 
                      $i++;
                      endforeach; ?>
                      </ul><!--nav tabs-nav-menu treeview-submenu-->
                  </li><!--treeview-->
                </ul><!--treeview_menu-->
               <?php endwhile;
               endif; ?>
             </div><!--tabs_side_menu-->
          </div><!--col-md-4 tabs-aside-->
          <!-- -----------------Tab panes----------- -->
                          
          <div class="col-md-8 tabs-cont-right">
            <div class="tab-content" id="content" role="tablist">
              <h3 class="acc-ttl">USER PROTECTION</h3>
           <?php     
              $posts = get_posts(array(
             'post_type'    => 'product'
             ));
                  $i= 1;
                  foreach ($posts as $p) :
                    if($i==1){$cls = 'active';}
                    else{$cls ='';}
                  ?>
                      <div id="tabs-menu<?php echo $i; ?>" class="card tab-pane <?php echo $cls; ?> fade show" role="tabpanel" aria-labelledby="tabs-1">


                          <div id="tabs-menu<?php echo $i; ?>" class="collapse show" aria-labelledby="heading-1" data-parent="#content">
                              <div class="card-body">
                                  <h4 class="title-24 mb-md-4 mb-3">
                                      <?php echo $p->post_title; ?></h4>
                                  <p><?php echo $p->post_excerpt; ?>.</p>

                                  <div class="read-more-post mt-md-4 mt-3 text-center">
                                      <a href="#" class="btn btn-theme btn-small">Read More</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  <?php
                      $i++;
                  endforeach; ?>
</div>
<!-- /.col-md-8  -->
  </div>
      </div> 
            </section>
            <!-- ./ contact-security-sec -->
		</div>
		<!-- ./ main_wrapper -->
<?php get_footer();