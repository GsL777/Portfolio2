<?php 

/*
@package portfolio-theme

	==================================================
		ADMIN ENQUEUE FUNCTIONS
	==================================================

*/

//CSS for a custom theme in Wordpress dashboard
function portfolio_load_admin_scripts( $hook ){
	//echo $hook;

	//Register css admin section
	wp_register_style( 'raleway-amin', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );//First value - the name of the font
	wp_register_style( 'portfolio_admin', get_template_directory_uri() . '/admin-css/portfolio.admin.css', array(), '1.0.0', 'all' );//It only puts the style on PORTFOLIO THEME OPTION

	//Register js admin section
	wp_register_script( 'portfolio-admin-script', get_template_directory_uri() . '/admin-js/portfolio.admin.js', array('jquery'), '1.0.0', true );

	$pages_array = array(
		'toplevel_page_gytis_portfolio',
		'portfolio_page_gytis_portfolio_theme',
		'portfolio_page_gytis_portfolio_theme_contact',
		'portfolio_page_gytis_portfolio_css'
	);

	//if( 'toplevel_page_gytis_portfolio' == $hook ){ //empty return blocks the execution of the last part of the function wp_register_style and wp_enqueue_style.
	if(in_array($hook, $pages_array)){

		wp_enqueue_style( 'raleway-admin' );
		wp_enqueue_style( 'portfolio_admin' );
	
	} 
	if( 'toplevel_page_gytis_portfolio' == $hook ){
		wp_enqueue_media();//built in function that automatically handle calling and activation process of all the scripts and all the source code that needs for use of media uploader

		wp_enqueue_script( 'portfolio-admin-script' );
	}
	if ( 'portfolio_page_gytis_portfolio_css' == $hook ){
		
		wp_enqueue_style( 'ace', get_template_directory_uri() . '/admin-css/portfolio.ace.css', array(), '1.0.0', 'all' );//downloaded from https://ace.c9.io/#nav=embedding site to insert code editor to a website.

		wp_enqueue_script( 'ace', get_template_directory_uri() . '/admin-js/ace/ace.js', array('jquery'), '1.2.1', true );//using just wp_enqueue_script function instead of using wp_register_style and then wp_enqueue_style.
		wp_enqueue_script( 'portfolio-custom-css-script', get_template_directory_uri() . '/admin-js/portfolio.custom_css.js', array('jquery'), '1.0.0', true );
	
	}

}
add_action( 'admin_enqueue_scripts', 'portfolio_load_admin_scripts' );

/*
	==================================================
		FRONT-END ENQUEUE FUNCTIONS
	==================================================
*/

function portfolio_script_enqueue() {
	//css
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.1.1', 'all');
	wp_enqueue_style('portfolio', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0', 'all');
	wp_enqueue_style ('fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.css', array(), '5.1.0', 'all');

	//fonts
	
	wp_enqueue_style( 'playfair', 'https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900' );
	wp_enqueue_style( 'roboto', 'https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700' );
	

	//js
	//wp_deregister_script( 'jquery' );//takes of the script from the head
	wp_enqueue_script('jqueryjs', get_template_directory_uri() . '/assets/js/jquery-1.11.3.min.js', array(), '1.0.0', true);
	wp_enqueue_script('popper', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), '4.1.1', true);
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.1.1', true);
	wp_enqueue_script('customjs', get_template_directory_uri() . '/assets/js/portfolio.js', array('jquery'), '1.0.0', true);
}
add_action( 'wp_enqueue_scripts', 'portfolio_script_enqueue');


?>
