(function($){

	window.BlankTheme = {

		init : function(){
			this.removeEmptyTextWidget();
			this.createMobileMenu();
		},

		removeEmptyTextWidget : function(){
			$('.textwidget').each(function() {
			       if ($.trim($(this).html()) === '') $(this).parents('.widget_text').remove();
			   });
		},

		createMobileMenu : function(){

			$('#primary-nav-button').sidr({
					name: 'sidr-right',
					side: 'right',
					source: '#primary-nav'
			});

			$('body').on('click', function(){
				$.sidr( 'close' , 'sidr-right' );
			});

			$('#sidr-right, #primary-nav-button').on('click', function(e){
				e.stopPropagation();
			});
		},


	};

	$(document).ready(function(){
		window.BlankTheme.init();
	});

})(jQuery);