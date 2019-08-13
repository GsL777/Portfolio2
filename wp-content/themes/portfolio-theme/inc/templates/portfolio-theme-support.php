<!-- Custom Portfolio Theme Support on WordPress dashboard-->
<h1>Portfolio Theme Support</h1>

<?php settings_errors();//function that will print an error ?>

<form method="post" action="options.php" class="portfolio-general-form">
	<?php settings_fields( 'portfolio-theme-support' ); ?>
	<?php do_settings_sections('gytis_portfolio_theme');?>
	<?php submit_button(); ?>
</form>
