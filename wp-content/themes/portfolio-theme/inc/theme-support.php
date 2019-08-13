<?php 
/*

@package portfolio-theme

	==========================================
		THEME SUPPORT OPTIONS
	==========================================
*/

//activate of checkboxes function portfolio_post_formats function-admin.php . IT GIVES USER AN ABILITY TO ACTIVATE ADITIONAL OPTIONS
//lesson 9 alecaddd
//portfolio-theme-support.php file, function-admin.php portfolio_custom_settings add_settings_section and add_settings_field function. Then function portfolio_post_formats
	$options = get_option('post_formats');//from function-admin.php portfolio_post_formats function
	$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
	$output = array();

foreach ($formats as $format) {
		$output[] = ( @$options[$format] == 1 ? $format : '' );//@ - means if it is set (@ - checking automatically if the variable exist). ? - code after question mark means return the written value (like elseif), : - else (returns empty value) 
}	

if(!empty( $options )){
	add_theme_support( 'post-formats', $output );
}


//activate of checkboxes function portfolio_custom_header function-admin.php
$header = get_option('custom_header');
	if(@$header == 1){
		add_theme_support('custom-header');
	}


//activate of checkboxes function portfolio_custom_background function-admin.php
$background = get_option('custom_background');
	if(@$background == 1){
		add_theme_support('custom-background');
	}


add_theme_support( 'post-thumbnails' );//post-thumbnails - Lets to set Featured Image in Wordpress dashboard -> Posts. Developing content.php


/* Activate Nav Menu Option */
function portfolio_register_nav_menu(){
	register_nav_menu( 'primary', 'Header Navigation Menu' );//First parameter - location unique name. For two word use _, but do not use -   . Second parameter - description. 
}
add_action('after_setup_theme', 'portfolio_register_nav_menu');//call an action to activate a function.

/*
	==========================================
		SIDEBAR FUNCTIONS
	==========================================
*/

function portfolio_sidebar_init(){//in sidebar.php and header.php files
	register_sidebar(
		array(
			'name'			=> esc_html__( 'Portfolio Sidebar', 'portfoliotheme' ),
			'id'			=> 'portfolio-sidebar',
			//'class'			=> 'sidebar-custom',//applies only in the backend
			'description'	=> 'Dynamic Right Sidebar',
			'before_widget' => '<section id="%1$s" class="portfolio-widget %2$s">',//%1$s - (%) are connected to the sprintf php function and to the id and ($) the class of a sidebar. The class change based on the class that is specified and the id changes based on the id that is specified.
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="portfolio-widget-title">',
			'after_title'   => '</h2>'

		)
	);
}

add_action('widgets_init', 'portfolio_sidebar_init');//to activate portfolio_sidebar_init function



/*
	==========================================
		BLOG LOOP CUSTOM FUNCTIONS
	==========================================
*/
function portfolio_posted_meta(){//fyle in content.php and template-parts->single.php
	$posted_on = human_time_diff( get_the_time('U') , current_time('timestamp') );
	
	$categories = get_the_category();
	$separator = ', ';
	$output = '';
	$i = 1;
	
	if( !empty($categories) ):
		foreach( $categories as $category ):
			if( $i > 1 ): $output .= $separator; endif;
			$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( 'View all posts in%s', $category->name ) .'">' . esc_html( $category->name ) .'</a>';
			$i++; 
		endforeach;
	endif;
	
	return '<span class="posted-on">Posted <a href="'. esc_url( get_permalink() ) .'">' . $posted_on . '</a> ago</span> / <span class="posted-in">' . $output . '</span>';
	
}

/*Comments activation in single.php file*/
function portfolio_posted_footer(){//fyle in content.php
	$comments_num = get_comments_number();
	if(comments_open() ){
		if($comments_num == 0 ){
			$comments = __('No Comments');
		} elseif ($comments_num > 1){
			$comments = $comments_num . __('Comments');
		}else{
			$comments = __('1 Comment');
		}
		$comments = '<a class="comments-link" href="' . get_comments_link() . '">' . $comments . '<span class="portfolio-icon portfolio-comment"></span></a>';//<span class="portfolio-icon portfolio-comment"></span> - with these classes we can put an icon on the left of the comments menu.
	} else {
		$comments = __('Comments are closed');
	}

	// return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">' . get_the_tag_list('<div class="tags-list"><span class="portfolio-icon portfolio-tag"></span>', ' ', '</div>' ) . '</div><div class="col-xs-12 col-sm-6 text-right">' . $comments . '</div></div></div>';

	return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">' . get_the_tag_list('<div class="tags-list"><span class="portfolio-icon portfolio-tag"></span>', ' ', '</div>' ) . '</div><div class="col-xs-12 col-sm-6 text-right"></div></div></div>';
}


