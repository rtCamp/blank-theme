/* global process __dirname */
const DEV = 'production' !== process.env.NODE_ENV;

/**
 * Plugins
 */
const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const OptimizeCssAssetsPlugin = require( 'optimize-css-assets-webpack-plugin' );
const cssnano = require( 'cssnano' );
const CleanWebpackPlugin = require( 'clean-webpack-plugin' );
const UglifyJsPlugin = require( 'uglifyjs-webpack-plugin' );
const StyleLintPlugin = require( 'stylelint-webpack-plugin' );
const FriendlyErrorsPlugin = require( 'friendly-errors-webpack-plugin' );
const WebpackAssetsManifest = require( 'webpack-assets-manifest' );

// JS Directory path.
const JSDir = path.resolve( __dirname, 'js' );

const entry = {
	main: JSDir + '/main.js',
	home: JSDir + '/home.js',
	single: JSDir + '/single.js',
	'admin/customizer': JSDir + '/admin/customizer.js'
};

const output = {
	path: __dirname + '/build',
	filename: DEV ? 'js/[name].js' : 'js/[name].[contenthash].js'
};

/**
 * Note: argv.mode will return 'development' or 'production'.
 */
const plugins = ( argv ) => [
	new CleanWebpackPlugin( [ 'build' ] ),

	new MiniCssExtractPlugin( {
		filename: DEV ? 'css/[name].css' : 'css/[name].[contenthash].css'
	} ),

	new WebpackAssetsManifest(),

	new StyleLintPlugin( {
		'extends': 'stylelint-config-wordpress/scss'
	} ),

	new FriendlyErrorsPlugin( {
		clearConsole: false
	} )
];

const rules = [
	{
		'enforce': 'pre',
		'test': /\.(js|jsx)$/,
		'exclude': /node_modules/,
		'use': 'eslint-loader'
	},
	{
		'test': /\.js$/,
		include: [
			path.resolve( __dirname, 'js' )
		],
		'exclude': /node_modules/,
		'use': {
			'loader': 'babel-loader'
		}
	},
	{
		'test': /\.scss$/,
		'use': [
			MiniCssExtractPlugin.loader,
			'css-loader',
			'postcss-loader',
			'sass-loader'
		]
	}
];

const optimization = [
	new OptimizeCssAssetsPlugin( {
		cssProcessor: cssnano
	} ),

	new UglifyJsPlugin( {
		cache: false,
		parallel: true,
		sourceMap: false
	} )
];

module.exports = ( env, argv ) => ( {
	entry: entry,
	output: output,
	plugins: plugins( argv ),

	module: {
		'rules': rules
	},

	optimization: {
		minimizer: optimization
	},

	externals: {
		jquery: 'jQuery'
	}
} );
