<?php
/*

@package portfolio-theme

	==================================================
		RESUME TEMPLATE
	==================================================

*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><!-- if a WordPress has the get_ in front of a function it needs an echo -->

	<!-- services START -->
	<section id="services">
		<div class="container">
			<h2>Services</h2>
			<div class="row">
				<div class="developer-services"><!-- project-pics Parallax Landing Elements class in porfolio.js -->
					<div class="col-md-6 services-item"><!-- columns Parallax Landing Elements class in porfolio.js -->
						<div class="rotate">
							<span class="fa fa-code" aria-hidden="true"></span>
							<!-- <i class="fa fa-file-code-o fa-wrapper" aria-hidden="true"></i>-->
						</div>
						<h3>Front End Development</h3>
						<p>Development of responsive websites<!--, game testing , cross-browser and cross-platform testing.--></p>
					</div>
					<div class="col-md-6 services-item columns">
						<div class="rotate">
							<span class="fa fa-wordpress fa-wrapper" aria-hidden="true"></span>
						</div>
						<h3>Wordpress Development</h3>
						<p>Custom development ( website, theme <!-- & plugin--> ), hosting and maintenance.</p>
						<p>Development tools: Sublime, GitHub.</p>
					</div>
<!--					<div class="col-md-4 services-item columns">
						<div class="rotate">
							<span class="fa fa-line-chart" aria-hidden="true"></span>
							<!-- <i class="fa fa-search fa-wrapper" aria-hidden="true"></i> 
						</div>
						<h3>Search Engine Optimization</h3>
						<p>Increase your visibility across all major search engines & local search with SEO techniques.</p>
					</div> -->
				</div><!-- .developer-services -->
				
			</div><!-- .row -->
			
		</div><!-- .container -->
		
	</section><!-- #services -->

	<header class="entry-header text-center">
		
		<?php the_title( '<h2 class="entry-title">', '</h2>'); // escape the url because we are inside the function so we dont whant to print?>

	</header>

	<div class="entry-content clearfix"><!-- clearfix - bootstrap class add before and after sudo element to simulate a table css command-->
			
		<?php the_content(); ?>

	</div><!-- .entry-content -->

</article><!-- standard WordPress markup -->