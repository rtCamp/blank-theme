/**
 * Post css configuration.
 *
 * @type {Object}
 */
module.exports = {

	syntax: 'postcss-scss',

	plugins: {
		'autoprefixer': {},

		'postcss-sort-media-queries': {
			sort: 'mobile-first'
		},

		'postcss-assets': {
			loadPaths: [ 'src/img/', 'src/fonts/' ],
			relative: true
		},

		'postcss-pxtorem': {
			rootValue: 16,
			unitPrecision: 5,
			propList: [ '*' ],
			selectorBlackList: [],
			replace: true,
			mediaQuery: false,
			minPixelValue: 2
		},

	}
};
