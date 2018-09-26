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

const outputFile = '[name].[ext]';
const outputImages = `img/${outputFile}`;
const outputFonts = `fonts/${outputFile}`;

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
		enforce: 'pre',
		test: /\.(js|jsx)$/,
		exclude: /node_modules/,
		use: 'eslint-loader'
	},
	{
		test: /\.js$/,
		include: [
			path.resolve( __dirname, 'js' )
		],
		exclude: /node_modules/,
		use: 'babel-loader'
	},
	{
		test: /\.scss$/,
		exclude: /node_modules/,
		use: [
			MiniCssExtractPlugin.loader,
			'css-loader',
			'postcss-loader',
			'sass-loader'
		]
	},
	{
		test: /\.(png|jpg|jpeg|gif|ico)$/,
		exclude: [ /fonts/, /node_modules/ ],
		use: `file-loader?name=${outputImages}`
	},
	{
		test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
		exclude: [ /img/, /node_modules/ ],
		use: `file-loader?name=${outputFonts}`
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
	devtool: 'source-map',

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
