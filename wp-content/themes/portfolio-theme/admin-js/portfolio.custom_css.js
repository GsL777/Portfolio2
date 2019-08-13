jQuery(document).ready(function($){
	var updateCSS = function(){
		$("#portfolio_css").val( editor.getSession().getValue() );
	}//#portfolio_css taken from function-admin.php

	$("#save-custom-css-form").submit( updateCSS )//from portfolio-custom-css.php id="". And call the var updateCSS.
	
});

var editor = ace.edit("customCss");
editor.setTheme("ace/theme/monokai");//WP DASHBOARD PORTFOLIO CUSTOM CSS themes from admin-js -> ace
editor.getSession().setMode("ace/mode/css");

