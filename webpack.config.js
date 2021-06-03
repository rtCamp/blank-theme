const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const ESLintPlugin = require( 'eslint-webpack-plugin' );
const StyleLintPlugin = require( 'stylelint-webpack-plugin' );
const DependencyExtractionWebpackPlugin = require( '@wordpress/dependency-extraction-webpack-plugin' );

const isProductionMode = process.env.NODE_ENV === 'production';

module.exports = {
	mode: isProductionMode ? 'production' : 'development',

	entry: {
		home: path.resolve( __dirname, 'assets/src/js/home.js' ),
		main: path.resolve( __dirname, 'assets/src/js/main.js' ),
		single: path.resolve( __dirname, 'assets/src/js/single.js' ),
		customizer: path.resolve(
			__dirname,
			'assets/src/js/admin/customizer.js'
		),
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
			{
				test: /\.(png|svg|jpg|jpeg|gif)$/i,
				type: 'asset/resource',
			},
			{
				test: /\.(woff|woff2|eot|ttf|otf)$/i,
				type: 'asset/resource',
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
