<?php
/*

	@package portfolio-theme

	==================================
		SINGLE-PROJECTS PAGE
	==================================

*/

 get_header(); ?>

<!-- IF WORDPRESS CAN NOT FIND THE single-projects.php PAGE AND ECHO'ES 404 PAGE THAN GO TO:
	WP Dashboard -> Settings -> Permalinks -> Set on 'Plain' -> Save Changes -> go to the existing webpage and press on the buttons -> than refresh (ctrl+f5) -> go to WP Dashboard -> Settings -> Permalinks -> Set to 'Post name' -> Save Changes -> go to the existing webpage -->

<!-- Create as an example for curstom post type single-custom.php and archive-custom.php page -->

	<div id="primary-single" class="content-area">
		<main id="main-single" class="site-main" role="main">

			<div class="container section">
				<div class="row">

					<div class="col-xs-12 col-md-12 col-lg-12">

					<?php 

					if( have_posts() ):

						while( have_posts() ): the_post();
					?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><!-- if a WordPress has the get_ in front of a function it needs an echo -->
								<header class="entry-header text-center">
									
									<?php the_title( '<h1 class="entry-title">', '</h1>'); // escape the url because we are inside the function so we dont whant to print?>
									<?php if( has_post_thumbnail() ): ?>
										
										<div class="entry-meta">
											<div class="image"><?php the_post_thumbnail('medium'); ?></div>
										</div>

									<?php endif; ?>

									<small>
										<?php 
										/*Instead of the_category(' '); could be changed to the following code:
										$terms_list = wp_get_post_terms( $post->ID, 'field'); //First variable $post - prebuild WP function and it is an array object full of information that is inside the post so i can access the id with this variable. Second variable - 'field' grabs all the taxonomy field associated to this current $post->ID in the first variable 
										
										$i = 0;
										foreach ($terms_list as $term): $i++;
											if( $i > 1 ):
												echo ', ';
											endif;
											echo $term->name;
										endforeach;*/

										echo portfolio_get_terms($post->ID, 'field');//portfolio_get_terms function in theme-support.php

										?> || <?php 
										
										/*the_tags();*/
										/*
										$tags_list = wp_get_post_terms( $post->ID, 'software'); 
										$i = 0;
										foreach ($tags_list as $tag): $i++;
											if( $i > 1 ):
												echo ', ';
											endif;
											
											echo $tag->name;

										endforeach;
										*/
										echo portfolio_get_terms($post->ID, 'software');
										?><?php 

										if( current_user_can('manage_options') )://current_user_can - is detecting current user that is watching a website if he has some role(if it is logged in and if he has capability rows) and this function is a boolean. manage_options - can edit, add, delete post type. 
											echo ' || '; 
											edit_post_link();
										endif;

										//After adding taxonomies link, do not forget to "refresh" the permalinks in WP dashboard (switch back to 'simple or regular' permalinks' go to page, refresh and clean the cache) otherwise your archive page for the custom Taxonomies will end up in a 404.!!!!!!!

										?>
									
									</small>
								</header>

							<div class="entry-content clearfix"><!-- clearfix - bootstrap class add before and after sudo element to simulate a table css command-->
								
								<?php if(portfolio_get_attachment() ): ?>

									<!-- <div class="col-xs-12 col-sm-4">
										<div class="thumbnail"><?php //the_post_thumbnail('thumbnail'); ?></div>
									</div> 
									<header class="entry-header text-center background-image1" style="background-image: url(<?php echo portfolio_get_attachment(); //function written in theme-support.php file portfolio_get_attachment() function?>);">
									</header> -->

									<div class="col-xs-12 col-sm-12 img-container">
										<?php the_content(); //content href to a new tab could be removed in WP dasboard->pressed on a picture and delete destination?> 
									</div>

								<?php else: ?>

									<div class="col-xs-12">
										<?php the_excerpt(); ?>
									</div>

								<?php endif; ?>

							</div><!-- .entry-content -->
							
							<hr>

							<?php echo portfolio_post_navigation(); /*instead of the code (
							<div class="row">
								 <div class="col-xs-6 col-sm-6 text-left"><?php previous_post_link(); ?></div>
								<div class="col-xs-6 col-sm-6 text-right"><?php next_post_link(); ?></div> 
							</div>
							) 
							it could be changed to portfolio_post_navigation(); function that is located in theme-support.php*/ 
							?> 

							</article><!-- standard WordPress markup -->
					<?php 
						endwhile;

					endif;

					?>
						
					</div><!-- .col-xs-12 -->
				</div><!-- .row -->
			</div><!-- .container -->

		</main>
	</div><!-- #primary -->

<?php get_footer(); ?>