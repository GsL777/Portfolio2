<?php 
/*

@package portfolio-theme

	==========================================
		SHORTCODE OPTIONS
	==========================================
*/

//TOOLTIP
//https://getbootstrap.com/docs/4.0/components/tooltips/
function portfolio_tooltip( $attr, $content = null ){//First parameter - the array that contains the attributes. Second parameter - is the content. Text wrapped around a shortcode. $content = null - default action not to trigger an error if [tooltip][/tooltip] is empty.

/*
[tooltip placement="top" title="This is the title"]This is the content[/tooltip]

always use lowecase. Do not use _ or - and capital letters inside []
*/

	//get the attributes
	$attr = shortcode_atts(
		array(
			'placement'	=> 'top',
			'title'		=> '',
		),
		$attr,
		'tooltip'
	);

	$title = ( $attr['title'] == '' ? $content : $attr['title'] );

	//return HTML
	return '<span class="portfolio-tooltip" data-toggle="tooltip" data-placement="' . $attr['placement'] . '" title="' . $title . '">' . $content . '</span>';//in the dasboard -> post -> select a post write arround the word [tooltip placement="top" title="Tooltip Title"][/tooltip] -> press update. To activate the tooltip write javascript in portfolio.js revealPosts(); function. style in single.scss
}

add_shortcode( 'tooltip', 'portfolio_tooltip' ); //First Variable - shorcode name, Second variable - the name of the function shortcode that must be called
//For function to work need to put $('[data-toggle="tooltip"]').tooltip(); to revealPosts function to portfolio.js

//POPOVER

function portfolio_popover( $attr, $content = null ){
	/*[popover title="Popover Title" placement="top" content="This is the Popover Content"]This is the clickable content[/popover]
	*/

	$attr = shortcode_atts(
		array(
			'placement'	=> 'top',
			'title'		=> '',
			'trigger'	=> 'click',
			'content'	=> ''
		),
		$attr,
		'popover'
	);

	//return HTML
	return '<span class="portfolio-popover" data-toggle="popover" data-placement="' . $attr['placement'] . '" title="' . $attr['title'] . '" data-trigger="' . $attr['trigger'] . '" data-content="' . $attr['content'] . '">' . $content . '</span>';

	//return HTML
	/*
	return '<button type="button" class="btn btn-lg btn-danger" data-toggle="popover" data-trigger="click" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>';
	*/
}

add_shortcode( 'popover', 'portfolio_popover' );//For function to work need to put $('[data-toggle="popover"]').popover(); to revealPosts function to portfolio.js


//CONTACT FORM SHORTCODE
function portfolio_contact_form( $attr, $content = null ){//First parameter - the array that contains the attributes. Second parameter - is the content. Text wrapped around a shortcode. $content = null - default action not to trigger an error if [contact_form][/contact_form] is empty.

/*
[contact_form placement="top"]This is the content[/contact_form]

always use lowecase. Do not use _ or - and capital letters inside []
*/

	//get the attributes
	$attr = shortcode_atts(
		array(),//return empty array, because don't have anything
		$attr,
		'contact_form'//specify the type of shortcode code that the system have to recognise and in this case it is contact_form. contact_form - a shortcode name.
	);

	//return HTML
	ob_start();//ob_start(); - turn on output buffering (ob-stands for output buffering) and if it is turned on it will prevent any outputs sent from the script to be injected or outputted immediately.
	include 'templates/contact-form.php';

	return ob_get_clean();//files in portfolio-contact-form.php, content-contact.php
}

add_shortcode( 'contact_form', 'portfolio_contact_form' ); //First Variable - shortcode name, Second variable - the name of the function shortcode that must be called

//RESUME FORM SHORTCODE
function portfolio_resume($attr, $content = null){

	$attr = shortcode_atts(
		array(
		),
		$attr,
		'resume'
	);

	//return HTML
	return '<span class="portfolio-resume" data-toggle="resume">' . $content . '</span>';

}

add_shortcode('resume', 'portfolio_resume');

?>
