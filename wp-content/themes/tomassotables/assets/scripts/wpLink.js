/**
 * WP Link additions
 *
 * This script extends the default edit link box of WordPress. It generates a "Make this link a button"
 * checkbox which will render the <a class="button"></a> in the frontend.
 */

$( document ).ready( () => {
	let wpLinkGetAttrs = wpLink.getAttrs;
	let wpLinkRefresh = wpLink.refresh;

	$( '#wp-link-wrap .wp-link-text-field' ).show();
	$( '#wp-link .query-results' ).css( 'top', '210px' );

	$( `${'<div class="link-button" style="margin: 0 0 -15px 3px;">' +
		'<label><span> </span><input type="checkbox" id="wp-link-button" /> '}${objectL10n.make_button}</label>` +
		'</div>' ).insertAfter( '#wp-link .link-target' );

	wpLink.getAttrs = function () {
		let attributes = wpLinkGetAttrs.apply( wpLinkGetAttrs );

		attributes.class = $( '#wp-link-button' ).is( ':checked' ) ? 'button' : '';

		return attributes;
	};

	wpLink.refresh = function () {
		if ( wpLink.isMCE() ) {
			wpLinkRefresh.apply( wpLinkRefresh );

			let editor = window.tinymce.get( window.wpActiveEditor );
			let linkNode = editor.dom.getParent( editor.selection.getNode(), 'a[href]' );

			$( '#wp-link-button' ).prop( 'checked', 'button' === editor.dom.getAttrib( linkNode, 'class' ) );
		}
	};
} );
