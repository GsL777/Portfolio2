<?php
/*

@package portfolio-theme

	==========================================
		WIDGET CLASS
	==========================================

*/

//style in sidebar.scss took from css-> portfolio.admin.css
class Portfolio_Profile_Widget extends WP_Widget {

	//setup the widget name, description, etc...
	public function __construct() {//construct will be executed as Portfolio_Profile_Widget class will be called
		$widget_options = array(
			'classname'	=> 'portfolio-profile-widget',
			'description' => 'Custom Portfolio Profile Widget',

		);
		parent::__construct( 'portfolio_profile', 'Portfolio Profile', $widget_options );//First variable - id of the widget. Second variable - the name of the widget. Third variable - array variable that we have to pass.
		//:: - is a token that allows access to static, constant, and overridden properties or methods of a class. 
	}

	//back-end display of widget
	public function form( $instance ) {
		echo '<p><strong>No options for this Widget!</strong><br></p><p>You can control the fields of this Widget from <a href="./admin.php?page=gytis_portfolio">This Page</a></p>';
	}

	//front-end display of widget
	public function widget( $args, $instance ){//$args - all the arguments that is going to be declared. $instance - carry all the option to that specific SINGLE widget and it's going to change based on how many widgets we going to use.

		$picture = esc_attr(get_option('profile_picture'));
		$firstName = esc_attr(get_option('first_name'));
		$lastName = esc_attr(get_option('last_name'));
		$fullName = $firstName . ' ' . $lastName;
		$description = esc_attr(get_option('user_description'));

		$facebook = esc_attr(get_option('facebook_handler'));
		$linkedin = esc_attr( get_option('linkedin_handler') );
		$github = esc_attr( get_option('github_handler') );
		$gmail = esc_attr( get_option('gmail_handler') );
		// $linkedin = 'https://www.linkedin.com/';
		// $github = 'https://github.com/github';
		// $google = 'https://www.google.com/intl/lt/gmail/about/';

		echo $args['before_widget'];//in theme-support.php portfolio_sidebar_init function.
?>
	<!-- Go to dashboard -> Appearance -> Widgets -> Drag and drop 'Portfolio Profiles' widget to Portfolio sidebar and it will show a picture from Dashboard -> Portfolio -> Sidebar -->
	<div class="text-center"> 
		<div class="image-container">
			<div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $picture; ?>);">
			</div>
		</div>
		<h1 class="portfolio-username"><?php print $fullName; ?></h1>
		<h2 class="portfolio-description"><?php print $description; ?></h2>
		<div class="icons-wrapper">
			<?php if(!empty( $facebook ) ): ?>
				<a href="https://www.facebook.com/<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			<?php endif; ?>
			<?php if(!empty( $linkedin ) ): ?>
				<a href="https://www.linkedin.com/in/<?php echo $linkedin; ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
			<?php endif; ?>
			<?php if(!empty( $github ) ): ?>
				<a href="https://github.com/<?php echo $github; ?>" target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a>
			<?php endif; ?>
			<?php if(!empty( $gmail ) ): ?>
				<a href="https://mail.google.com/mail/<?php echo $gmail; ?>" target="_blank"><i class="fa fa-at" aria-hidden="true"></i></a>
			<?php endif; ?>
		</div><!-- .image-container -->
	</div>
<?php
		echo $args['after_widget'];
	}

}

add_action( 'widgets_init', function(){
	register_widget( 'Portfolio_Profile_Widget' );
} );



/*Edit default WordPress widgets*/
function portfolio_tag_cloud_font_change( $args ){ //font size appears on the sidebar TAGS section
	$args['smallest'] = 8;
	$args['largest'] = 8;

	return $args;
}

add_filter('widget_tag_cloud_args', 'portfolio_tag_cloud_font_change'); //hook a custom function portfolio_tag_cloud_font_change to be used in the widgets tag cloud. widget_tag_cloud_args - tjhis function is going to call a specific filter to be applied to the specific function in this case to portfolio_tag_cloud_font_change() function.


?>