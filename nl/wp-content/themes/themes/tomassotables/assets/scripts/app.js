import 'assets/styles/app.scss';
import 'bootstrap';

const loadedComponents = [];

document.addEventListener( 'DOMContentLoaded', async () => {
	/**
	 * Bootstrap the components
	 */
	for ( const dataComponent of document.querySelectorAll( '[data-component]' ) ) {
		let componentName = dataComponent.dataset.component;

		if ( loadedComponents.indexOf( componentName ) === - 1 ) {
			loadedComponents.push( componentName );

			try {
				let component = await import(
					/* WebpackMode: "lazy" */
					/* webpackPrefetch: true */
					/* webpackPreload: true */
					`components/${componentName}/${componentName}.js`
					);

				component.default();
			} catch ( error ) {
				console.error( 'Loading error: ', error );
			}
		}
	}
} );
