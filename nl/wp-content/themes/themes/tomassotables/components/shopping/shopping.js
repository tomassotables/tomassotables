import './shopping.scss';

export default () => {
	$( '.showlogin' ).click( function ( e ) {
		e.preventDefault();

		$( this ).parent().parent().slideUp();
	} );

	$( '.wc-cart-toggle' ).click( function ( e ) {
		e.preventDefault();
		$( this ).toggleClass( 'is-active' ).next().toggleClass( 'is-active' );
	} );

	let timeout;

	$( '.woocommerce' ).on( 'change', 'input.qty', function () {
		if ( timeout !== undefined ) {
			clearTimeout( timeout );
		}
		timeout = setTimeout( function () {
			$( '[name=\'update_cart\']' ).trigger( 'click' );
		}, 2000 );
	} );
};
