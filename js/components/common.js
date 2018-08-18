/**
 * Common JS.
 *
 * @type {Object}
 */
const common = {

	/**
	 * Initialize.
	 *
	 * @return {void}
	 */
	init() {
		this.setProps();
		this.bindEvents();
	},

	/**
	 * Bind events.
	 *
	 * @return {void}
	 */
	bindEvents() {
		this.backToTopButton.on( 'click', this.goBackToTop );
	},

	/**
	 * Set properties and selectors.
	 *
	 * @return {void}
	 */
	setProps() {
		this.backToTopButton = $( '#blank-theme-back-to-top' );
		this.bodyHtml = $( 'body, html' );
	},

	/**
	 * Handles back to top.
	 *
	 * @return {void}
	 */
	goBackToTop() {
		const animationDuration = 600;

		this.bodyHtml.animate( {
			scrollTop: 0
		}, animationDuration );
	}

};

export default common;