function portfolio_get_attachment( $num = 1 ){//content-image.php entry-header style="background-image: url()"
//variable $num = 1 - if there will be declared a function without a variable the default value will be 1, but no Null and it will not break a code. Than change a 'posts_per_page' number with a variable $num.
	$featured_image = '';//$featured_image from entry-header style="background-image:url()"
		if( has_post_thumbnail() && $num == 1 ): //if the featured picture is set in WordPress dashboard.
			$featured_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
			//WP function wp_get_attachment_url() - retrive the url of picture if we know the ID of that specific picture.
			//get_post_thumbnail_id() - To get the id.
			//get_the_ID() - as a value to specify a post id.
		else:
			//if the picture is not set as a featured image and putted to a text area with upload media button. Than we need to put an empty variable $featured_image = ''; above all code and add an else
			$attachments = get_posts( array(
				'post_type'			=>	'attachment',// WordPress saves everything as a post type (A post, A page, attachment). 'attachment' - means that there will be only images inside.
				'posts_per_page'	=> $num,//'posts_per_page' - image to print. 1 - is a limitation of posts that is retrieving.
				'post_parent'		=> get_the_ID()//'post_parent' - declare what kind of parent we whant to check, whick post we whant to check otherwise it will retrive all the atachments we ever uploaded to WordPress.
			) );//retrive all the attachments to a specific posts. Function get_posts - get a specific list of posts asign to this current post.

			//var_dump($attachments);

			if( $attachments && $num == 1 ): //check if attachments is not empty.
				foreach ($attachments as $attachment) ://loop to access the array to navigate in it properly.
					$featured_image = wp_get_attachment_url( $attachment->ID );//we have to access id of attachment variable and navigating inside of the object array and retrive the object id that is the same value as it was written with var_dump($attachments); and was found that it is ["ID"] => int(47).
				
				endforeach;
			elseif( $attachments && $num > 1 ):
				$featured_image = $attachments; 
				
			endif;

			wp_reset_postdata();//we are not affect the blog loop that is inside index and not going to disrupt our homepage.

		endif;//GO TO WP DASBOARD -> MEDIA -> SELECT LIST ICON ON THE LEFT AND UNATTACH ALL OF THE IMAGES. THAN GO TO POSTS -> SELECT A POST -> ADD MEDIA -> SELECT A PICTURE -> INSERT PHOTO -> MAKE SURE IT IS UNDER THE TEXT -> UPDATE. IF IT DOESN'T WORK REUPLOAD AN IMAGE.

		return $featured_image;
}


function portfolio_get_bs_slides ($attachments){//content in content-gallery.php

	$output = array();
	$count = count($attachments)-1;

	for($i = 0; $i <= $count; $i++ ): 
		
		$active = ( $i == 0 ? 'active' : '' );

		$next = ( $i == $count ? 0 : $i+1 ); //$i+1 - +1, because we are using $i variable as a starting point and as a number, but not increasing a variable every time.
		$nextImg = wp_get_attachment_thumb_url( $attachments[$next]->ID );

		$prev = ( $i == 0  ? $count : $i-1 ) ;
		$prevImg = wp_get_attachment_thumb_url( $attachments[$prev]->ID );

		$output[$i] = array( 
			'class'		=>	$active, 
			'url'		=>	wp_get_attachment_url( $attachments[$i]->ID ),
			'next_img'	=>	$nextImg,
			'prev_img'	=>	$prevImg,
			'caption'	=>	$attachments[$i]->post_excerpt
		);
?>

<!--
	<div class="carousel-item <?php echo $active; ?> background-image2 standard-featured2" style="background-image: url( <?php  //echo wp_get_attachment_url( $attachments[$i]->ID ); //function from theme-support.php function portfolio_get_attachment() variable inside foreach ?> );">

		<div class="hide next-image-preview" data-image="<?php echo $nextImg; ?>"></div><!-- in the data-image="" it is stored next image url. -image could be changed as an exapmle data-portfolio="".....

		<div class="hide prev-image-preview" data-image="<?php echo $prevImg; ?>"></div><!-- in the data-image="" it is stored previous image url. -image could be changed as an exapmle data-portfolio="".....

		<!-- dynamically put $nextImg; and $prevImg; value inside the .carousel-control container. file in assets -> js -> portfolio.js 

		<div class="entry-excerpt image-caption">
			<p><?php echo $attachments[$i]->post_excerpt; //in WP media -> press on a picture -> write a caption inside (in a post you can't write a capition, because if you write it will be written not in database, but just as words). Than var_dump($attachments[$i]); and find array post_excerpt and there must be a number inside, but not 0. ?></p>
			<?php //var_dump($attachments[$i]); ?>
		 
		</div>

	</div>
-->

	<?php endfor; 

	return $output;

}

