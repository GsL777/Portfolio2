<?php
/*

@package portfolio-theme

	==========================================
		STANDARD POST FORMAT
	==========================================

*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><!-- if a WordPress has the get_ in front of a function it needs an echo -->
	<header class="entry-header text-center">
		
		<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>'); // escape the url because we are inside the function so we dont whant to print?>
		
		<div class="entry-meta">
			<?php echo portfolio_posted_meta(); //blog loop custom function in theme-support.php file?>
		</div>

	</header>

	<div class="entry-content">
		
		<?php if( portfolio_get_attachment() ): ?>
			
			<a href="<?php the_permalink(); ?>" class="standard-featured-link">
				<div class="standard-featured background-image1" style="background-image: url(<?php echo portfolio_get_attachment(); ?>);"></div>
			</a>
		<?php endif; ?>
		
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div>

		<div class="button-container text-center"> <!-- READ MORE button -->
			<a href="<?php the_permalink(); ?>" class="btn btn-portfolio"><?php _e( 'Read More' ); ?></a>
		</div>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //echo portfolio_posted_footer(); //blog loop custom function in theme-support.php file. if the function is created there is a need to create a function with return '';?>
	</footer>

</style>

</article><!-- standard WordPress markup -->

