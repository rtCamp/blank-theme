/**
 * Post css configuration.
 *
 * @type {Object}
 */
module.exports = {

	syntax: 'postcss-scss',

	plugins: {

		'autoprefixer': {},

		'postcss-pxtorem': {
			rootValue: 16,
			unitPrecision: 5,
			propList: [ '*' ],
			selectorBlackList: [],
			replace: true,
			mediaQuery: false,
			minPixelValue: 2
		},

		'css-mqpacker': {
			sort: true
		}

	}
};
