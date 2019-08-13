<?php 

/*
@package portfolio-theme

	==================================================
		ADMIN PAGE
	==================================================

*/

function portfolio_add_admin_page() {
	//Generate Portfolio Admin Page(a hook from wordpress to activate administration page)
	add_menu_page( 'Portfolio Theme Options', 'Portfolio', 'manage_options', 'gytis_portfolio', 'portfolio_theme_create_page', 'dashicons-art', 110);//First parameter - Page title. Second parameter - menu title. Third parameter - Capability(capability to display options to specific users). Fourth parameter - menu slug(parameter that appears in the navigation bar to avoid errors). Fifth parameter - a function name. Sixth parameter - icon url(wordpress premade icons in https://developer.wordpress.org/resource/dashicons/#art) Need to choose the icon and paste the icon name to the Sixth parameter place. Seventh parameter - the position of a menu.

	//Generate Portfolio Admin Sub Pages
	add_submenu_page( 'gytis_portfolio', 'Portfolio Sidebar Options', 'Sidebar', 'manage_options', 'gytis_portfolio', 'portfolio_theme_create_page' ); //As a first parameter there is a must to use parent_slug the same as add_menu_page Fourth parameter - gytis_portfolio. Second parameter - has to be the same as add_menu_page first parameter. Fifth parameter has to be as fourth parameter in add_menu_page to SHOW SETTINGS AS A FIRST SUBMENU IN A DASHBOARD.

	//Portfolio Theme Options
	add_submenu_page('gytis_portfolio', 'Portfolio Theme Options', 'Theme Options', 'manage_options', 'gytis_portfolio_theme', 'portfolio_theme_support_page');

	//Contact Form Options
	add_submenu_page('gytis_portfolio', 'Portfolio Contact Form', 'Contact Form', 'manage_options', 'gytis_portfolio_theme_contact', 'portfolio_contact_form_page');

	//Contact CSS Optionss
	add_submenu_page('gytis_portfolio', 'Portfolio CSS Options', 'Custom CSS', 'manage_options', 'gytis_portfolio_css', 'portfolio_theme_settings_page');

}

add_action( 'admin_menu', 'portfolio_add_admin_page' );

//Activate custom settings
add_action('admin_init', 'portfolio_custom_settings');

