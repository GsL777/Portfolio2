<!-- Custom Portfolio Contact Form on WordPress dashboard-->
<h1>Portfolio Contact Form</h1>

<?php settings_errors();//function that will print an error ?>

<p>Use this <strong>shortcode</strong> to activate the Contact Form inside a Page or Post</p>
<p><code>[contact_form]</code></p> <!-- shortcode in inc -> shortcodes.php -->

<form method="post" action="options.php" class="portfolio-general-form">
	<?php settings_fields( 'portfolio-contact-options' ); ?>
	<?php do_settings_sections('gytis_portfolio_theme_contact');?>
	<?php submit_button(); ?>
</form>
