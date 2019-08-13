<?php 
	
	require get_template_directory() . '/inc/vendor/Mobile_Detect.php';

	require get_template_directory() . '/inc/cleanup.php';//always load make that cleanup.php will load first
	require get_template_directory() . '/inc/function-admin.php';
	require get_template_directory() . '/inc/enqueue.php';
	require get_template_directory() . '/inc/theme-support.php';
	require get_template_directory() . '/inc/custom-post-type.php';
	require get_template_directory() . '/inc/walker.php';
	require get_template_directory() . '/inc/ajax.php';
	require get_template_directory() . '/inc/shortcodes.php';
	require get_template_directory() . '/inc/widgets.php';
?>


<?php

/*
	==========================================
		Activate menus
	==========================================
*/
function portfolio_theme_setup() {
	
	add_theme_support('menus'); //activatíng menu's writing a string 
	
	register_nav_menu('primary', 'Primary Header Navigation'); //first value - string $location, second option - string $description
	register_nav_menu('secondary', 'Footer Navigation');

}
add_action('init', 'portfolio_theme_setup'); //function to create the menus. Function is executed after the setup theme is triggered. Function will work 'after_setup_theme' or after the initialization 'init'



?>
