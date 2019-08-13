<?php
/*

	@package portfolio-theme

	==================================
		SINGLE POST FORMAT
	==================================

*/

 get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="container">
				<div class="row">

					<div class="col-xs-12 col-md-10 col-lg-8 offset-lg-2 offset-md-1">

					<?php 

					if( have_posts() ):

						while( have_posts() ): the_post();

							get_template_part( 'template-parts/single', get_post_format() );//template-part - folder where are all the content files. get-template-part function will search a folder template-parts and files with start content- .
							//get_post_format() - retrieve the_post_format of the current post that is in the post loop.

							//the_post_navigation();//WordPress function to load the post navigation

							//the_post_navigation(); changed to portfolio_post_navigation(); function from theme-support.php
							echo portfolio_post_navigation();//post navigation

							//check if the comment section is activated or if it exists
							/*
							if( comments_open() )://activate the comments section. Comments function portfolio_posted_footer(); written in theme-support.php
								comments_template();//comments_template(); - calls the file comments.php
							endif;
							*/
						endwhile;

					endif;

					?>
						
					</div><!-- .col-xs-12 -->
				</div><!-- .row -->
			</div><!-- .container -->


		</main>
	</div><!-- #primary -->

<?php get_footer(); ?>