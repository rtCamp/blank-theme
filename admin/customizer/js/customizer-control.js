/**
 *  Contains custom scripts for customizer controls
 */

( function ( $, window, undefined ) {

	"use strict";

	window.BlankThemeCC = {
		Models: { },
		Views: { }
	};

	/*==============================
	 Main
	 ===============================*/

	BlankThemeCC.Views.Main = Backbone.View.extend( {
		el: '',
		events: {
			
		},
		initialize: function () {

		}
	} );

	new BlankThemeCC.Views.Main();

} )( jQuery, window, undefined );

