<!-- Custom Portfolio Custom CSS on WordPress dashboard-->
<h1>Portfolio Custom CSS</h1>

<?php settings_errors();//function that will print an error ?>

<form id="save-custom-css-form" method="post" action="options.php" class="portfolio-general-form">
	<?php settings_fields('portfolio-custom-css-options'); ?>
	<?php do_settings_sections('gytis_portfolio_css');?>
	<?php submit_button(); ?>
</form>