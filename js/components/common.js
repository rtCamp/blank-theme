jQuery( function( $ ) {

	'use strict';

	window.BlankTheme = {
		$backToTop: $( '#blank-theme-back-to-top' ),

		init: function() {
			this.createMobileMenu();

			// Enable to animate child menu
			// this.animateMenu();

			// Enable to trigger slider
			// this.createSlider();

			this.fixAdminBar();
			this.events();
		},

		events: function() {

		},

		createSlider: function() {
			if ( $( '#blank-theme-slider' ).length ) {
				$( '#blank-theme-slider' ).slick( {

					// Custom Option
				} );
			}
		},

		fixAdminBar: function() {
			var $adminBar = $( '#wpadminbar' );

			// Mmenu sometimes wrapes adminbar inside its div.
			if ( $( 'div.mm-page' ).length && $( 'div.mm-page' ).find( $adminBar ).length ) {
				$( 'body' ).append( $adminBar );
			}
		},

		createMobileMenu: function() {
			$( '#site-navigation' ).mmenu( { }, { clone: true } );
			$( '#mm-site-navigation' ).removeClass( 'blank-theme-main-navigation' );
		},

		animateMenu: function() {
			$( '.blank-theme-main-navigation ul ul' ).addClass( 'animated-menu fadeInUp' );
		},

		showBacktoTop: function( $this ) {
			if ( $this.width() > 960 ) {

				if ( $this.scrollTop() > 50 ) {
					this.$backToTop.show();
				} else {
					this.$backToTop.hide();
				}
			}
		},

		backToTop: function() {
			$( 'body, html' ).animate( { scrollTop: 0 }, 600 );
			return false;
		}
	};

	window.BlankTheme.init();

} );
