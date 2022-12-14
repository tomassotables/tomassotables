const Path = require( 'path' );
const { ProvidePlugin } = require( 'webpack' );
const ManifestPlugin = require( 'webpack-manifest-plugin' );
const FriendlyErrorsWebpackPlugin = require( 'friendly-errors-webpack-plugin' );

const packageJson = require( '../package.json' );
const themePath = 'wp-content/themes/' + packageJson.name;
const baseDirectory = packageJson.config.baseDirectory;

module.exports = {
	entry: {
		app: Path.resolve( __dirname, '../' + themePath + '/assets/scripts/app.js' ),
		editor: Path.resolve( __dirname, '../' + themePath + '/assets/scripts/editor.js' ),
		visualComposer: Path.resolve( __dirname, '../' + themePath + '/assets/scripts/visualComposer.js' ),
		wpLink: Path.resolve( __dirname, '../' + themePath + '/assets/scripts/wpLink.js' ),
	},
	output: {
		publicPath: baseDirectory + '/' + themePath + '/dist/',
		path: Path.resolve( __dirname, '../' + themePath + '/dist' ),
		filename: 'scripts/[name].js',
		chunkFilename: 'scripts/[name].chunk.js',
	},
	stats: false,
	externals: {
		jquery: 'jQuery',
	},
	plugins: [
		new ManifestPlugin(),
		new ProvidePlugin( {
			$: 'jquery',
			jQuery: 'jquery',
		} ),
		new FriendlyErrorsWebpackPlugin(),
	],
	resolve: {
		alias: {
			'assets': Path.resolve( __dirname, '../' + themePath + '/assets/' ),
			'components': Path.resolve( __dirname, '../' + themePath + '/components/' ),
		},
	},
	module: {
		rules: [
			{
				test: /\.scss$/,
				include: Path.resolve( __dirname, '../' + themePath ),
				enforce: 'pre',
				use: [
					{ loader: 'import-glob-loader' },
				],
			},
			{
				test: /\.js$/,
				include: Path.resolve( __dirname, '../' + themePath ),
				use: [
					{ loader: 'cache-loader' },
					{ loader: 'babel-loader' },
				],
			},
		],
	},
};