function portfolio_grab_url(){//function in content-link.php 
	if ( !preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links) ){//php function that gives an ability to use a regex pattern to crawl whatever information and store this information inside a specific variable, array....

	/*FIRST PARAMETER:
	regex starts between / / 2 forward slashes.
	\s - regex pattern doesn't recognize spaces so \s recognizes all the spaces. There could be 5 spaces and still need to write one time \s.
	[^>] - it matches any character that is not in the set so it strips away and avoids to create any issue if a character doesn't match the declaration that we whant.
	with this symbol ^> we are saying the pattern to avoid to consider the closing tag of <a link.
	*? - causing to match as few characters as possible.
	['"] - by declaring inside the [] whatever element we whant we are saying to the pattern to avoid these elements (in this case '").
	() - to grab the variable. 
	.+? - to say that we whant to grab any information is inside here matches any character except the line brakes, that the dot . stands for + match one or more of the proceeding tokens (in this case is any characters ) and then use ? mark to avoid to match too many characters.

	To work a wrapper properly insert \ in both [] places.
	i - ignore all the cases and makes all expression case sensitive. Ignore all the case sensitive stuff.
	*/

	/*
	SECOND PARAMETER:
	get_the_content() - using the function to retrive the information not styled, not wrapped, not formated by WordPress as a default.
	*/

	/*
	THIRD PARAMETER:
	$links - variable that will be turned to an array to collect all the matches that will be get from regex.
	*/


		return false;
	}
	return esc_url_raw($links[1] );//that this is the raw format not formated of the url of $links.
}


/*
	===========================================================
		FOR THE BUX FIX TO LOAD THE LOCALHOST ON REFRESH  START
	===========================================================
*/
function portfolio_grab_current_uri(){

	$http = ( isset( $_SERVER["HTTPS"] ) ? 'https://' : 'http://' );

	//$referer = ( isset($_SERVER["HTTP_REFERER"]) ? rtrim($_SERVER["HTTP_REFERER"], "/") : $http . $_SERVER["HTTP_HOST"] );
	$referer = $http . $_SERVER["HTTP_HOST"];//$referer update


	$archive_url = $referer . $_SERVER["REQUEST_URI"];  //to remove the last character that is inside the string need to use PHP function r_trim. HTTP_REFERER - request for the server to print http referer for the LOCALHOST.

	return $archive_url;
}

/*
	==========================================================
		FOR THE BUX FIX TO LOAD THE LOCALHOST ON REFRESH END
	==========================================================
*/


/*
	==========================================
		SINGLE POST CUSTOM FUNCTIONS
	==========================================
*/

function portfolio_post_navigation(){ //function putted to single.php to change the_post_navigation(); function.

	$nav = '<div class="row post-navigation">';

	$prev = get_previous_post_link( '<div class="post-link-nav"><i class="fa fa-angle-left"></i>%link<span class="portfolio-icon portfolio-prev-icon" aria-hidden="true"></div>', '%title' );//%link - WP shortcode to recognise that link is a placeholder to print the link in this location.
	$nav .= '<div class="col-xs-12 col-sm-6 text-left">' . $prev . '</div>';

	$next = get_next_post_link( '<div class="post-link-nav">%link<span class="portfolio-icon portfolio-next-icon" aria-hidden="true"><i class="fa fa-angle-right"></i></span></div>', '%title' );
	$nav .= '<div class="col-xs-12 col-sm-6 text-right">' . $next . '</div>';

	$nav .= '</div>';

	return $nav;
}

//function for testing
/*
function mailtrap($phpmailer) {//code in ajax.php function portfolio_save_contact();
  $phpmailer->isSMTP();
  $phpmailer->Host = 'mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '';
  $phpmailer->Password = '';
}

add_action('phpmailer_init', 'mailtrap');
*/

//Initialize global Mobile Detect

function mobileDetectGlobal(){

	global $detect;

	$detect = new Mobile_Detect;

}

add_action('after_setup_theme', 'mobileDetectGlobal');//after_setup_theme - WordPress built in action 


/*
	==========================================
		 CUSTOM POST TYPE
	==========================================
*/

//CREATES NEW SECTION IN WORDPRESS DASHBOARD

