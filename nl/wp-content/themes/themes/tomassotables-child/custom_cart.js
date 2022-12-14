/* global wc_cart_params */

 function ismobile() {
  let check = false;
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
  return check;
}

jQuery( function( $ ) {

	jQuery(document).on('click','.woocommerce-pagination ul li',function() {
		setTimeout(function(){
		    jQuery('html, body').animate({
		        scrollTop: jQuery("body").offset().top
		    }, 700);
		}, 1500);
	});

	if(ismobile() === true && $(".category-section_custom").length > 0){
		jQuery(".category-section_custom .category-section__item:nth-child(3)").addClass('d-none d-sm-block');
	}

	// wc_cart_params is required to continue, ensure the object exists
	if ( typeof wc_cart_params === 'undefined' ) {
		return false;
	}

	// Utility functions for the file.

	/**
	 * Gets a url for a given AJAX endpoint.
	 *
	 * @param {String} endpoint The AJAX Endpoint
	 * @return {String} The URL to use for the request
	 */
	var get_url = function( endpoint ) {
		return wc_cart_params.wc_ajax_url.toString().replace(
			'%%endpoint%%',
			endpoint
		);
	};

	/**
	 * Check if a node is blocked for processing.
	 *
	 * @param {JQuery Object} $node
	 * @return {bool} True if the DOM Element is UI Blocked, false if not.
	 */
	var is_blocked = function( $node ) {
		return $node.is( '.processing' ) || $node.parents( '.processing' ).length;
	};

	/**
	 * Block a node visually for processing.
	 *
	 * @param {JQuery Object} $node
	 */
	var block = function( $node ) {
		if ( ! is_blocked( $node ) ) {
			$node.addClass( 'processing' ).block( {
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6
				}
			} );
		}
	};

	/**
	 * Unblock a node after processing is complete.
	 *
	 * @param {JQuery Object} $node
	 */
	var unblock = function( $node ) {
		$node.removeClass( 'processing' ).unblock();
	};

	/**
	 * Removes duplicate notices.
	 *
	 * @param {JQuery Object} notices
	 */
	var remove_duplicate_notices = function( notices ) {
		var seen = [];
		var new_notices = notices;

		notices.each( function( index ) {
			var text = $( this ).text();

			if ( 'undefined' === typeof seen[ text ] ) {
				seen[ text ] = true;
			} else {
				new_notices.splice( index, 1 );
			}
		} );

		return new_notices;
	};

	/**
	 * Update the .woocommerce div with a string of html.
	 *
	 * @param {String} html_str The HTML string with which to replace the div.
	 * @param {bool} preserve_notices Should notices be kept? False by default.
	 */
	var update_wc_div = function( html_str, preserve_notices ) {
		var $html       = $.parseHTML( html_str );
		var $new_form   = $( '.woocommerce-cart-form', $html );
		var $new_totals = $( '.cart_totals', $html );
		var $notices    = remove_duplicate_notices( $( '.woocommerce-error, .woocommerce-message, .woocommerce-info', $html ) );

		// No form, cannot do this.
		if ( $( '.woocommerce-cart-form' ).length === 0 ) {
			window.location.reload();
			return;
		}

		// Remove errors
		if ( ! preserve_notices ) {
			$( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();
		}

		if ( $new_form.length === 0 ) {
			// If the checkout is also displayed on this page, trigger reload instead.
			if ( $( '.woocommerce-checkout' ).length ) {
				window.location.reload();
				return;
			}

			// No items to display now! Replace all cart content.
			var $cart_html = $( '.cart-empty', $html ).closest( '.woocommerce' );
			$( '.woocommerce-cart-form__contents' ).closest( '.woocommerce' ).replaceWith( $cart_html );

			// Display errors
			if ( $notices.length > 0 ) {
				show_notice( $notices );
			}

			// Notify plugins that the cart was emptied.
			$( document.body ).trigger( 'wc_cart_emptied' );
		} else {
			// If the checkout is also displayed on this page, trigger update event.
			if ( $( '.woocommerce-checkout' ).length ) {
				$( document.body ).trigger( 'update_checkout' );
			}

			$( '.woocommerce-cart-form' ).replaceWith( $new_form );
			$( '.woocommerce-cart-form' ).find( ':input[name="update_cart"]' ).prop( 'disabled', true ).attr( 'aria-disabled', true );

			if ( $notices.length > 0 ) {
				show_notice( $notices );
			}

			update_cart_totals_div( $new_totals );
		}

		$( document.body ).trigger( 'updated_wc_div' );
	};

	/**
	 * Update the .cart_totals div with a string of html.
	 *
	 * @param {String} html_str The HTML string with which to replace the div.
	 */
	var update_cart_totals_div = function( html_str ) {
		$( '.cart_totals' ).replaceWith( html_str );
		$( document.body ).trigger( 'updated_cart_totals' );
	};

	/**
	 * Shows new notices on the page.
	 *
	 * @param {Object} The Notice HTML Element in string or object form.
	 */
	var show_notice = function( html_element, $target ) {
		if ( ! $target ) {
			$target = $( '.woocommerce-notices-wrapper:first' ) ||
				$( '.cart-empty' ).closest( '.woocommerce' ) ||
				$( '.woocommerce-cart-form' );
		}
		$target.prepend( html_element );
	};


	/**
	 * Object to handle AJAX calls for cart shipping changes.
	 */
	var cart_shipping = {

		/**
		 * Initialize event handlers and UI state.
		 */
		init: function( cart ) {
			this.cart                       = cart;
			this.toggle_shipping            = this.toggle_shipping.bind( this );
			this.shipping_method_selected   = this.shipping_method_selected.bind( this );
			this.shipping_calculator_submit = this.shipping_calculator_submit.bind( this );

			$( document ).on(
				'click',
				'.shipping-calculator-button',
				this.toggle_shipping
			);
			$( document ).on(
				'change',
				'select.shipping_method, :input[name^=shipping_method]',
				this.shipping_method_selected
			);
			$( document ).on(
				'submit',
				'form.woocommerce-shipping-calculator',
				this.shipping_calculator_submit
			);

			$( '.shipping-calculator-form' ).hide();
		},

		/**
		 * Toggle Shipping Calculator panel
		 */
		toggle_shipping: function() {
			$( '.shipping-calculator-form' ).slideToggle( 'slow' );
			$( 'select.country_to_state, input.country_to_state' ).trigger( 'change' );
			$( document.body ).trigger( 'country_to_state_changed' ); // Trigger select2 to load.
			return false;
		},

		/**
		 * Handles when a shipping method is selected.
		 */
		shipping_method_selected: function() {
			var shipping_methods = {};

			// eslint-disable-next-line max-len
			$( 'select.shipping_method, :input[name^=shipping_method][type=radio]:checked, :input[name^=shipping_method][type=hidden]' ).each( function() {
				shipping_methods[ $( this ).data( 'index' ) ] = $( this ).val();
			} );

			block( $( 'div.cart_totals' ) );

			var data = {
				security: wc_cart_params.update_shipping_method_nonce,
				shipping_method: shipping_methods
			};

			$.ajax( {
				type:     'post',
				url:      get_url( 'update_shipping_method' ),
				data:     data,
				dataType: 'html',
				success:  function( response ) {
					update_cart_totals_div( response );
				},
				complete: function() {
					unblock( $( 'div.cart_totals' ) );
					$( document.body ).trigger( 'updated_shipping_method' );
				}
			} );
		},

		/**
		 * Handles a shipping calculator form submit.
		 *
		 * @param {Object} evt The JQuery event.
		 */
		shipping_calculator_submit: function( evt ) {
			evt.preventDefault();

			var $form = $( evt.currentTarget );

			block( $( 'div.cart_totals' ) );
			block( $form );

			// Provide the submit button value because wc-form-handler expects it.
			$( '<input />' ).attr( 'type', 'hidden' )
							.attr( 'name', 'calc_shipping' )
							.attr( 'value', 'x' )
							.appendTo( $form );

			// Make call to actual form post URL.
			$.ajax( {
				type:     $form.attr( 'method' ),
				url:      $form.attr( 'action' ),
				data:     $form.serialize(),
				dataType: 'html',
				success:  function( response ) {
					update_wc_div( response );
				},
				complete: function() {
					unblock( $form );
					unblock( $( 'div.cart_totals' ) );
				}
			} );
		}
	};

	/**
	 * Object to handle cart UI.
	 */
	var cart = {
		/**
		 * Initialize cart UI events.
		 */
		init: function() {
			this.update_cart_totals    = this.update_cart_totals.bind( this );
			this.input_keypress        = this.input_keypress.bind( this );
			this.cart_submit           = this.cart_submit.bind( this );
			this.submit_click          = this.submit_click.bind( this );
			this.apply_coupon          = this.apply_coupon.bind( this );
			this.remove_coupon_clicked = this.remove_coupon_clicked.bind( this );
			this.quantity_update       = this.quantity_update.bind( this );
			this.item_remove_clicked   = this.item_remove_clicked.bind( this );
			this.item_restore_clicked  = this.item_restore_clicked.bind( this );
			this.update_cart           = this.update_cart.bind( this );

			$( document ).on(
				'wc_update_cart added_to_cart',
				function() { cart.update_cart.apply( cart, [].slice.call( arguments, 1 ) ); } );
			$( document ).on(
				'click',
				'.woocommerce-cart-form :input[type=submit]',
				this.submit_click );
			$( document ).on(
				'keypress',
				'.woocommerce-cart-form :input[type=number]',
				this.input_keypress );
			$( document ).on(
				'submit',
				'.woocommerce-cart-form',
				this.cart_submit );
			$( document ).on(
				'click',
				'a.woocommerce-remove-coupon',
				this.remove_coupon_clicked );
			$( document ).on(
				'click',
				'.woocommerce-cart-form .product-remove > a',
				this.item_remove_clicked );
			$( document ).on(
				'click',
				'.woocommerce-cart .restore-item',
				this.item_restore_clicked );
			$( document ).on(
				'change input',
				'.woocommerce-cart-form .cart_item :input',
				this.input_changed );

			$( '.woocommerce-cart-form :input[name="update_cart"]' ).prop( 'disabled', true ).attr( 'aria-disabled', true );
		},

		/**
		 * After an input is changed, enable the update cart button.
		 */
		input_changed: function(evt) {
			$( '.woocommerce-cart-form :input[name="update_cart"]' ).prop( 'disabled', false ).attr( 'aria-disabled', false );
			//$( '.woocommerce-cart-form input.js-update-cart').trigger('click');
			if(jQuery(evt.currentTarget).hasClass('qty')){
				cart.quantity_update($( '.woocommerce-cart-form'));
			}
			
		},

		/**
		 * Update entire cart via ajax.
		 */
		update_cart: function( preserve_notices ) {
			var $form = $( '.woocommerce-cart-form' );

			block( $form );
			block( $( 'div.cart_totals' ) );

			// Make call to actual form post URL.
			$.ajax( {
				type:     $form.attr( 'method' ),
				url:      $form.attr( 'action' ),
				data:     $form.serialize(),
				dataType: 'html',
				success:  function( response ) {
					update_wc_div( response, preserve_notices );
				},
				complete: function() {
					unblock( $form );
					unblock( $( 'div.cart_totals' ) );
					$.scroll_to_notices( $( '[role="alert"]' ) );
				}
			} );
		},

		/**
		 * Update the cart after something has changed.
		 */
		update_cart_totals: function() {
			block( $( 'div.cart_totals' ) );

			$.ajax( {
				url:      get_url( 'get_cart_totals' ),
				dataType: 'html',
				success:  function( response ) {
					update_cart_totals_div( response );
				},
				complete: function() {
					unblock( $( 'div.cart_totals' ) );
				}
			} );
		},

		/**
		 * Handle the <ENTER> key for quantity fields.
		 *
		 * @param {Object} evt The JQuery event
		 *
		 * For IE, if you hit enter on a quantity field, it makes the
		 * document.activeElement the first submit button it finds.
		 * For us, that is the Apply Coupon button. This is required
		 * to catch the event before that happens.
		 */
		input_keypress: function( evt ) {

			// Catch the enter key and don't let it submit the form.
			if ( 13 === evt.keyCode ) {
				var $form = $( evt.currentTarget ).parents( 'form' );

				try {
					// If there are no validation errors, handle the submit.
					if ( $form[0].checkValidity() ) {
						evt.preventDefault();
						this.cart_submit( evt );
					}
				} catch( err ) {
					evt.preventDefault();
					this.cart_submit( evt );
				}
			}
		},

		/**
		 * Handle cart form submit and route to correct logic.
		 *
		 * @param {Object} evt The JQuery event
		 */
		cart_submit: function( evt ) {
			var $submit  = $( document.activeElement ),
				$clicked = $( ':input[type=submit][clicked=true]' ),
				$form    = $( evt.currentTarget );

			// For submit events, currentTarget is form.
			// For keypress events, currentTarget is input.
			if ( ! $form.is( 'form' ) ) {
				$form = $( evt.currentTarget ).parents( 'form' );
			}

			if ( 0 === $form.find( '.woocommerce-cart-form__contents' ).length ) {
				return;
			}

			// if ( is_blocked( $form ) ) {
			// 	return false;
			// }

			if ( $clicked.is( ':input[name="update_cart"]' ) || $submit.is( 'input.qty' ) ) {
				evt.preventDefault();
				this.quantity_update( $form );

			} else if ( $clicked.is( ':input[name="apply_coupon"]' ) || $submit.is( '#coupon_code' ) ) {
				evt.preventDefault();
				this.apply_coupon( $form );
			}
		},

		/**
		 * Special handling to identify which submit button was clicked.
		 *
		 * @param {Object} evt The JQuery event
		 */
		submit_click: function( evt ) {
			$( ':input[type=submit]', $( evt.target ).parents( 'form' ) ).removeAttr( 'clicked' );
			$( evt.target ).attr( 'clicked', 'true' );
		},

		/**
		 * Apply Coupon code
		 *
		 * @param {JQuery Object} $form The cart form.
		 */
		apply_coupon: function( $form ) {
			block( $form );

			var cart = this;
			var $text_field = $( '#coupon_code' );
			var coupon_code = $text_field.val();

			var data = {
				security: wc_cart_params.apply_coupon_nonce,
				coupon_code: coupon_code
			};

			$.ajax( {
				type:     'POST',
				url:      get_url( 'apply_coupon' ),
				data:     data,
				dataType: 'html',
				success: function( response ) {
					$( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();
					show_notice( response );
					$( document.body ).trigger( 'applied_coupon', [ coupon_code ] );
				},
				complete: function() {
					unblock( $form );
					$text_field.val( '' );
					cart.update_cart( true );
				}
			} );
		},

		/**
		 * Handle when a remove coupon link is clicked.
		 *
		 * @param {Object} evt The JQuery event
		 */
		remove_coupon_clicked: function( evt ) {
			evt.preventDefault();

			var cart     = this;
			var $wrapper = $( evt.currentTarget ).closest( '.cart_totals' );
			var coupon   = $( evt.currentTarget ).attr( 'data-coupon' );

			block( $wrapper );

			var data = {
				security: wc_cart_params.remove_coupon_nonce,
				coupon: coupon
			};

			$.ajax( {
				type:    'POST',
				url:      get_url( 'remove_coupon' ),
				data:     data,
				dataType: 'html',
				success: function( response ) {
					$( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();
					show_notice( response );
					$( document.body ).trigger( 'removed_coupon', [ coupon ] );
					unblock( $wrapper );
				},
				complete: function() {
					cart.update_cart( true );
				}
			} );
		},

		/**
		 * Handle a cart Quantity Update
		 *
		 * @param {JQuery Object} $form The cart form.
		 */
		quantity_update: function( $form ) {
			block( $form );
			block( $( 'div.cart_totals' ) );

			// Provide the submit button value because wc-form-handler expects it.
			$( '<input />' ).attr( 'type', 'hidden' )
							.attr( 'name', 'update_cart' )
							.attr( 'value', 'Update Cart' )
							.appendTo( $form );

			// Make call to actual form post URL.
			$.ajax( {
				type:     $form.attr( 'method' ),
				url:      $form.attr( 'action' ),
				data:     $form.serialize(),
				dataType: 'html',
				success:  function( response ) {
					update_wc_div( response );
				},
				complete: function() {
					unblock( $form );
					unblock( $( 'div.cart_totals' ) );
					$.scroll_to_notices( $( '[role="alert"]' ) );
				}
			} );
		},

		/**
		 * Handle when a remove item link is clicked.
		 *
		 * @param {Object} evt The JQuery event
		 */
		item_remove_clicked: function( evt ) {
			evt.preventDefault();

			var $a = $( evt.currentTarget );
			var $form = $a.parents( 'form' );

			block( $form );
			block( $( 'div.cart_totals' ) );

			$.ajax( {
				type:     'GET',
				url:      $a.attr( 'href' ),
				dataType: 'html',
				success:  function( response ) {
					update_wc_div( response );
				},
				complete: function() {
					unblock( $form );
					unblock( $( 'div.cart_totals' ) );
					$.scroll_to_notices( $( '[role="alert"]' ) );
				}
			} );
		},

		/**
		 * Handle when a restore item link is clicked.
		 *
		 * @param {Object} evt The JQuery event
		 */
		item_restore_clicked: function( evt ) {
			evt.preventDefault();

			var $a = $( evt.currentTarget );
			var $form = $( 'form.woocommerce-cart-form' );

			block( $form );
			block( $( 'div.cart_totals' ) );

			$.ajax( {
				type:     'GET',
				url:      $a.attr( 'href' ),
				dataType: 'html',
				success:  function( response ) {
					update_wc_div( response );
				},
				complete: function() {
					unblock( $form );
					unblock( $( 'div.cart_totals' ) );
				}
			} );
		}
	};

	cart_shipping.init( cart );
	cart.init();
} );