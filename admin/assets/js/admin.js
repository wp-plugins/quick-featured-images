/*(function ( $ ) {
	"use strict";

	$(function () {

		// Place your administration-specific JavaScript here

	});

}(jQuery));*/

jQuery(document).ready(function($){
 
    var custom_uploader;

	// single image selection
    $('#upload_image_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: $('#upload_image_button').val(),
            button: {
                text: $('#upload_image_button').val()
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#image_id').val(attachment.id);
            $('#selected_image').attr( 'src', attachment.url);
            $('#selected_image').attr( 'class', 'attachment-thumbnail');
            $('#selected_image').attr( 'style', 'width:250px');
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
	// multiple images selection
    $('#select_images_multiple').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: $('#select_images_multiple').val(),
            button: {
                text: $('#select_images_multiple').val()
            },
            multiple: true
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachments = custom_uploader.state().get('selection').toJSON();
			attachments_ids = [];
			for ( i = 0; i < attachments.length; i++ ) {
				attachments_ids[ i ] = attachments[ i ].id
			}
            $('#multiple_image_ids').val( attachments_ids.toString() );
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});
