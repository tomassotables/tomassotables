import './interior.scss';
import 'slick-carousel';

export default () => {
	$( '.js-interior-slider' ).slick( {
		rows: 0,
		dots: false,
		infinite: true,
		arrows: false,
		slidesToShow: 3,
		responsive: [ {
			breakpoint: 575,
			settings: {
				infinite: false,
				slidesToShow: 2,
				variableWidth: true,
			},
		} ],
	} );
};