function portfolio_custom_settings(){
	//Sidebar Options
	register_setting( 'portfolio-settings-group', 'profile_picture' ); //button function to upload pictures (to put code in portfolio_custom_settings, portfolio_sidebar_profile functions). To make it work need to write jquery in portfolio.admin.js and in portfolio-admin.php write a html to print a picture.
	register_setting( 'portfolio-settings-group', 'first_name' ); //gives us the ability to create a specific section in WP database to record a custom group of settings (inputs, checkboxes, dropdowns....)
	register_setting('portfolio-settings-group', 'last_name');
	register_setting('portfolio-settings-group', 'user_description');
	//register_setting('portfolio-settings-group', 'twitter_handler', 'portfolio_sanitize_github_handler'); //portfolio_sanitize_twitter_handler - string that will takes out html and php code... , because of the security reasons. Than create a function portfolio_sanitize_twitters_handler //Sanitization settings.
	register_setting('portfolio-settings-group', 'facebook_handler');
	register_setting('portfolio-settings-group', 'linkedin_handler');
	register_setting('portfolio-settings-group', 'gmail_handler');
	register_setting('portfolio-settings-group', 'github_handler'); 


	add_settings_section( 'portfolio-sidebar-options', 'Sidebar Options', 'portfolio_sidebar_options', 'gytis_portfolio' );//adds section inside ssettings. First parameter - id of the section. Second parameter - the title that will appear. The Third - function that we have to call. The fourth parameter - as the add_menu_page(fourth parameter) 


	add_settings_field('sidebar-profile-picture', 'Profile Picture', 'portfolio_sidebar_profile', 'gytis_portfolio', 'portfolio-sidebar-options' );
	add_settings_field('sidebar-name', 'Full Name', 'portfolio_sidebar_name', 'gytis_portfolio', 'portfolio-sidebar-options' );
	add_settings_field('sidebar-description', 'Description', 'portfolio_sidebar_description', 'gytis_portfolio', 'portfolio-sidebar-options' );
	add_settings_field('sidebar-github', 'Github handler', 'portfolio_sidebar_github', 'gytis_portfolio', 'portfolio-sidebar-options');
	add_settings_field('sidebar-facebook', 'Facebook handler', 'portfolio_sidebar_facebook', 'gytis_portfolio', 'portfolio-sidebar-options');
	add_settings_field('sidebar-linkedin', 'LinkedIn handler', 'portfolio_sidebar_linkedin', 'gytis_portfolio', 'portfolio-sidebar-options');
	add_settings_field('sidebar-gmail', 'Gmail handler', 'portfolio_sidebar_gmail', 'gytis_portfolio', 'portfolio-sidebar-options');
	//add_settings_field('sidebar-twitter', 'Twitter handler', 'portfolio_sidebar_twitter', 'gytis_portfolio', 'portfolio-sidebar-options');

	//Theme Support Options
	/*
	register_setting('portfolio-theme-support', 'post_formats', 'portfolio_posts_formats_callback');
	*/
	register_setting('portfolio-theme-support', 'post_formats');
	register_setting('portfolio-theme-support', 'custom_header');
	register_setting('portfolio-theme-support', 'custom_background');

	add_settings_section('portfolio-theme-options', 'Theme Options', 'portfolio_theme_options', 'gytis_portfolio_theme'); //gytis_portfolio_theme - from portfolio_add_admin_page function add_submenu_page Fifth parameter.//Portfolio Theme options

	add_settings_field('post-formats', 'Post Formats', 'portfolio_post_formats', 'gytis_portfolio_theme', 'portfolio-theme-options');//Portfolio Theme options
	add_settings_field('custom-header', 'Custom Header', 'portfolio_custom_header', 'gytis_portfolio_theme', 'portfolio-theme-options');
	add_settings_field('custom-background', 'Custom Background', 'portfolio_custom_background', 'gytis_portfolio_theme', 'portfolio-theme-options');

	//Contact Form Options
	register_setting( 'portfolio-contact-options', 'activate_contact' );//custop-post-type.php

	add_settings_section( 'portfolio-contact-section', 'Contact Form', 'portfolio_contact_section', 'gytis_portfolio_theme_contact' );

	add_settings_field( 'activate-form', 'Activate Contact Form', 'portfolio_activate_contact', 'gytis_portfolio_theme_contact', 'portfolio-contact-section' );

	//Custom CSS Options
	register_setting( 'portfolio-custom-css-options', 'portfolio_css', 'portfolio_sanitize_custom_css');

	add_settings_section( 'portfolio-custom-css-section', 'Custom CSS', 'portfolio_custom_css_section_callback', 'gytis_portfolio_css' );

	add_settings_field( 'custom-css', 'Insert your Custom CSS', 'portfolio_custom_css_callback', 'gytis_portfolio_css', 'portfolio-custom-css-section' );

}


function portfolio_custom_css_section_callback(){
	echo 'Customize Portfolio Theme with your own CSS';
}//Contact CSS Options

function portfolio_custom_css_callback(){
	$css = get_option( 'portfolio_css' );
	$css = ( empty($css) ? '/* Portfolio Theme Custom CSS */' : $css );
	//echo '<textarea placeholder="Sunset Custom Css" >'.$css.'</textarea>';
	echo '<div id="customCss">'.$css.'</div><textarea id="portfolio_css" name="portfolio_css" style="display:none;visibility:hidden;">'.$css.'</textarea>';
}//div id must be the same as in admin-js.js -> portfolio.custom_css.js in ace.edit() section.
//Contact CSS Options




//Post Formats Callback Function
/*
function portfolio_posts_formats_callback($input){
	return $input;
}
*/

function portfolio_theme_options(){
	echo 'Activate and Deactivate specific Theme Support Options';
}

function portfolio_contact_section(){
	echo 'Activate and Deactivate the Built-in Contact Form';
}//Contact Form Options

function portfolio_activate_contact(){
	$options = get_option( 'activate_contact' );
	$output = '';

	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_header" name="activate_contact" value="1" '.$checked.' /></label>';
}//Contact Form Options


function portfolio_post_formats(){
	$options = get_option( 'post_formats' );
	$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
	$output = '';
	foreach ( $formats as $format ){
		$checked = ( @$options[$format] == 1 ? 'checked' : '' );
		$output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' /> '.$format.'</label><br>';
	}
	echo $output;//Portfolio Theme options
}//Activate a theme support in inc -> theme-support.php file

function portfolio_custom_header(){
	$options = get_option( 'custom_header' );
	$output = '';

	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' /> Activate the Custom Header</label>';
}//Activate a theme support in inc -> theme-support.php file

function portfolio_custom_background(){
	$options = get_option( 'custom_background' );
	$output = '';

	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate the Custom Background</label>';
}//Activate a theme support in inc -> theme-support.php file


