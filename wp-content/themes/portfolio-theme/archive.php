<?php
/*

@package portfolio-theme

*/

 get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<header class="archive-header text-center">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); //automatically retrive the title whatever archive page is pressed. If a user access a category or a tag, or an author link this title will adapt automatically wahtever user action was triggered.?>
			</header>

			<?php if(is_paged() ): //is_paged( ) - a function of wordpress that detects the current page that the user is viewing if it is a paginated page. It is not page 1, but it is page 2 or more.... ?>

			<div class="container text-center container-load-previous">
				<a class="btn-portfolio-load portfolio-load-more" data-prev="1" data-archive="<?php echo portfolio_grab_current_uri(); //in portfolio.js and theme-support.php files?>" data-page="<?php echo portfolio_check_paged(1); //?>" data-url="<?php echo admin_url('admin-ajax.php');?>">
					<span class="portfolio-icon portfolio-loading dashicons dashicons-image-rotate"></span>
					<span class="text">Load Previous</span>
				</a>
			</div><!-- .container -->

			<?php endif; ?>

			<div class="container portfolio-posts-container"> <!-- .portfolio-posts-container - custom class to have a place to print a post. Used in portfolio.js-->

			<?php 
				if( have_posts() ):
			?>

			<?php
					echo '<div class="page-limit" data-page="' . $_SERVER["REQUEST_URI"] . '">';// / - every time the url is updated the slash(/) removes the pagination if user scroll back in a blog loop. This is for a user that enters a post than decide to press back button and the post remains. ajax.php file.
					// portfolio_check_paged - a function to replace the ampty status (/), because by default it's going to empty (data-page="/"). It is echoed in portfolio-load-more-container.
					//$_SERVER["REQUEST_URI"] - is handling the url after the localhost/portfolio2/....

					while( have_posts() ): the_post();

						get_template_part( 'template-parts/content', get_post_format() );//template-parts - folder where are all the content files. get-template-part function will search a folder template-parts and files with start content- .
						//get_post_format() - retrieve the_post_format of the current post that is in the post loop.

					endwhile;

					echo '</div>';

				endif;
				
			?>
			</div><!-- .container -->

			<div class="container text-center">
				<a class="btn-portfolio-load portfolio-load-more" data-page="<?php echo portfolio_check_paged(1); //portfolio_check_paged - in ajax.php?>" data-archive="<?php echo portfolio_grab_current_uri(); //in portfolio.js and theme-support.php files fixing to add the localhost in the url?>" data-url="<?php echo admin_url('admin-ajax.php'); //admin-ajax.php - the file in wp-admin folder we whant to retrive in the url. ?>">
					<span class="portfolio-icon portfolio-loading dashicons dashicons-image-rotate"></span>
					<span class="text">Load More</span>
				</a>
			</div><!-- .container -->

		</main>
	</div><!-- #primary -->

<?php get_footer(); ?>