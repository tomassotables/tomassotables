import './quote.scss';
import 'slick-carousel';

export default () => {
	$( '.js-quote-slider' ).slick( {
		rows: 0,
		dots: false,
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><i class="icon-angle-right"></i></button>',
		nextArrow: '<button class="slick-next" aria-label="Next" type="button"><i class="icon-angle-right"></i></button>',
	} );
};
