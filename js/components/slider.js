import 'slick-carousel';

/**
 * Slider component
 *
 * @type {object}
 */
const slider = {

	/**
	 * Initialize.
	 *
	 * @return {void}
	 */
	init() {
		this.setProps();
		this.createSlider();
	},

	/**
	 * Set properties and selectors.
	 *
	 * @return {void}
	 */
	setProps() {
		this.sliderContainer = $( '#blank-theme-slider' );
	},

	/**
	 * Create slider.
	 *
	 * @return {void}
	 */
	createSlider() {
		if ( ! this.sliderContainer.length ) {
			return;
		}

		this.sliderContainer.slick();
	}

};

export default slider;
