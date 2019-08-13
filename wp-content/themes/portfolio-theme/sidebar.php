<?php
/*
	@package portfolio-theme
*/


if( !is_active_sidebar( 'portfolio-sidebar' ) ){//portfolio-sidebar - id from theme-support.php portfolio_sidebar_init array
	return;//return null (nothing)
}//safety check if the sidebar is not active 

?>

<aside id="secondary" class="widget_area" role="complementary">

	<div class="visible-xs">
		<?php //theme-support.php function portfolio_register_nav_menu
			/*wp_nav_menu(
				array(
					'theme_location'	=> 'primary',
	                'container'			=> false,
	                'menu_class'		=> 'nav navbar-nav navbar-collapse',
	                'walker'			=> new Portfolio_Walker_Nav_primary()
	        	)
			);
		*/ ?>
	</div>

	<?php dynamic_sidebar( 'portfolio-sidebar' ); //portfolio-sidebar - id from theme-support.php portfolio_sidebar_init array. header.php?>

</aside>

