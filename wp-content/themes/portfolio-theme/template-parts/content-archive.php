<!-- <article id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">

	<header class="entry-header">
		<?php the_title( sprintf('<h1 class="entry-title"><a href="%s">', esc_url(get_permalink() ) ),'</a> </h1>' ); ?>
		<?php //the_title(); ?>
		<small>Posted on: <?php the_time('F j, Y'); ?> at <?php the_time('g:i, a'); ?>,  in <?php the_category(); ?></small>
	</header>

	<div class="row">
		<?php if(has_post_thumbnail() ): ?>

			<div class="col-xs-12 col-sm-8">
				<div class="thumbnail"><?php the_post_thumbnail('thumbnail'); ?></div>
			</div>

			<div class="col-xs-12 col-sm-8">
				<?php the_excerpt(); ?>
			</div>

		<?php else: ?>

			<div class="col-xs-12">
				<?php the_excerpt(); ?>
			</div>

		<?php endif; ?>

	</div>



</article> -->