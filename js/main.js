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

		createMobileMenu : function()
		{
			$('#site-navigation').mmenu( {
				navbars		: [{
					content: ["searchfield"]
				}, true]},
				{clone:true});

			$('#mm-site-navigation').removeClass('main-navigation');
		},

	};

	$(document).ready(function(){
		window.BlankTheme.init();
	});

})(jQuery);