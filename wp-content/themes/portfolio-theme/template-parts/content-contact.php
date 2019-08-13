<?php
/*

@package portfolio-theme

	==================================================
		CONTACT TEMPLATE
	==================================================

*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><!-- if a WordPress has the get_ in front of a function it needs an echo -->
	<header class="entry-header text-center">
		
		<?php the_title( '<h1 class="entry-title">', '</h1>'); // escape the url because we are inside the function so we dont whant to print?>

	</header>

	<div class="entry-content clearfix"><!-- clearfix - bootstrap class add before and after sudo element to simulate a table css command-->
			
		<?php the_content(); ?>

	</div><!-- .entry-content -->

</article><!-- standard WordPress markup -->

