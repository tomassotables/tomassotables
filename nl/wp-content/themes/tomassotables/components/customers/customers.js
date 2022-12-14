import './customers.scss';
import 'slick-carousel';

export default () => {
	$( '.js-customers-slider' ).slick( {
		rows: 0,
        autoplay: true,
		arrows: false,
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		variableWidth: true,
	} );
};