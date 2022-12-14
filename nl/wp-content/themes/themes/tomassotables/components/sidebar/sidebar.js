import './sidebar.scss';
import 'magnific-popup';

export default () => {
	$( '.open-popup-link' ).magnificPopup( {
		type: 'inline',
		midClick: true,
		mainClass: 'mfp-fade',
		fixedContentPos: 'true',
	} );

	$( document ).on( 'click', '.popup-modal-dismiss', function ( e ) {
		e.preventDefault();
		$.magnificPopup.close();
	} );

	$( '.filter__widget-title' ).click( function () {
		$( this ).next().slideToggle();
		$( this ).parent().toggleClass( 'is-active' );
	} );
};
