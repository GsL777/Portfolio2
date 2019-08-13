<?php
/*

@package portfolio-theme

	==========================================
		QUOTE POST FORMAT
	==========================================

*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-format-quote' ); ?>>
	<header class="entry-header text-center">
		
		<div class="row">
			<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2">

				<h1 class="quote-content"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_the_content(); ?></a></h1>

				<?php the_title( '<h2 class="quote-author">- ', ' -</h2>' ); // escape the url because we are inside the function so we dont whant to print?>

			</div><!-- .col-md-8 -->
		</div><!-- .row -->
		
	</header>


</article><!-- standard WordPress markup -->