//Sidebar Options Functions
function portfolio_sidebar_options(){
	echo 'Customize your Sidebar Information';
}

function portfolio_sidebar_profile(){
	$picture = esc_attr(get_option('profile_picture'));
	if(empty($picture)){//empty() - php function that check if the variable is empty and returns only true or false
		echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture" value="" />';
	} else {
		echo '<button type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button"><span class="portfolio-icon-button dashicons-before dashicons-format-image"></span>Replace Profile Picture</button><input type="hidden" id="profile-picture" name="profile_picture" value="' . $picture . '" /> <button type="button" class="button button-secondary" value="Remove" id="remove-picture"><span class="portfolio-icon-button dashicons-before dashicons-no"></span>Remove</button>';//All of the 'remove button' functionality is in admin-js->portfolio.admin.js file
	}//MAKING A BUTTON THAT CAN DELETE A PICTURE IN WORDPRESS DASHBOARD -> Portfolio -> Sidebar.
	
}//button function to upload pictures (to put code in portfolio_custom_settings, portfolio_sidebar_profile functions). To make it work need to write jquery in portfolio.admin.js and in portfolio-admin.php write a html to print a picture.


function portfolio_sidebar_name(){
	$firstName = esc_attr(get_option('first_name'));// get_option exact same id must be as a function_custom_settings register_setting Second parameter. //esc_attr - escape all the malware that could be injected iside this variable. Put the $firstName variable into the value="".
	$lastName = esc_attr(get_option('last_name'));
	echo '<input type="text" name="first_name" value=" '.$firstName.' " placeholder="First Name" /><input type="text" name="last_name" value=" '.$lastName.' " placeholder="Last Name" />'; //from functions portfolio_custom_settings register_settings second parameter goes to name="".
}

function portfolio_sidebar_description(){
	$description = esc_attr(get_option('user_description'));
	echo '<input type="text" name="user_description" value=" '.$description.' " placeholder="Description" /><p class="description">Write something smart.</p>';
}

/*
function portfolio_sidebar_twitter(){
	$twitter = esc_attr(get_option('twitter_handler'));
	echo '<input type="text" name="twitter_handler" value=" '.$twitter.' " placeholder="twitter handler" /><p class="description">Input your twitter username without the @character.</p>';
}
*/

//to add new sidebar function need to create a new as an example portfolio_sidebar_github and to put it in portfolio_custom_settings as a register_setting();

function portfolio_sidebar_facebook(){
	$facebook = esc_attr(get_option('facebook_handler'));
	echo '<input type="text" name="facebook_handler" value=" '.$facebook.' " placeholder="Facebook handler" />';
}

function portfolio_sidebar_linkedin(){
	$linkedin = esc_attr(get_option('linkedin_handler'));
	echo '<input type="text" name="linkedin_handler" value=" '.$linkedin.' " placeholder="LinkedIn handler" />';
}

function portfolio_sidebar_github(){
	$github = esc_attr(get_option('github_handler'));
	echo '<input type="text" name="github_handler" value=" '.$github.' " placeholder="Github handler" />';
}

function portfolio_sidebar_gmail(){
	$gmail = esc_attr(get_option('gmail_handler'));
	echo '<input type="text" name="gmail_handler" value=" '.$gmail.' " placeholder="Gmail handler" />';
}

//Sanitization settings
/*
function portfolio_sanitize_twitter_handler( $input ){
	//$input - is a value that user will input into the field
	$output = sanitize_text_field( $input );
	$output = str_replace('@', '', $output);//this line takes out the @. Replaces @ with empty value
	return $output;// inside function never echo but return $output. If we echo this variable will create a html output within a php ant it will break.
}
*/
function portfolio_sanitize_custom_css ($input){
	$output = esc_textarea( $input );//sanitize an input. Function incodes all the information in database.
	return $output;
}

//Template submenu functions
function portfolio_theme_create_page(){
	//generation of our admin page
	// echo '<h1>Portfolio Theme Options</h1>';
	require_once( get_template_directory() . '/inc/templates/portfolio-admin.php' );
}

function portfolio_theme_support_page(){
	require_once( get_template_directory() . '/inc/templates/portfolio-theme-support.php' );
}

function portfolio_contact_form_page(){
	require_once( get_template_directory() . '/inc/templates/portfolio-contact-form.php' );
}

function portfolio_theme_settings_page() {
	require_once( get_template_directory() . '/inc/templates/portfolio-custom-css.php' );
}







?>