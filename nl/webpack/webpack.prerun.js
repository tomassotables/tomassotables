const rimraf = require( 'rimraf' );

const packageJson = require( '../package.json' );
const config = packageJson.config;
const themePath = 'wp-content/themes/' + config.name;

rimraf( themePath + '/dist', {
	disableGlob: true,
}, () => console.log( 'webpack.prerun: Dist folder cleaned' ) );
