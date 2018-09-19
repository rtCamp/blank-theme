/**
 * Post css configuration.
 *
 * @type {Object}
 */
module.exports = {

	syntax: 'postcss-scss',

	plugins: {

		'autoprefixer': {
			browsers: [
				'Firefox >= 50',
				'Chrome >= 55',
				'ChromeAndroid >= 55',
				'Safari >= 10',
				'Opera >= 42',
				'iOS >= 9',
				'Edge >= 13',
				'Explorer >= 9',
				'ExplorerMobile >= 11',
				'Android >= 55'
			]
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

		'css-mqpacker': {
			sort: true
		}

	}
};
