/**
 * External dependencies
 */
import WebFontLoader from 'webfontloader';

/**
 * WebFont
 *
 * @type {Object}
 */
const WebFont = {
	/**
	 * Initialize.
	 *
	 * @return {void}
	 */
	init() {
		this.loadWebFonts();
	},

	/**
	 * Load Google Fonts.
	 *
	 * @return {void}
	 */
	loadWebFonts() {
		const WebFontConfig = {
			google: {
				families: [ 'Open Sans:300,400,700' ],
			},
		};

		WebFontLoader.load( WebFontConfig );
	},
};

export default WebFont;
