//Javascript functions
//$.noConflict(); //jquery $ sign doesn't conflict with other javascript functions


	//Custom portfolio scripts
jQuery(document).ready(function($){

	revealPosts();//revealPosts(). Init functions

	$(window).scroll(function(){

		var wScroll = $(this).scrollTop();

		// console.log(wScroll);
		//parallax technique - fixed background, moving elements START
		$('.pen').css({
			'transform' : 'translate(0px, '+ wScroll /3 +'%)'
		});//+ +  -  adds to the string. /2 - slow it down by to. % - unit type in this case px, because First elevent is px.

		$('.apple').css({
			'transform' : 'translate(0px, -'+ wScroll /4 +'%)'
		}); //with a - (minus) before icon goes to the top.
		//parallax technique - fixed background, moving elements END

		//Parallax Landing Elements START
/*		if(wScroll > $('.project-pics').offset().top - ($(window).height() / 1.3)){
			$('.project-pics .columns').each(function(i){

				setTimeout(function(){
					$('.project-pics .columns').eq(i).addClass('is-showing');
				}, 150 * (i+1));//eq(i) - eq looks at the index(in this case i) and finds the right one 

			});
		}//Parallax Landing Elements END
*/
	});

	

	
	/*VARIABLE DECLARATIONS*/
	//var carousel = '.portfolio-carousel-thumb';
	var last_scroll = 0;/*variable used to store everytime it is checked and detect a container and it the value will be updated of the last_scroll to be fixed and not to repeat the same check every time.
	Variable for the scroll function.
	*/

	/*CAROUSEL FUNCTIONS*/
/*	
	portfolio_get_bs_thumbs(carousel);
	// console.log(carousel);
	$(carousel).on('slid.bs.carousel', function(){
		portfolio_get_bs_thumbs(carousel);

	});
*/
	$(document).on('click', '.portfolio-carousel-thumb', function(){
		var id = $("#" + $(this).attr("id"));
		$(id).on('slid.bs.carousel', function(){
			portfolio_get_bs_thumbs(id);
		});
		
	});

	$(document).on('mouseenter', '.portfolio-carousel-thumb', function(){
		var id = $("#" + $(this).attr("id"));
		portfolio_get_bs_thumbs(id);
	});

	function portfolio_get_bs_thumbs ( id ){
		//this changed to the id to fix the carousel bug of not changing the picture when pressing the arrow
		var nextThumb = $(id).find(".carousel-item.active").find(".next-image-preview").data("image");
		var prevThumb = $(id).find(".carousel-item.active").find(".prev-image-preview").data("image");
		$(id).find(".right.carousel-control").find(".thumbnail-container").css({"background-image" : "url("+ nextThumb +")"});
		$(id).find(".left.carousel-control").find(".thumbnail-container").css({"background-image" : "url("+ prevThumb +")"});

		//jquery fix to prevent the thumbnail of one carousel to effect the other
		//loop through all the carousels that there is in the page
		/*$(carousel).each(function(){
			//this reference - this carousel or the class before the .each who is looping will curently apply to this global variable. 
			//this - is not a variable that is not declared, but it's going to grab automatically all the info that will be stored from the .each function.
			var nextThumb = $(this).find('.next-image-preview').data('image');
			var prevThumb = $(this).find('.prev-image-preview').data('image');
			$(this).attr("data-page).find('.carousel-control.right').find('.thumbnail-container').css({ 'background-image' : 'url('+nextThumb+')' });
			$(this).find('.carousel-control.left').find('.thumbnail-container').css({ 'background-image' : 'url('+prevThumb+')' });
			
		});
		*/
		/*
			var nextThumb = $('.carousel-item.active').find('.next-image-preview').data('image');
			var prevThumb = $('.carousel-item.active').find('.prev-image-preview').data('image');
			$(carousel).find('.carousel-control.right').find('.thumbnail-container').css({ 'background-image' : 'url('+nextThumb+')' });
			$(carousel).find('.carousel-control.left').find('.thumbnail-container').css({ 'background-image' : 'url('+prevThumb+')' });
		*/
		
	}

	$(document).on('click', '.portfolio-load-more:not(.loading)', function(){//$(document).on('click' - action is activated when portfolio-load-more doesn't have .loading class applied to it
		
		var that = $(this);//inside that will be stored .portfolio-load-more or whatever button is clicked

		var page = that.data('page'); //page - is a name of a data-PAGE in index.php in Load More container.
		//console.log(page);

		var newPage = page+1;

		//we have to point javascript where the file admin-ajax.php is. portfolio2 -> wp-admin -> admin-ajax.php
		var ajaxurl = that.data('url'); //url in index.php data-(name), data url.

		//for previuos ajax button START
		var prev = that.data('prev');

		var archive = that.data('archive');//for archive page archive.php

		if( typeof prev === 'undefined' ){
			prev = 0; //if it is equal to 1 it means that it could load the previous post and not the next one
		}
		//for previuos ajax button END


		//archive page START
		if( typeof archive === 'undefined' ){//The typeof operator when applied to the jQuery object returns the string "function". Basically that does mean that jQuery is a function.
			archive = 0;
		}
		//archive page END

		//IN JQUERY IF YOU ADD OR REMOVE THE CLASSES DO NOT HAVE TO REMOVE THE DOT (.)
		//IF YOU ARE SEARCHING FOR A CLASS YOU HAVE TO PUT A DOT (.).
		that.addClass('loading').find('.text').slideUp(320);
		that.find('.portfolio-icon').addClass('spin');

		$.ajax({

			url : ajaxurl,
			type : 'post',// post - the same type that it is seen in a <form> and the post methot in ajax is a default type.
			//$_POST (post method) - is a method that passes all the variables hidden inside the reload of the page. These methods are not getting printed anywhere.
			//$_GET (get method) - print the variables inside the url so you will see the variables inside the url. GET method is not safe
			data : { // data contains all the custom data like the array and we can write in the {} and send to the ajax function
				
				page : page, //First variable - page is the name of the variable
				prev : prev, //variable for previous ajax button. prev is used in ajax.php
				archive : archive, //Archive variable 
				action: 'portfolio_load_more' //Second variable - action. We are sending a data to a php file and the php file in order to be properly triggered needs an action: to trigger a specific function. So action needs to be identical to the function that we whant to call.
				//portfolio_load_more - function name in ajax.php
				
			},

			error : function( response ){
				console.log(response);
			},
			success : function( response ){

				if(response == 0){//means that we do not have any posts to load
					$('.portfolio-posts-container').append( '<div class="text-center"><h3>You have reached the end of the line!</h3><p>No more posts to load.</p></div>' );
					
					that.slideUp(320);

				} else {

					setTimeout(function(){
						
						//if statement for previous ajax button
						if(prev == 1){
							$('.portfolio-posts-container').prepend( response );//.prepend - it is goin to dynamically apply the information inside index.php portfolio-posts-container, but at the beginning before other elements in the class, not at the bottom.
							newPage = page-1;
						}else{
							$('.portfolio-posts-container').append( response );
						}

						if( newPage == 1 ){

							that.slideUp(320);//hides the previous ajax button
						
						}else{

							//update the page count. To update the page count need a new Variable - var newPage
							that.data('page', newPage); //$(this) is changed with variable that.
							//newPage -  data page will be updated dynamically by increment +1.

							//removes .loading class
							that.removeClass('loading').find('.text').slideDown(320);
							that.find('.portfolio-icon').removeClass('spin');
							
						}
						
						revealPosts();

					}, 1000);//javascript function to set a delay. Second parameter - waiting time in ms to delay of triggering this function

				}


			}

		});

	});

	/*SCROLL FUNCTIONS*/
	$(window).scroll( function(){

		var scroll = $(window).scrollTop();
		//console.log(scroll);
		/*var last_scroll = 0; in variable declarations section*/
		if( Math.abs(scroll - last_scroll) > $(window).height()*0.1 ){//abs - absolute. Math.abs - creates mathematical operation to round up a variable inside the (). There would be an integer number with no commas and no dots.
			last_scroll = scroll;

			$('.page-limit').each(function ( index ){//looping through all the .page-limits containers on scroll
				if( isVisible( $(this) ) ){//$(this) - refers to the current '.page-limit' container that is looping inside the .each
					//console.log('visible'); //function isVisible( element ) - in helper function section.

					history.replaceState(null, null, $(this).attr("data-page") );/*dynamically replace the url without updating the page. history.replaceState() - built in jquery.
					First parameter - array with custom variables, Second parameter - the title of the page as an example "page-2". (In this case need to keep everything dynamic.), Third parameter - url. To access the url in this case - $(this).attr("data-page")*/
					return(false);//false - to interupt the execution of a (replaceState) script if it happens the first time
				}
			});

		}


	});

	/*Helper functions*/
	function revealPosts(){// function for activating a carousel

		$('[data-toggle="tooltip"]').tooltip();
		$('[data-toggle="popover"]').popover();

		var posts = $('article:not(.reveal)');
		var i = 0;
		
		setInterval(function(){
			
			if( i >= posts.length ) return false;//could write inline without {} when there is one simple declaration. Could write in PHP and  JAVASCRIPT.
			
			var el = posts[i];
			$(el).addClass('reveal').find('.portfolio-carousel-thumb').carousel();//find() - to fix image gallery

			i++

		}, 200);
	}//revealPosts function print placed at the top of the portfolio.js file and on the ajax end



	function isVisible( element ){
		
		var scroll_pos = $(window).scrollTop();
		var window_height = $(window).height();
		var el_top = $(element).offset().top;
		var el_height = $(element).height();
		var el_bottom = el_top + el_height;
		return ( ( el_bottom - el_height*0.25 > scroll_pos ) && ( el_top < (scroll_pos+0.5+window_height) ) );

	}


	/*Sidebar functions*/
	/*
	$(document).on('click', '.js-closeSidebar', function(){
		$('.portfolio-sidebar').addClass('sidebar-closed');
	});

	$(document).on('click', '.js-openSidebar', function(){
		$('.portfolio-sidebar').removeClass('sidebar-closed');
	});
	*/
	//could be changed with one class
	$(document).on('click', '.js-toggleSidebar', function(){
		$('.portfolio-sidebar').toggleClass('sidebar-closed');
		$('body').toggleClass('no-scroll'); //not scrolling when sidebar is open because applied in main.scss body{&.no-scroll{overflow-y: hidden;}}  
		$('.sidebar-overlay').fadeToggle(320);
	});//style - sidebar.scss , html - header.php



	/*Contact form submission*/ //contact-form.php
	$('#portfolioContactForm').on('submit', function(e){//e - means element
		e.preventDefault();//avoid the form when submitting to href to whatever location that is not whanted

		//console.log('Form submitted');//test to check if it works
		
		$('.has-error').removeClass('has-error');//remove has-error class when input is filled and submitted
		$('.js-form-submission').removeClass('js-form-submission');

		var form = $(this), //$(this) - stands for the parent element in jQuery function
			name = form.find('#name').val(), //name - the id in the contact-form.php
			email = form.find('#email').val(),
			message = form.find('#message').val(),
			ajaxurl = form.data('url'); //data url must be defined in contact-form.php
			
			if( name === ''){
				//console.log('Required inputs are empty');
				$('#name').parent('.form-group').addClass('has-error');//#name - id in contact-form.php
				
				return;/*return stops the execution of the script at this point. 
				It is not going to go on the second line and not going to continue if this if statement is true.*/
			}

			if( email === ''){
				$('#email').parent('.form-group').addClass('has-error');//#name - id in contact-form.php
				
				return;
			}

			if( message === ''){
				$('#message').parent('.form-group').addClass('has-error');//#name - id in contact-form.php
				
				return;
			}

			form.find('input, button, textarea').attr('disabled', 'disabled');//disables input, button, textarea. form - var form = $(this).
			$('.js-form-submission').addClass('js-show-feedback');//class from contact-form.php appears after submit button is pushed

			

		//console.log(form);
		//console.log(name);

		$.ajax({
			
			url : ajaxurl,
			type : 'post',// post - the same type that it is seen in a <form> and the post method in ajax is a default type.
			//$_POST (post method) - is a method that passes all the variables hidden inside the reload of the page. These methods are not getting printed anywhere.
			//$_GET (get method) - print the variables inside the url so you will see the variables inside the url. GET method is not safe
			data : { // data contains all the custom data like the array and we can write in the curly brackets and send to the ajax function
				
				name : name,
				email : email,
				message : message,
				action: 'portfolio_save_user_contact_form' //function portfolio_save_contact in ajax.php 
				
			},
			error : function( response ){
				$('.js-form-submission').removeClass('js-form-feedback');
				$('.js-form-error').addClass('js-show-feedback');
				form.find('input, button, textarea').removeAttr('disabled');
			},
			success : function( response ){
				if( response == 0 ){

					setTimeout(function(){
						//console.log('Unable to save your message, Please try again later');
						$('.js-form-submission').removeClass('js-form-feedback');
						$('.js-form-error').addClass('js-show-feedback');
						form.find('input, button, textarea').removeAttr('disabled');
					}, 1500);
				} else {

					setTimeout(function(){
						//console.log('Message saved!');
						$('.js-form-submission').removeClass('js-form-feedback');
						$('.js-form-success').addClass('js-show-feedback');
						form.find('input, button, textarea').removeAttr('disabled').val('');
					}, 1500);
				}
			}

		
		});

	});


});



