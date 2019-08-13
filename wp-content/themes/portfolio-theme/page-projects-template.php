<?php 

	/*Template Name: Projects template*/

get_header();

?>

<!-- 1. PAGE AFTER PRESSED WORK IN THIS CASE BUTTON ON THE NAVBAR -->
<div id="primary-projects" class="content-area">
	<main id="main-projects" class="site-main" role="main">
		<?php the_title( sprintf('<h1 class="entry-title">', esc_url(get_permalink() ) ),'</h1>' ); ?>
		<div class="container section">
			<?php //the_title( sprintf('<h1 class="entry-title"></h1>' )); ?>
			
			<div class="row section1">
				<?php 

					$args = array(
						'post_type'			=> 'projects',
						'posts_per_page'	=> 6,
						// 'offset'			=> 1,
						'tax_query' => array(
							array(
								'taxonomy'	=> 'field',
								'field'		=> 'slug',
								'terms'		=> array( 'development', 'gametesting', 'maintenance' ),
							),
						),
					);
					
					// var_dump($args);


					$loop = new WP_Query( $args );

					if( $loop->have_posts() ):

						while( $loop->have_posts() ): $loop->the_post(); ?>

							<?php get_template_part('template-parts/content', 'archive-projects'); ?>

						<?php endwhile; 

					endif;

					wp_reset_postdata();
				?>
			</div>


		</div><!-- .section -->

		<div class="container resume-section">
			<?php //the_title( sprintf('<h1 class="entry-title"></h1>' )); ?>
			
			<div class="row resume-section1">
			<?php 

				$args = array(
					'post_type'			=> 'projects',
					'posts_per_page'	=> 1,
					'tax_query' => array(
						array(
							'taxonomy' => 'field',//custom taxonomy name written in category http field (as example: http://localhost/portfolio2/wp-admin/term.php?taxonomy=field&). In this case Wp dashboard->Projects->Field->Press on the category....
							'field'    => 'slug',
							'terms'    => array( 'resume' ), //resume - category name
						),
					),//on custom taxonomies if you could not print one or several categories use tax_query 

				);

				$loop = new WP_Query( $args );

				if( $loop->have_posts() ):

					while( $loop->have_posts() ): $loop->the_post(); ?>

						<?php get_template_part('template-parts/content', 'resume'); ?>

					<?php endwhile; 

				endif;

				wp_reset_postdata();
			?>
			</div>

		</div><!-- .resume-section -->

	</main>
</div>


<?php get_footer(); ?>