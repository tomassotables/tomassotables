import './category-section.scss';
import 'slick-carousel';

export default () => {
	$( '.js-categorie-slider' ).slick( {
		rows: 0,
		dots: true,
		arrows: false,
		infinite: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		responsive: [ {
			breakpoint: 768,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 2,
			},
		} ],
	} );
};
