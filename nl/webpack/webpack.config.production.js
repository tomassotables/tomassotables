const Path = require( 'path' );
const { DefinePlugin } = require( 'webpack' );
const merge = require( 'webpack-merge' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const ImageminPlugin = require( 'imagemin-webpack-plugin' ).default;
const ImageminMozjpeg = require( 'imagemin-mozjpeg' );
const ImageminWebpWebpackPlugin = require( 'imagemin-webp-webpack-plugin' );
const autoprefixer = require( 'autoprefixer' );
const EsLintPlugin = require( 'eslint-webpack-plugin' );
const StylelintPlugin = require( 'stylelint-webpack-plugin' );

const common = require( './webpack.common.js' );
const packageJson = require( '../package.json' );
const themePath = 'wp-content/themes/' + packageJson.name;
const baseDirectory = packageJson.config.baseDirectory;

module.exports = merge( common, {
	mode: 'production',
	devtool: 'source-map',
	bail: true,
	output: {
		filename: 'scripts/[name].[chunkhash:5].js',
		chunkFilename: 'scripts/[name].[chunkhash:5].chunk.js',
	},
	plugins: [
		new DefinePlugin( {
			'process.env.NODE_ENV': JSON.stringify( 'production' ),
		} ),
		new EsLintPlugin( {
			context: Path.resolve( __dirname, '../' + themePath ),
			fix: true,
		} ),
		new StylelintPlugin( {
			context: Path.resolve( __dirname, '../' + themePath ),
			syntax: 'scss',
			fix: true,
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
		new ImageminPlugin( {
			test: /\.(jpe?g|png|gif|svg)$/i,
			include: Path.resolve( __dirname, '../' + themePath ),
			gifsicle: {
				colors: 64,
			},
			pngquant: {
				quality: '60-90',
			},
			svgo: {
				plugins: [
					{ removeUnknownsAndDefaults: true },
					{ cleanupIDs: true },
					{ removeViewBox: true },
				],
			},
			plugins: [
				ImageminMozjpeg( { quality: 60 } ),
			],
		} ),
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
	],
	module: {
		rules: [
			{
				test: /\.s?css/i,
				include: Path.resolve( __dirname, '../' + themePath ),
				use: [
					{ loader: MiniCssExtractPlugin.loader },
					{ loader: 'css-loader' },
					{
						loader: 'postcss-loader',
						options: {
							plugins: [
								autoprefixer(),
							],
						},
					},
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
