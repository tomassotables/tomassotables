const Path = require( 'path' );
const Webpack = require( 'webpack' );
const merge = require( 'webpack-merge' );
const BrowserSyncPlugin = require( 'browser-sync-webpack-plugin' );
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const ImageminWebpWebpackPlugin = require( 'imagemin-webp-webpack-plugin' );
const EsLintPlugin = require( 'eslint-webpack-plugin' );
const StylelintPlugin = require( 'stylelint-webpack-plugin' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );

const common = require( './webpack.common.js' );
const packageJson = require( '../package.json' );
const config = packageJson.config;
const themePath = 'wp-content/themes/' + packageJson.name;
const baseDirectory = packageJson.config.baseDirectory;

module.exports = merge( common, {
	mode: 'development',
	devtool: 'cheap-eval-source-map',
	devServer: {
		inline: true,
		hot: true,
	},
	plugins: [
		new Webpack.DefinePlugin( {
			'process.env.NODE_ENV': JSON.stringify( 'development' ),
		} ),
		new EsLintPlugin( {
			context: Path.resolve( __dirname, '../' + themePath ),
		} ),
		new StylelintPlugin( {
			context: Path.resolve( __dirname, '../' + themePath ),
			syntax: 'scss',
		} ),
		new MiniCssExtractPlugin( {
			filename: 'styles/[name].[chunkhash:5].css',
			chunkFilename: 'styles/[id].[chunkhash:5].css',
		} ),
		new CopyWebpackPlugin( [
			{
				from: Path.resolve( __dirname, '../' + themePath + '/assets/images' ),
				to: Path.resolve( __dirname, '../' + themePath + '/dist/images' ),
			},
			{
				from: Path.resolve( __dirname, '../' + themePath + '/assets/fonts' ),
				to: Path.resolve( __dirname, '../' + themePath + '/dist/fonts' ),
			},
		] ),
		new ImageminWebpWebpackPlugin( {
			config: [
				{
					test: /\.(jpe?g|png)/,
					include: Path.resolve( __dirname, '../' + themePath ),
					options: {
						quality: 75,
					},
				},
			],
		} ),
		new BrowserSyncPlugin( {
				proxy: config.developmentUrl,
				files: [
					themePath + '/dist/**',
					themePath + '/**/*.php',
					themePath + '/**/*.twig',
				],
				notify: {
					styles: {
						top: 'auto',
						bottom: 0,
						borderRadius: 0,
					},
				},
				logFileChanges: false,
			}, {
				reload: false,
			},
		),
	],
	module: {
		rules: [
			{
				test: /\.s?css$/i,
				include: Path.resolve( __dirname, '../' + themePath ),
				use: [
					{ loader: MiniCssExtractPlugin.loader },
					{ loader: 'css-loader?sourceMap=true' },
					{
						loader: 'sass-loader',
						options: {
							prependData: '$image-path: \'' + baseDirectory + '/' + themePath + '/dist/images/\';' +
							             '$fonts-path: \'' + baseDirectory + '/' + themePath + '/dist/fonts\';',
						},
					},
				],
			},
		],
	},
} );
