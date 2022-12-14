import './customers.scss';
import 'slick-carousel';

export default () => {
	$( '.js-customers-slider' ).slick( {
		rows: 0,
		arrows: false,
		infinite: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		variableWidth: true,
	} );
};