function portfolio_custom_post_type(){

	$labels = array(
		'name'					=> 'Projects',
		'singular_name'			=> 'Project',//singular name will be used in administration panel (dashboard)
		'add_new'				=> 'Add Item',//buttons name 
		'all_items'				=> 'All Items',//administration labels
		'add_new_item'			=> 'Add Item',
		'edit_item'				=> 'Edit Item',
		'new_item'				=> 'New Item',
		'view_item'				=> 'View Item',
		'search_item'			=> 'Search Projects',
		'not_found'				=> 'No items found',
		'not_found_in_trash'	=> 'No items found in trash',
		'parent_item_colon'		=> 'Parent Item'

	);

	$args = array(
		'labels'				=> $labels,
		'public'				=> true,
		'has_archive'			=> true,
		'publicly_queryable'	=> true,
		'query_var'				=> true,
		'rewrite'				=> true,
		'capability_type'		=> 'post',
		'hierarchical'			=> false,
		'supports'				=> array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revision' //revision - automatically save previous version in database so we could rehover different versions of that specific post type.
		), //type of support - are all the standart information that is found inside a post of a page (the title, the excerpt, thumbnail, custom fields...).
		/*'taxonomies'			=> array( //it will be shown on the WP dashboard new created custom post type
			'category',
			'post_tag'
		),*/
		'menu_position'			=> 5,
		'exclude_from_search'	=> false
	);

	register_post_type('projects', $args);//First value - the slug(name of projects). Second value - contains all the arguments of the created post type.

}

add_action('init', 'portfolio_custom_post_type');

/*
	==========================================
		 CUSTOM TAXONOMY
	==========================================
*/

function portfolio_custom_taxonomies(){//After adding taxonomies link, do not forget to "refresh" the permalinks in WP dashboard (switch back to 'simple or regular' permalinks' go to page, refresh and clean the cache) otherwise your archive page for the custom Taxonomies will end up in a 404.!!!!!!!

	//First type of taxonomy.
	//add new taxonomy hierarchical
	$labels = array(
		'name'				=> 'Fields',//like a category in a WP dashboard -> post
		'singular_name'		=> 'Field',
		'search_items'		=> 'Search Fields',
		'all_items'			=> 'All Fields',
		'parent_item'		=> 'Parent Field',
		'parent_item_colon'	=> 'Parent Field:',
		'edit_item'			=> 'Edit Field',
		'update_item'		=> 'Update Field',
		'add_new_item'		=> 'Add New Field',
		'new_item_name'		=> 'New Field Name',
		'menu_name'			=> 'Field'
	);

	$args = array(
		'hierarchical'		=> true, 
		'labels'			=> $labels,
		'show_ui'			=> true,
		'show_admin_column'	=> true,
		'query_var'			=> true,
		'rewrite'			=> array( 'slug' => 'field' )//mysite.com/development. If the slug is rewtritten mysite.com/field/development

	);

	register_taxonomy('field', array('projects'), $args);//First value - name of the taxonomy and it is better that it will match the slug (in this case type).//Second parameter - object type that gives the ability to specify which post type we whant to attach this custom taxonomy(in this case insert the same as in the register_post_type('projects', $args); custom post type name).//Third value - the arguments that contains all the labels and all the parameters

	//Second type of taxonomy.
	//add new taxonomy NOT hierarchical

	register_taxonomy( 'software', 'projects', array(
		'label'			=> 'Software',
		'rewrite'		=> array( 'slug' => 'software' ),
		'hierarchical'	=> false

	) );

}

add_action(	'init', 'portfolio_custom_taxonomies' );// when the new custom post type is created need a new single-projects.php file in this case and in it need to change the_category(' '); and the_tags(); code to function, because it will not work.

/*
	==========================================
		CUSTOM TERM FUNCTION
	==========================================
*/

	//function printed in single-projects.php and it's related with page-projects-template.php and archive-projects.php
function portfolio_get_terms($postID, $term){/*Instead of the_category(' '); the_tags(); could be changed to the following code:*/
	
	$terms_list = wp_get_post_terms( $postID, $term);//$term-taxonomy name.

	$output = '';//output of the current function that will be returned.
	
	$i = 0;
	foreach ($terms_list as $term): $i++;
		if( $i > 1 ):
			$output .= ', ';
		endif;
		// $output .= $term->name;//.= adds the variable to the existing one. = - overwrites the variable.
		$output .= '<a href="' . get_term_link( $term ) . '">'. $term->name .'</a>'; //get_term_link() - makes the categories and tags clickable

		// $output .= get_term_link( $term );
	endforeach;

	return $output;

}//After adding taxonomies link, do not forget to "refresh" the permalinks in WP dashboard (switch back to 'simple or regular' permalinks' go to page, refresh and clean the cache) otherwise your archive page for the custom Taxonomies will end up in a 404.!!!!!!!


?>