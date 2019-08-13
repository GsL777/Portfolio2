<?php
/*

@package portfolio-theme

	==================================================
		SINGLE POST TEMPLATE template-parts/single.php
	==================================================

*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><!-- if a WordPress has the get_ in front of a function it needs an echo -->
	<header class="entry-header text-center">
		
		<?php the_title( '<h1 class="entry-title">', '</h1>'); // escape the url because we are inside the function so we dont whant to print?>
		
		<div class="entry-meta">
			<?php echo portfolio_posted_meta(); //blog loop custom function in theme-support.php file?>
		</div>

	</header>

	<div class="entry-content clearfix"><!-- clearfix - bootstrap class add before and after sudo element to simulate a table css command-->
			
		<?php the_content(); ?>

	</div><!-- .entry-content -->

	<!-- <footer class="entry-footer">
		<?php echo portfolio_posted_footer(); //blog loop custom function in theme-support.php file. if the function is created there is a need to create a function with return '';?>
	</footer> -->

</article><!-- standard WordPress markup -->

