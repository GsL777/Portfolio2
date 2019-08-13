<?php
/*

@package portfolio-theme

	==========================================
		ASIDE POST FORMAT
	==========================================

*/
?>
<!-- aside post format is not related with html <aside></aside> tag. It's just a name.-->

<article id="post-<?php the_ID(); ?>" <?php post_class( array('portfolio-format-aside') ); //array() - for declaring multiple classes, but if there is one class than array word could be deleted.?>>
	<div class="aside-container">
		<div class="row">

			<div class="col-xs-12 col-sm-4 col-md-4 text-center">

				<?php if( portfolio_get_attachment() ): ?>
				
					<div class="aside-featured background-image1" style="background-image: url(<?php echo portfolio_get_attachment(); ?>);"></div>

				<?php endif; ?>

			</div><!-- .col-md-3 -->

			<div class="col-xs-12 col-sm-8 col-md-8">
				<header class="entry-header">
			
					<div class="entry-meta">
						<?php echo portfolio_posted_meta(); //blog loop custom function in theme-support.php file?>
					</div>

				</header>

				<div class="entry-content">
					
					<div class="entry-excerpt">
						<?php the_content(); ?>
					</div>

				</div><!-- .entry-content -->
			</div><!-- .col-md-9 -->

		</div><!-- .row -->
		
		
			<footer class="entry-footer">
				<div class="row">
					<div class="col-sm-7 offset-sm-3 col-md-9 offset-md-3">
						<?php echo portfolio_posted_footer(); //blog loop custom function in theme-support.php file. if the function is created there is a need to create a function with return '';?>
					</div><!-- .col-md-10 -->
				</div><!-- .row -->
			</footer>
		
		
	</div><!-- .aside-container -->

</article><!-- standard WordPress markup -->

