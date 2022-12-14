import './inspiration.scss';
import 'magnific-popup';

export default () => {
	$( '.js-popup-video' ).magnificPopup( {
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false,
	} );
};
