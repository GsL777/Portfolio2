jQuery(document).ready(function($){

	var mediaUploader;

	$( '#upload-button' ).on('click', function(e){//upload-button id is located in portfolio_sidebar_profile function in function-admin.php file
		e.preventDefault();
		if(mediaUploader){
			mediaUploader.open();
			return;
		}

		//define mediaUploader variable
		mediaUploader = wp.media.frames.file_frame = wp.media({
			//wp.media.frames.file_frame https://codex.wordpress.org/
			//custom options

			title: 'Choose a Profile Picture',
			button: {
				text: 'Choose Picture'
			},//title, button... attributes
			multiple: false
		});

		//when we choose a picture that the picture will be pasted in the value on inspect
		mediaUploader.on('select', function(){ //'select' - a binding action to the media uploader if the user select his picture
			attachment = mediaUploader.state().get('selection').first().toJSON(); //codex.wordpress.org
			$('#profile-picture').val(attachment.url);
			$('#profile-picture-preview').css('background-image', 'url('+attachment.url+')');//automatically refreshes the picture in the WordPress dashboard
		});

		mediaUploader.open();//this prevents to double click the button

	});//$ sign to invoque jQuery


	//remove button to remove a picture in function-admin.php file, portfolio_sidebar_profile function.
	$('#remove-picture').on('click', function(e){
		e.preventDefault();

		//confirmation from a user and if the answer is true that the process will be activated
		var answer = confirm( "Are you sure you want to delete your Profile Picture?" );
		if(answer  == true ){
			$('#profile-picture').val('');//val(); - value
			$('.portfolio-general-form').submit();//submit() - submit and refreshes
		}	
		return;//jQuery can not submit if there is a submit button 'save changes' in wordpress, because jQuery interferes with WP id="submit". So we need to add specific attributes in templates -> portfolio-admin.php

		//to create remove buttons always use var answer = confirm(" "); 


	});

});
