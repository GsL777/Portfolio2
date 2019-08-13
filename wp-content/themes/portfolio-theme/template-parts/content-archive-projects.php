<!-- For PROJECTS page -->
<article id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">
	<div class="card-deck cards"><!-- project-pics Parallax Landing Elements class in porfolio.js -->
		
		<?php if(has_post_thumbnail() ): ?>

			<div class="card col-sm-12"><!-- columns Parallax Landing Elements class in porfolio.js -->
				<a href="<?php the_permalink(); ?>" class="standard-featured-link">
					<div class="standard-featured3 background-image3" style="background-image: url(<?php echo portfolio_get_attachment(); ?>);"></div>
				</a>

				<div class="card-body">
					<h5 class="card-title">
						<header class="entry-header">
							<?php the_title( sprintf('<h5 class="entry-title"><a href="%s">', esc_url(get_permalink() ) ),'</a> </h5>' ); ?>
						</header>
					</h5>
					<p class="card-text"><?php the_excerpt(); ?></p>
				</div>

				<div class="card-footer">
					<small class="text-muted">Posted on: <?php the_time('F j, Y'); ?> at <?php the_time('g:i, a'); ?></small>
				</div>

			</div>

		<?php else: ?>

			<div class="card"><!-- columns Parallax Landing Elements class in porfolio.js -->

			    <div class="card-body">
					<h5 class="card-title">
						<header class="entry-header">
							<?php the_title( sprintf('<h5 class="entry-title"><a href="%s">', esc_url(get_permalink() ) ),'</a> </h5>' ); ?>
						</header>
					</h5>
					<p class="card-text"><?php the_excerpt(); ?></p>
			    </div>

			    <div class="card-footer">
					<small class="text-muted">Posted on: <?php the_time('F j, Y'); ?> at <?php the_time('g:i, a'); ?></small>
			    </div>
			</div>

		<?php endif; ?>
	  
	</div><!-- .card-deck -->

</article>