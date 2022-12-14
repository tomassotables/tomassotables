import './header.scss';
import 'slick-carousel';
import MmenuLight from 'mmenu-light';

export default async () => {
	const $searchBar = $( '.header__search' );
	let lastScrollTop = 0;
	const menuHolder = document.querySelector( '#nav' );

	if ( menuHolder ) {
		const menu = new MmenuLight(
			menuHolder,
			'(max-width: 740px)',
		);

		menu.navigation( {
			selected: 'is-active',
			title: 'Menu',
			theme: 'light',
		} );

		const drawer = menu.offcanvas( {
			position: 'left',
		} );

		document.querySelector( 'a[href="#nav"]' ).addEventListener( 'click', ( event ) => {
			event.preventDefault();
			drawer.open();
		} );
	}

	$( window ).scroll( function () {
		let st = $( this ).scrollTop();

		if ( st > lastScrollTop ) {
			$( '.header__finder' ).addClass( 'header__finder--down' );
			$( '.header__finder' ).removeClass( 'header__finder--up' );
		} else {
			$( '.header__finder' ).addClass( 'header__finder--up' );
			$( '.header__finder' ).removeClass( 'header__finder--down' );
		}
		lastScrollTop = st;
	} );

	$( document ).mouseup( ( e ) => {
		if ( !$searchBar.is( e.target ) && $searchBar.has( e.target ).length === 0 ) {
			$searchBar.removeClass( 'is-active' );
		}
	} );

	$( '.header__search-icon' ).on( 'click', ( e ) => {
		e.preventDefault();
		$searchBar.toggleClass( 'is-active' );
	} );

	$( '.js-add-card' ).click( function ( e ) {
		e.preventDefault();

		$( '.single_add_to_cart_button' ).trigger( 'click' );
	} );

	$( window ).scroll( function () {
		if ( $( window ).scrollTop() >= 45 ) {
			$( '.header__sticky' ).addClass( 'sticky' );
		} else {
			$( '.header__sticky' ).removeClass( 'sticky' );
		}
	} );

	$( '.js-scroll-down' ).on( 'click', function () {
		let target = $( this.hash );

		target = target.length ? target : $( `[name=${this.hash.substr( 1 )}]` );
		if ( target.length ) {
			$( 'html,body' ).animate( {
				scrollTop: target.offset().top - 140,
			}, 1000 );

			return false;
		}
	} );

	$( '.header__menu-list' ).slick( {
		rows: 0,
		slidesToShow: 6,
		slidesToScroll: 6,
		dots: false,
		variableWidth: true,
		infinite: false,
		swipeToSlide: true,
		prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><i class="icon-angle-right"></i></button>',
		nextArrow: '<button class="slick-next" aria-label="Next" type="button"><i class="icon-angle-right"></i></button>',
		mobileFirst: false,
		responsive: [ {
			breakpoint: 768,
			settings: 'unslick',
		} ],
	} );

	$( window ).on( 'resize', function () {
		$( '.header__menu-list' ).slick( 'resize' );
	} );

	$( '#billing_type_billing_type_private' ).click( function () {
		$( '#billing_company_field' ).removeClass( 'is-active' );
	} );

	$( '#billing_type_billing_type_business' ).click( function () {
		$( '#billing_company_field' ).addClass( 'is-active' );
	} );

	$( '.js-submit-order' ).click( function ( e ) {
		e.preventDefault();

		$( '#place_order' ).trigger( 'click' );
	} );
};
