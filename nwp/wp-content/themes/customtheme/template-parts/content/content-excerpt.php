
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		
		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		?>
	</header><!-- .entry-header -->

	<?php //twentynineteen_post_thumbnail(); ?>

	<div class="entry-content">
		<?php //the_excerpt(); ?>
	</div6><!-- .entry-content -->

	
</article><!-- #post-<?php the_ID(); ?> -->
