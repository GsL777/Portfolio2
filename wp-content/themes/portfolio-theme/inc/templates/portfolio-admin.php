
<!-- function-admin.php related to portfolio-admin.php -->
<h1>Portfolio Sidebar Options</h1>

<?php settings_errors();//function that will print an error ?>


<?php 
	//functions needs to be recalled, because they can't be used from outside(function-admin.php) the portfolio-admin.php file
	$picture = esc_attr(get_option('profile_picture'));
	$firstName = esc_attr(get_option('first_name'));
	$lastName = esc_attr(get_option('last_name'));
	$fullName = $firstName . ' ' . $lastName;
	$description = esc_attr(get_option('user_description'));

	$facebook = esc_attr( get_option('facebook_handler') );
	$linkedin = esc_attr( get_option('linkedin_handler') );
	$github = esc_attr( get_option('github_handler') );
	$gmail = esc_attr( get_option('gmail_handler') );
	// $twitter = esc_attr( get_option('twitter _handler') );

 ?>
<div class="portfolio-sidebar-preview">
	<div class="portfolio-sidebar">
		<div class="image-container"><!-- button function to upload pictures (to put code in portfolio_custom_settings, portfolio_sidebar_profile functions). To make it work need to write jquery in portfolio.admin.js and in portfolio-admin.php write a html to print a picture.  Define a $picture variable and it must be the same id as in function-admin.php file portfolio_custom_settings function register_setting second value. Than print $picture url-->
			<div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $picture; ?>);">
				<!-- <img src="<?php //print $picture; ?>" /> --> <!-- select the picture AND SAVE THE CHANGES -->
			</div>
		</div>
		<h1 class="portfolio-username"><?php print $fullName; ?></h1>
		<h2 class="portfolio-description"><?php print $description; ?></h2>
		<div class="icons-wrapper">
			<?php if(!empty($facebook) ): ?>
				<span class="portfolio-icon-sidebar portfolio-icon-sidebar--facebook dashicons-before dashicons-facebook-alt"></span><!-- style in portfolio.admin.css -->
			<?php endif; ?>
			<?php if(!empty($linkedin) ): ?>
				<span class="portfolio-icon-sidebar portfolio-icon-sidebar--linkedin dashicons-before dashicons-linkedin"></span><!-- style in portfolio.admin.css -->
			<?php endif; ?>
			<?php if(!empty($github) ): ?>
				<span class="portfolio-icon-sidebar portfolio-icon-sidebar--github dashicons-before dashicons-github"></span><!-- style in portfolio.admin.css -->
			<?php endif; ?>
			<?php if(!empty($gmail) ): ?>
				<span class="portfolio-icon-sidebar portfolio-icon-sidebar--gmail dashicons-before dashicons-email-alt"></span><!-- style in portfolio.admin.css -->
			<?php endif; ?>
			<!-- <?php if(!empty($twitter) ): ?>
				<span class="portfolio-icon-sidebar portfolio-icon-sidebar--twitter dashicons-before dashicons-twitter"></span>
			<?php endif; ?> -->
		</div>
	</div>
</div>

<form method="post" action="options.php" class="portfolio-general-form">
	<?php settings_fields( 'portfolio-settings-group' ); //put portfolio-settings-group from function-admin.php portfolio_custom_settings ?>
	<?php do_settings_sections('gytis_portfolio'); //have to specify the the section where the name belongs. gytis_portfolio taken from function-admin function portfolio_custom_settings add_settings_section FOURTH PARAMETER?>
	<?php submit_button( 'Save Changes', 'primary', 'btnSubmit' );//First parameter - text parameter of submit button. Second parameter - the type of the button. Third parameter - name will be used as an id. 
	//code is written in function-admin.php function portfolio_sidebar_profile(), portfolio.admin.js to work as a REMOVE BUTTON.
	?>
</form>

