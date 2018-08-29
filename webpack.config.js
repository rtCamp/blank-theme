/**
 * Plugins
 */
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const StyleLintPlugin = require( 'stylelint-webpack-plugin' );
const FriendlyErrorsPlugin = require( 'friendly-errors-webpack-plugin' );

const path = require( 'path' );
const webpack = require( 'webpack' );

const isProduction = 'production' === process.env.NODE_ENV;
const JSDir = path.resolve( __dirname, 'js' );

const extractSass = new MiniCssExtractPlugin( {
	filename: 'css/[name].css'
} );

/**
 * Webpack configuration.
 *
 * @type {Object}
 */
const config = {

	/**
	 * Plugins.
	 *
	 * @type {object}
	 */
	plugins: {

		/**
		 * Stylelint plugin.
		 */
		stylelint: new StyleLintPlugin( {
			'extends': 'stylelint-config-wordpress/scss',
			'rules': {
				'declaration-property-unit-whitelist': {
					'line-height': [ 'em', 'rem' ]
				},
				'rule-empty-line-before': null,
				'at-rule-empty-line-before': null,
				'no-missing-end-of-source-newline': null,
				'selector-list-comma-newline-after': null
			}
		} ),

		/**
		 * SASS plugin.
		 */
		scss: extractSass,

		/**
		 * Minify plugin.
		 */
		minify: new webpack.LoaderOptionsPlugin( { minimize: true } ),

		/**
		 * Friendly errors plugin.
		 */
		friendlyErrors: new FriendlyErrorsPlugin( {
			clearConsole: false
		} )
	},

	/**
	 * Rules.
	 *
	 * @type {object}
	 */
	rules: {

		/**
		 * Javascript loaders
		 */
		pre: {
			enforce: 'pre',
			test: /\.js$/,
			exclude: /(node_modules|nobundle|vendor)/,
			use: {
				loader: 'eslint-loader',
				options: {
					configFile: '.eslintrc.json'
				}
			}
		},

		/**
		 * Babel Loader.
		 */
		js: {
			test: /\.js$/,
			exclude: /(node_modules|vendor|bower_components)/,
			loader: 'babel-loader',
			query: {
				presets: [ '@babel/preset-env' ]
			}
		},

		/**
		 * Sass Loader.
		 */
		scss: {
			test: /\.scss$/,
			use: [
				isProduction ? MiniCssExtractPlugin.loader : 'style-loader',
				{
					loader: 'css-loader',
					options: {
						url: false,
						importLoaders: 1
					}
				},
				{
					loader: 'postcss-loader'
				},
				{
					loader: 'sass-loader',
					options: {
						includePaths: [
							JSDir,
							'./sass/'
						]
					}
				}
			],
		}
	}
};

/**
 * Webpack plugins.
 *
 * @type {array}
 */
const plugins = [
	config.plugins.scss,
	config.plugins.friendlyErrors
];

/**
 * Production settings.
 */
if ( isProduction ) {

	plugins.push(
		config.plugins.stylelint,
		config.plugins.minify,
	);
}

/**
 * Module exports.
 *
 * @type {object}
 */
module.exports = {

	mode: isProduction ? 'production' : 'development',

	entry: {
		main: JSDir + '/main.js',
		home: JSDir + '/home.js',
		single: JSDir + '/single.js',
		'admin/customizer': JSDir + '/admin/customizer.js'
	},

	output: {
		path: path.resolve( __dirname, 'build' ),
		filename: 'js/[name].js'
	},

	module: {
		rules: [
			config.rules.pre,
			config.rules.js,
			config.rules.scss
		]
	},

	optimization: {
		minimize: false
	},

	externals: {
		jquery: 'jQuery'
	},

	plugins: plugins,

	watch: ! isProduction,

	watchOptions: {
		ignored: /node_modules/
	}

};
