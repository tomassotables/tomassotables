import './bio.scss';

export default () => {
	$( '#tabs-nav li:first-child' ).addClass( 'is-active' );
	$( '.tab-content' ).hide();
	$( '.tab-content:first' ).show();

	$( '#tabs-nav li' ).click( function () {
		$( '#tabs-nav li' ).removeClass( 'is-active' );
		$( this ).addClass( 'is-active' );
		$( '.tab-content' ).hide();

		let activeTab = $( this ).find( 'a' ).attr( 'href' );

		$( activeTab ).fadeIn();

		return false;
	} );
};
