import 'assets/styles/visualComposer.scss';

$( document ).ready( () => {
	if ( typeof ( vc ) !== 'undefined' && typeof ( vc.app ) !== 'undefined' ) {
		$( '.vc_navbar .vc_post-settings' ).parents( 'li' ).hide();

		$( '#post-body-content div.composer-switch' ).hide();

		let activePostType = $( 'input#post_type' ).val();
		let activePageTemplate = $( 'select#page_template' ).val();

		if ( $.inArray( activePostType, vc_post_types ) !== -1 ) {
			if ( activePostType === 'page' ) {
				if ( $.inArray( activePageTemplate, vc_page_templates ) !== -1 ) {
					vc.app.show();
				} else {
					vc.app.close();
				}

				$( 'select#page_template' ).on( 'change', function () {
					let selectedPageTemplate = $( this ).val();

					if ( $.inArray( selectedPageTemplate, vc_page_templates ) !== -1 ) {
						vc.app.show();
					} else {
						vc.app.close();
					}
				} );
			} else {
				vc.app.show();
			}
		}
	}
} );
