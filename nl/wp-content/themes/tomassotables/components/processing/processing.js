import './processing.scss';

export default () => {
	$( '.showlogin' ).click( function ( e ) {
		e.preventDefault();

		$( this ).parent().parent().slideUp();
	} );

	$( '.js-update-cart' ).click( function () {
		$( 'form.woocommerce-cart-form' ).submit();
	} );

	$( '.wc-cart-toggle' ).click( function ( e ) {
		e.preventDefault();
		$( this ).toggleClass( 'is-active' ).next().toggleClass( 'is-active' );
	} );
};
