<?php 
/*

@package portfolio-theme

	==========================================
		THEME CUSTOM POST TYPES OPTIONS
	==========================================
*/

//CREATES A NEW OPTION IN A WP DASHBOARD (in this case MESSAGES)
$contact = get_option('activate_contact'); //Taken from function-admin.php register_setting( 'portfolio-contact-options', 'activate_contact' );
	if(@$contact == 1){//in order to activate Contact appearance on WordPress dashboard. To initialize function portfolio_contact_custom_post_type that is generating cutom post types
		add_action('init', 'portfolio_contact_custom_post_type');

		//add_filter( 'manage_yourcustomposttype_columns' );
		add_filter( 'manage_portfolio-contact_posts_columns', 'portfolio_set_contact_columns' );//update a MESSAGE option prebuilt information in WordPress dashboard. yourcustomposttype - portfolio-contact (write the same as in custom-post-type.php register_post_type( 'portfolio-contact', $args );). Changes just the middle ..._yourcustomposttype_...
		//After that need to create a function

		add_action( 'manage_portfolio-contact_posts_custom_column', 'portfolio_contact_custom_column', 10, 2 );//making to print a Message and email info after function portfolio_set_contact_columns( $columns ) is written and need to write a new function portfolio_contact_custom_column below.
		//Third value - when an action needs to be triggered. 10 is a default value for timing. The lower numbers will be written the earlier the execution of this number is triggered. 10 - meands that this will be triggered after the generation of the post type, after the creation of the filter.
		//Fourth parameter - the number of argumnets that we whant to pass. By default the argument is 1, but in this case there is 2 arguments so the number is 2.

		add_action('add_meta_boxes', 'portfolio_contact_add_meta_box');//trigering contact metabox of portfolio_contact_add_meta_box function.

		add_action( 'save_post', 'portfolio_save_contact_email_data' );// Second parameter - from function portfolio_save_contact_email_data.
	}


/* CONTACT Custom Post Type */
function portfolio_contact_custom_post_type(){
	$labels = array(
		'name'				=>	'Messages',
		'singular_name'		=>	'Message',
		'menu_name'			=>	'Messages',
		'name_admin_bar'	=>	'Message'
	);

	$args = array(
		'labels'			=> $labels,//$labels variable from $labels array
		'show_ui'			=> true,
		'show_in_menu'		=> true,
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'menu_position'		=> 26,//position number
		'menu_icon'			=> 'dashicons-email-alt',//icon from https://developer.wordpress.org/resource/dashicons/#email-alt . Select the icon and copy the name and paste ''.
		'supports'			=> array( 'title', 'editor', 'author' )
	);

	register_post_type( 'portfolio-contact', $args );

}

function portfolio_set_contact_columns( $columns ){// remove the - from the function name portfolio_set_portfolio-contact_columns 
	/*unset ( $columns['author'] );
	return $columns;*/
	$newColumns = array();
	$newColumns['title'] = 'Full Name';
	$newColumns['message'] = 'Message';
	$newColumns['email'] = 'Email';
	$newColumns['date'] = 'Date';
	return $newColumns;
}

function portfolio_contact_custom_column( $column, $post_id ){//this function loops through all the messages
	switch($column){//switch creating an if. Switch is analysing a variable and creating a statement for each type of variable that could be inside this column
		case 'message':
			//message column
			echo get_the_excerpt();
			break;
		case 'email':
			//email column. Print an email written in CONTACT META BOX
			$email = get_post_meta($post_id, '_contact_email_value_key', true);
			echo '<a href="mailto:'.$email.'">'.$email.'</a>';
			break;
	}
}


/*CONTACT META BOXES*/
//meabox in WordPress dashboard MESSAGE option
function portfolio_contact_add_meta_box(){
	add_meta_box('contact_email', 'User Email', 'portfolio_contact_email_callback', 'portfolio-contact', 'side');//Fourth parameter - post type id 'portfolio-contact' of portfolio_contact_custom_post_type function.
	//Fifth parameter - specify the position. 'normal' - puts it on the bottom of the screen. 'side' - puts it on a side of the screen.
	//Sixth parameter - priority options (high, core, default, low).
}

function portfolio_contact_email_callback( $post ){//calling the callback function
	wp_nonce_field('portfolio_save_contact_email_data', 'portfolio_contact_email_meta_box_nonce');//generates a unique id or value. Important to avoid third parties to access or inject something to a page.
	$value = get_post_meta($post->ID, '_contact_email_value_key', true); //  -> access an atribute of the object array.

	echo '<label for="portfolio_contact_email_field">User Email Address</label>';
	echo '<input type="email" id="portfolio_contact_email_field" name="portfolio_contact_email_field" value="' . esc_attr($value) . '" size="25" />';// id must be the identical as it was used in label for=""; input name="" must be an identical as the input id. esc_attr() - built in function to avoid injections from third parties.
}

function portfolio_save_contact_email_data( $post_id ){
	if( !isset($_POST['portfolio_contact_email_meta_box_nonce'] ) ){
		return;//if the portfolio_contact_email_meta_box_nonce metabox doesn't exist the function stops.
	}

	if( !wp_verify_nonce($_POST['portfolio_contact_email_meta_box_nonce'], 'portfolio_save_contact_email_data' ) ){
	//checking if portfolio_contact_email_meta_box_nonce is valid.
	//First value is idetical to if( !isset($_POST['portfolio_contact_email_meta_box_nonce'] ) )
	//Second value - the name of the function.
		return;
	}

	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}//checking if users is saving the draft

	if( !current_user_can( 'edit_post', $post_id )){//checking for users permision
		return;
	}
	
	if( !isset($_POST['portfolio_contact_email_field']) ){//in$_POST[''] - inside must be the same as in function portfolio_contact_email_callback input id
		return;
	}

	$my_data = sanitize_text_field($_POST['portfolio_contact_email_field']);//sanitize-text_field - makes sure that nothing bad will not be saved in a database.
	update_post_meta($post_id, '_contact_email_value_key', $my_data);//First value - post_id taken from portfolio_contact_email_callback function. Second value - meta key ($value = get_post_meta($post->ID, '_contact_email_value_key', true);)

}//after that add a variable to function portfolio_contact_custom_column and echo.






?>

