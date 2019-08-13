<?php
/*
	This is the template for the header

	@package portfolio-theme
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title><!-- To set a page title go to dashboard Settings -> General -> write in a Site Title a title. It can be seen with an inspect-->
		<meta name="description" content="<?php bloginfo('description'); ?>">	
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1"><!-- for responsive devices -->
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php if( is_singular() && pings_open( get_queried_object() ) ): //hides if the post is not a single post or single page. //is_singular() means that this page is not the front page, is not the home page, is not an archive, is not a search result, generic blog loop it could be a contact page, a blog post.?>
			<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<?php endif; ?>

		<?php wp_head(); ?>
	</head>

	<?php /*
	How to set Home page 1 method:

	Appearance -> menus (there must be created a Header menu on the top) -> pasirinkti custom links -> to the url write down URL: http://localhost/portfolio2/ -> Link Text: Home-> Add to menu-> Save menu*/?>

	<?php  
		//ON WORDPRESS DASHBOARD -> PORTFOLIO -> CUSTOM CSS a custom css code could be written
		$custom_css = esc_attr(get_option( 'portfolio_css' ));//portfolio_css - unique handler from function-admin.php //Custom CSS Options
			if(!empty($custom_css) ):
				echo '<style>' . $custom_css . '</style>';
			endif;

	/*
		if (is_front_page() ): //is_home() detects if we are in the home page. If it is true it returns a true statement, otherwise returns false.
		//if your page is not your blog page, built in function is_front_page. Wordpress will recognise a hidden front page that is specified inside DASHBOARD -> settings -> reading.

		//SO IF THE HOME PAGE IS PRESSED IT WILL SHOW my-class, IF PRESS OTHER PAGE IT WILL SHOW no-portfolio-class IN INSPECT
			$awesome_classes = array(
				'portfolio-class', 'my-class'
			);
		else: 
			$awesome_classes = array(
				'no-portfolio-class'
			);
		endif;
	//to print actual class as example just on the home page

	/*write an if statement and copy a variable $awesome_classes to <body <?php body_class()?>> instead of array
	*/
	?>



	<body <?php body_class(
		//body_class($portfolio_classes);
		//array( 'portfolio-class', 'my-class' )  //through an array we can insert a class'es
	); //if we change page the class of the body will change and it's going to print a custom class based on the page. With this class there is an ability to style a page in a different way based on the content the user sees?>
	>
	

	<div class="portfolio-sidebar sidebar-closed">

		<div class="portfolio-sidebar-container">
			<!-- changed .js-closeSidebar  to js-toggleSidebar-->
			<a class="js-toggleSidebar sidebar-close"><!-- js-closeSidebar animation function in portfolio.js  -->
				<span class="portfolio-icon portfolio-close"><i class="fa fa-times"></i></span>
			</a>

			<div class="sidebar-scroll"><!-- style in  sidebar.scss  -->
				
				<?php get_sidebar(); //sidebar.php and theme-support.php files?>

			</div><!-- .sidebar-scroll -->

		</div><!-- .portfolio-sidebar-container -->

	</div><!-- .portfolio-sidebar -->

	<div class="sidebar-overlay js-toggleSidebar"></div><!-- for overlay darken effect in sidebar.scss--> <!-- js-toggleSidebar class from portfolio.js applied to close the sidebar when clicked on overlay -->

	<div class="container-fluid container-size-option">

		<div class="row">
			<div class="col-xs-12 screen-fit1 office-box">

				<header class="header-container background-image text-center" style="background-image: url(<?php header_image(); //header_image(); - php built in function automatically prints the header image?>);"> <!-- Than go to DASHBOARD -> appearance -> header -> header image -> select the image. -->
					<!-- -->
					<div class="apple" style="background-image: url(http://localhost/portfolio2/wp-content/themes/portfolio-theme/assets/img/Red-Apple.png);">
					</div>

					<!--  <div class="pen" style="background-image: url(http://localhost/portfolio2/wp-content/themes/portfolio-theme/assets/img/Pen-fixed2.png);"></div>-->

					<!-- changed .js-openSidebar  to js-toggleSidebar-->
					<a class="js-toggleSidebar sidebar-open">
						<span class="portfolio-icon portfolio-menu"><i class="fa fa-bars"></i></span>
					</a>

					<div class="header-content table">
						<div class="table-cell">
							<h1 class="site-title">
								
								<span class="hide"><?php bloginfo( 'name' ); //hide-prebuild bootstrap class?>
								</span>
							</h1>
							<h2 class="site-description"><?php bloginfo( 'description' ); //prints info from WP Dashboard -> Settings -> General -> Site title, Tagline?></h2>
						
						<!-- start mouse wrap -->
						<div class="mouse-warp">
							<!-- <a href="#" class="page-scroll"> -->
							<div class="page-scroll">
								<div class="mouse">
									<div class="scroll"></div>
								</div>
							</div>
							<!-- </a> -->
						</div><!-- end mouse wrap -->
						
						</div><!-- table-cell -->
					</div><!-- header-content -->

					<div class="nav-container hidden-xs">
						<nav class="navbar navbar-default navbar-portfolio">
							<?php //theme-support.php function portfolio_register_nav_menu
								wp_nav_menu(
									array(
										'theme_location'	=> 'primary',
					                    'container'			=> false,
					                    'menu_class'		=> 'nav navbar-nav',
					                    'walker'			=> new Portfolio_Walker_Nav_primary()
				                	)
								);
							 ?>
						</nav><!-- nav-container -->

					</div>

				

				</header><!-- header-container -->

			</div><!-- .col-xs-12 -->
		</div><!-- .row -->

	</div><!-- .container-fluid -->

