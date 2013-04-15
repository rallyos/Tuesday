
( function( $ ) {

	// Update site title
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title' ).html( newval );
		} );
	} );
	
	//Update site description
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );

	//Update copyright text
	wp.customize( 'blogauthor', function( value ) {
		value.bind( function( newval ) {
			$( '#theme-author' ).html( newval );
		} );
	} );

	//Update header image
	wp.customize( 'header_image', function( value ) {
		value.bind( function( newval ) {
			$('.image-header').attr('src', newval );
		} );
	} );

	//Update background image
	wp.customize( 'background_image', function( value ) {
		value.bind( function( newval ) {
			$('body').css('background-image', newval );
		} );
	} );

	//Update site background color
	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$('body').css('background-color', newval );
		} );
	} );

	//Update post content font weight
	wp.customize('font-weight', function( value ) {
		value.bind( function( newval ) {
			$('.post-content > p').css('font-weight', newval);
		} );
	} );

} )( jQuery );
