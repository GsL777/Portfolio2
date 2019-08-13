<?php
/*

@package portfolio-theme

	==========================================
		IMAGE POST FORMAT
	==========================================

*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-format-image'); ?>><!-- if a WordPress has the get_ in front of a function it needs an echo. inside post_class() there you can write a custom class inside ''. In this case a custom class is created, because if the user will use another version of wordpress everything will work corectly. -->

		<header class="entry-header text-center background-image1" style="background-image: url(<?php echo portfolio_get_attachment(); //function written in theme-support.php file portfolio_get_attachment() function?>);">
			
			<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>'); // escape the url because we are inside the function so we dont whant to print?>
			
			<div class="entry-meta">
				<?php echo portfolio_posted_meta(); //blog loop custom function in theme-support.php file?>
			</div>

			<div class="entry-excerpt image-caption">
				<?php the_excerpt(); ?>
			</div>

		</header>

	<!-- <footer class="entry-footer">
		<?php //echo portfolio_posted_footer(); //blog loop custom function in theme-support.php file. if the function is created there is a need to create a function with return '';?>
	</footer> -->

</article><!-- standard WordPress markup -->

