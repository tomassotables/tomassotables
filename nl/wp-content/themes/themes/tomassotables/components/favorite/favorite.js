import './favorite.scss';
import 'slick-carousel';

export default () => {
	$( '.js-favorite-slider' ).slick( {
		rows: 0,
		dots: false,
		arrows: true,
		infinite: false,
		slidesToShow: 4,
		slidesToScroll: 1,
		prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><i class="icon-angle-right"></i></button>',
		nextArrow: '<button class="slick-next" aria-label="Next" type="button"><i class="icon-angle-right"></i></button>',
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
				},
			},
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2,
				},
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				},
			},
			// You can unslick at a given breakpoint now by adding:
			// Settings: "unslick"
			// Instead of a settings object
		],
	} );
};
