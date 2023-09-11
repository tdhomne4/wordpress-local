<?php
/**
 * Template Name: Event
 */
//************** We can not use OR relation between taq_query and meta_query
//**but we can use AND relation */
?>
<?php 
$query = array(
    'post_type' => 'events',
    'post_per_page'=> -1,
    'tax_query'=>array(
                array(
          
                  'taxonomy' => 'category',
                  'field' => 'slug',
                  'terms' => array( 'dancing'),
                  'operator'=> 'LIKE'
              ),
          
            ),
            'relation' => 'AND',
        
            'meta_query' => array (
               
                array (
                  'key' => 'meta-box-dropdown',
                  'value'=>array('Agra'),
                 'compare'=> 'NOT IN'
                ),
            )
);
$queryObject = new WP_Query($query);
while($queryObject->have_posts()){
$queryObject->the_post();
  echo the_title();
  
  ?> <br>
  <br>
   <?php
                  

}