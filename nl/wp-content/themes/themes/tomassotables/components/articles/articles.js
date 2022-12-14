import './articles.scss';
import 'slick-carousel';

export default () => {
	let $carousel = $( '.js-articles-slider' );

	let settings = {
		rows: 0,
		dots: false,
		arrows: false,
		slide: '.articles__item',
		slidesToShow: 4,
		variableWidth: true,
		responsive: [ {
			breakpoint: 767,
			settings: 'unslick',
		} ],
	};

	function setSlideVisibility () {
		let visibleSlides = $carousel.find( '.articles__item[aria-hidden="false"]' );

		$( visibleSlides ).each( function () {
			$( this ).css( 'opacity', 1 );
		} );

		$( visibleSlides ).first().prev().css( 'opacity', 0 );
	}

	$carousel.slick( settings );
	$carousel.slick( 'slickGoTo', 1 );
	setSlideVisibility();

	$carousel.on( 'afterChange', function () {
		setSlideVisibility();
	} );

	$( window ).on( 'resize', function () {
		$( '.js-articles-slider' ).slick( 'resize' );
	} );
};
