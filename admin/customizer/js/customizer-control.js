/**
 *  Contains custom scripts
 */

(function( $, window , undefined ){

    "use strict";


    window.Rtpcc = {
                      Models  : {},
                      Views   : {}
                    };


	/*==============================
                FONT
    ===============================*/

    Rtpcc.Models.Font = Backbone.Model.extend({

        defaults: {
            php_function    : '',
            font_value 		: '',
        }

    });


    Rtpcc.Views.Font = Backbone.View.extend({

        el : '#accordion-panel-blank_theme_general_panel',

        events: {
        	'change #customize-control-blank_theme_special_font select' : 'loadSpecialFontSubset',
        	'change #customize-control-blank_theme_body_font select' : 'loadBodyFontSubset'
        },

        initialize: function(){

        },

        loadSpecialFontSubset : function(e)
        {
        	this.load( e , 'blank_theme_special_font' , 'blank_theme_special_font_variant', 'blank_theme_special_font_subset' );
        },

        loadBodyFontSubset : function(e)
        {
        	this.load( e , 'blank_theme_body_font' , 'blank_theme_body_font_variant', 'blank_theme_body_font_subset' );
        },

        load : function( e , $fontKey , $variantKey, $subsetKey )
        {
            var $this  = e ? $(e.currentTarget) : this.obj($fontKey),
            $option    = false,
            _this      = this,
            $variantEl = this.obj($variantKey),
            $subsetEl  = this.obj($subsetKey);

            $.ajax({
              url: ajaxurl + '?action=blank_theme_load_variants_subsets',
              data : {
                 'font_value' : $this.val()
              }
            }).done(function(resp) {
                resp = JSON.parse(resp);
              _this.fillOptions( $variantEl , resp.variants );
              _this.fillOptions( $subsetEl , resp.subsets );
            });
        },

        obj : function( $key )
        {
            return $('#customize-control-'+ $key ).find('select');
        },

        fillOptions : function( $el, $obj )
        {
            if( ! $el || ! $obj ) return;

            $el.empty(); // remove old options
            $.each( $obj , function(value,key) {
              $el.append( $("<option></option>").attr("value", key).text(key) );
            });
        },

    });

    $(document).ready(function(){
    	new Rtpcc.Views.Font( { model : new Rtpcc.Models.Font() } );
    });



})( jQuery , window, undefined );

