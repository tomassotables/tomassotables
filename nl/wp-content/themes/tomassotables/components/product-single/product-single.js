import './product-single.scss';
import 'sticky-kit/dist/sticky-kit.min';

export default () => {
	$( '.js-selector' ).stick_in_parent( {
		offset_top: 150,
	} );

	function stickyRelocate () {
		let windowTop = $( window ).scrollTop();
		let divTop = $( '.sticky-anchor' ).offset().top - 300;

		if ( windowTop > divTop ) {
			$( '.sticky-topbar' ).addClass( 'sticky' );
		} else {
			$( '.sticky-topbar' ).removeClass( 'sticky' );
		}
	}

	$( function () {
		$( window ).scroll( stickyRelocate );
		stickyRelocate();
	} );

	$( '.xoo-cp-btn-vc.xcp-btn' ).html( 'Ik ga bestellen' );
};
