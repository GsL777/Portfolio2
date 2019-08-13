<?php

// $detect = new Mobile_Detect; //code in theme-support.php
global $detect;

/*

@package portfolio-theme

	==========================================
		GALLERY POST FORMAT
	==========================================

*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-format-gallery' ); //portfolio-format-gallery - class from content-gallery.scss?>><!-- if a WordPress has the get_ in front of a function it needs an echo -->
	<header class="entry-header text-center">

		<?php if( portfolio_get_attachment() && !$detect->isMobile() && !$detect->isTablet() ): //function in theme-support.php
			/*$attachments = portfolio_get_attachment(7);//number inside shows the maximum amount of pictures in a slider.
			$detect - variable from the http://mobiledetect.net/ documentation.*/
			//var_dump($attachments);
		?>

			<div id="post-gallery-<?php the_ID(); ?>" class="hidden-xs hidden-sm carousel slide portfolio-carousel-thumb" data-ride="carousel">
				<div class="carousel-inner">

					<?php 

						$attachments = portfolio_get_bs_slides( portfolio_get_attachment(7) );

						foreach ($attachments as $attachment): 
						
						/*	
						$count = count($attachments)-1;
						for($i = 0; $i <= $count; $i++ ): 
							
							$active = ( $i == 0 ? 'active' : '' );

							$next = ( $i == $count ? 0 : $i+1 ); //$i+1 - +1, because we are using $i variable as a starting point and as a number, but not increasing a variable every time.
							$nextImg = wp_get_attachment_thumb_url( $attachments[$next]->ID );

							$prev = ( $i == 0  ? $count : $i-1 ) ;
							$prevImg = wp_get_attachment_thumb_url( $attachments[$prev]->ID );
						*/
					?>

						<div class="carousel-item <?php echo $attachment['class']; ?> background-image2 standard-featured2" style="background-image: url( <?php echo $attachment['url']; //function from theme-support.php function portfolio_get_attachment() variable inside foreach ?> );">

							<div class="hide next-image-preview" data-image="<?php echo $attachment['next_img']; ?>"></div><!-- in the data-image="" it is stored next image url. -image could be changed as an exapmle data-portfolio="".....-->
							<div class="hide prev-image-preview" data-image="<?php echo $attachment['prev_img']; ?>"></div><!-- in the data-image="" it is stored previous image url. -image could be changed as an exapmle data-portfolio="".....-->

							<!-- dynamically put $nextImg; and $prevImg; value inside the .carousel-control container. file in assets -> js -> portfolio.js -->

							<div class="entry-excerpt image-caption">
								<p><?php echo $attachment['caption']; //in WP media -> press on a picture -> write a caption inside (in a post you can't write a capition, because if you write it will be written not in database, but just as words). Than var_dump($attachments[$i]); and find array post_excerpt and there must be a number inside, but not 0. ?></p>
								<?php //var_dump($attachments[$i]); ?>
							
							</div>

						</div>

					<?php endforeach; ?>

				</div><!-- .carousel-inner -->

				<a class="left carousel-control-prev carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="prev">
					<div class="table">
						<div class="table-cell">

							<div class="preview-container">
								<span class="thumbnail-container background-image"></span><!-- container for a photo between the picture arrows -->
								<span class="portfolio-icon portfolio-prev-icon carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</div><!-- .preview-container -->

						</div><!-- .table-cell -->
					</div><!-- table -->
				</a>

				<a class="right carousel-control-next carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="next">
					<div class="table">
						<div class="table-cell">

							<div class="preview-container">
								<span class="thumbnail-container background-image"></span><!-- container for a photo between the picture arrows -->
								<span class="portfolio-icon portfolio-next-icon carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</div><!-- .preview-container -->

						</div><!-- .table-cell -->
					</div><!-- table -->
				</a>
			</div><!-- .carousel -->

		<?php endif; ?>

		<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>'); // escape the url because we are inside the function so we dont whant to print?>
		
		<div class="entry-meta">
			<?php echo portfolio_posted_meta(); //blog loop custom function in theme-support.php file?>
		</div>

	</header>

	<div class="entry-content">

		<?php if( portfolio_get_attachment() && ($detect->isMobile() || $detect->isTablet() ) ): ?>
			
			<a href="<?php the_permalink(); ?>" class="standard-featured-link">
				<div class="standard-featured background-image1" style="background-image: url(<?php echo portfolio_get_attachment(); ?>);"></div>
			</a>
		<?php endif; ?>
		
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div>

		<div class="button-container text-center"> <!-- READ MORE button -->
			<a href="<?php the_permalink(); ?>" class="btn btn-portfolio"><?php _e( 'Read More' ); ?></a>
		</div>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php echo portfolio_posted_footer(); //blog loop custom function in theme-support.php file. if the function is created there is a need to create a function with return '';?>
	</footer>

</article><!-- standard WordPress markup -->

