const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const ESLintPlugin = require( 'eslint-webpack-plugin' );
const StyleLintPlugin = require( 'stylelint-webpack-plugin' );
const DependencyExtractionWebpackPlugin = require( '@wordpress/dependency-extraction-webpack-plugin' );

const isProductionMode = process.env.NODE_ENV === 'production';

module.exports = {
	mode: isProductionMode ? 'production' : 'development',

	entry: {
		main: path.resolve( __dirname, 'assets/src/js/main.js' ),
	},

	output: {
		filename: 'js/[name].js',
		path: path.resolve( __dirname, 'assets/build' ),
		clean: true,
	},

	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /(node_modules|bower_components)/,
				use: {
					loader: 'babel-loader',
				},
			},
			{
				test: /\.s[ac]ss$/i,
				use: [
					MiniCssExtractPlugin.loader,
					'css-loader',
					'postcss-loader',
					'sass-loader',
				],
			},
		],
	},

	plugins: [
		new DependencyExtractionWebpackPlugin(),
		new MiniCssExtractPlugin( {
			filename: 'css/[name].css',
		} ),
		new ESLintPlugin(),
		new StyleLintPlugin(),
	],
};
