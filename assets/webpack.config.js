/**
 * Webpack configuration.
 */

const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const OptimizeCssAssetsPlugin = require( 'optimize-css-assets-webpack-plugin' );
const cssnano = require( 'cssnano' );
const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' );
const UglifyJsPlugin = require( 'uglifyjs-webpack-plugin' );
const StyleLintPlugin = require( 'stylelint-webpack-plugin' );

// JS Directory path.
const JS_DIR = path.resolve( __dirname, 'src/js' );
const IMG_DIR = path.resolve( __dirname, 'src/img' );
const FONTS_DIR = path.resolve( __dirname, 'src/fonts' );
const BUILD_DIR = path.resolve( __dirname, 'build' );

module.exports = {

	entry: {
		main: JS_DIR + '/main.js',
		home: JS_DIR + '/home.js',
		single: JS_DIR + '/single.js',
		'admin/customizer': JS_DIR + '/admin/customizer.js'
	},

	output: {
		path: BUILD_DIR,
		filename: 'js/[name].js'
	},

	devtool: false,

	module: {
		rules: [
			{
				enforce: 'pre',
				test: /\.(js|jsx)$/,
				exclude: /node_modules/,
				use: 'eslint-loader'
			},
			{
				test: /\.js$/,
				include: [ JS_DIR ],
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
				test: /\.(png|jpg|svg|jpeg|gif|ico)$/,
				exclude: [ FONTS_DIR, /node_modules/ ],
				use: {
					loader: 'file-loader',
					options: {
						name: 'img/[name].[ext]',
						publicPath: 'production' === process.env.NODE_ENV ? '../' : '../../'
					}
				}
			},
			{
				test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
				exclude: [ IMG_DIR, /node_modules/ ],
				use: {
					loader: 'file-loader',
					options: {
						name: 'fonts/[name].[ext]',
						publicPath: 'production' === process.env.NODE_ENV ? '../' : '../../'
					}
				}
			}
		]
	},

	optimization: {
		minimizer: [
			new OptimizeCssAssetsPlugin( {
				cssProcessor: cssnano
			} ),

			new UglifyJsPlugin( {
				cache: false,
				parallel: true,
				sourceMap: false
			} )
		]
	},

	plugins: [
		new CleanWebpackPlugin(),

		new MiniCssExtractPlugin( {
			filename: 'css/[name].css'
		} ),

		new StyleLintPlugin( {
			'extends': 'stylelint-config-wordpress/scss'
		} )
	],

	externals: {
		jquery: 'jQuery'
	}
};
