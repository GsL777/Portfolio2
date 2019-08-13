<?php
/*

@package portfolio-theme

	==========================================
		LINK POST FORMAT
	==========================================

*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-format-link' ); ?>><!-- if a WordPress has the get_ in front of a function it needs an echo -->
	<header class="entry-header text-center">
		
	<?php 
		$link = portfolio_grab_url();//store the result that will return the created value.function in theme-support.php
		the_title( '<h1 class="entry-title"><a href="' .$link. '" taget="_blank">', '<div class="link-icon"><span class="dashicons portfolio-icon portfolio-link"><i class="fa fa-link"></i></span></div></a></h1>'); //portfolio-icon portfolio-link - classes for the link icon
		//the_title( '<h1 class="entry-title"><a href="' .$link. '" taget="_blank">', '<div class="link-icon"><span class="dashicons dashicons-admin-links portfolio-icon portfolio-link"></span></div></a></h1>');
	?>
		
	</header>

</article><!-- standard WordPress markup -->

