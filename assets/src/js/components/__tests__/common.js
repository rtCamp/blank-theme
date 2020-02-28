import * as components from '../index';

describe( 'Common js module', () => {

	it( 'Should have init', () => {
		expect( components.common.init() ).toBeTruthy();
	} );

} );
