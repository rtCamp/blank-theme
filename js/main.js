jQuery(function($){

	"use strict";

	window.BlankTheme = {

		$backToTop 	 : $('#blank-theme-back-to-top'),

		init : function(){
			this.createMobileMenu();
			this.animateMenu();
			this.fixAdminBar();
			this.events();
		},

		events : function(){

		},

		fixAdminBar : function(){
			//mmenu sometimes wrapes adminbar inside its div.
			if( $('div.mm-page').length && $('div.mm-page').find('#wpadminbar').length ){
				var $adminBar = $('#wpadminbar');
				$('body').append($adminBar);
			}
		},

		createMobileMenu : function()
		{
			$('#site-navigation').mmenu( {},
				{clone:true});

			$('#mm-site-navigation').removeClass('blank-theme-main-navigation');
		},

		animateMenu : function(){
			$('.blank-theme-main-navigation ul ul').addClass('animated-menu fadeInUp');
		},

		showBacktoTop : function( $this ){
			if ( $this.width() > 960 ){
				if ( $this.scrollTop() > 50 ) this.$backToTop.show();
				else  this.$backToTop.hide();
			}
		},

		backToTop : function(){
	        $("body,html").animate( { scrollTop: 0 }, 600 );
	        return false;
		},

	};

	window.BlankTheme.init();

});
