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
			$('#primary-nav-button').sidr({
					name: 'sidr-right',
					side: 'right',
					source: '#site-navigation',
					onOpen : function(){
						var $els = $('.sidr-class-menu-item-has-children');
						var $a;
						$els.each(function(){
							$a = $(this).find(' > a');
							if( ! $a.find('span').length ){
								$a.append("<span class='plus-oc' >+</span>");
							}
						});
					},
			});

			$(document).on( 'click', '.plus-oc', function(e){
				e.preventDefault();
				if( $(this).html() == '+' ){
					$(this).html('-');
				}else{
					$(this).html('+');
				}
				$(this).closest('li').find( '> ul' ).slideToggle();
			});

			$('#page').on('click', function(){
				$.sidr( 'close' , 'sidr-right' );
			});

			$('#primary-nav-button').on('click', function(e){
				e.stopPropagation();
			});
		},


	};

	$(document).ready(function(){
		window.BlankTheme.init();
	});

})(jQuery);