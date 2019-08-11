( function( $ ) {
    'use strict';

    /**
	 * Functionality used for the WordPress Media Library window.
	 */
    var customMedia        = true,
        origSendAttachment = '';

	if ( 'undefined' !== typeof wp.media ) {
        origSendAttachment = wp.media.editor.send.attachment;

        $( '.monospace_slides_admin_metabox-media' ).on( 'click', function() {
            var button = $( this ),
                id     = button.attr( 'id' ).replace( '_button', '' );

            customMedia = true;

            wp.media.editor.send.attachment = function( props, attachment ) {
                if ( customMedia ) {
                    $( 'input#' + id ).val( attachment.url );
                } else {
                    return origSendAttachment.apply( this, [ props, attachment ] ); // eslint-disable-line
                };
            };

            wp.media.editor.open( button );

            return false;
        } ); // eslint-disable-line

        $( '.add_media' ).on( 'click', function() {
            customMedia = false;
        } ); // eslint-disable-line
    }
} ( jQuery ) );
