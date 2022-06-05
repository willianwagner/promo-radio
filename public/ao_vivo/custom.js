/**
 * Equal Heights Plugin
 * Equalize the heights of elements. Great for columns or any elements
 * that need to be the same size (floats, etc).
 *
 * Version 1.0
 * Updated 12/109/2008
 *
 * Copyright (c) 2008 Rob Glazebrook (cssnewbie.com)
 *
 * Usage: $(object).equalHeights([minHeight], [maxHeight]);
 *
 * Example 1: $(".cols").equalHeights(); Sets all columns to the same height.
 * Example 2: $(".cols").equalHeights(400); Sets all cols to at least 400px tall.
 * Example 3: $(".cols").equalHeights(100,300); Cols are at least 100 but no more
 * than 300 pixels tall. Elements with too much content will gain a scrollbar.
 *
 */

(function($) {
	$.fn.equalHeights = function(minHeight, maxHeight) {
		tallest = (minHeight) ? minHeight : 0;
		this.each(function() {
			if($(this).height() > tallest) {
				tallest = $(this).height();
			}
		});
		if((maxHeight) && tallest > maxHeight) tallest = maxHeight;
		return this.each(function() {
			$(this).height(tallest).css();
		});

	}
})(jQuery);


/* Start BX slider*/
jQuery(document).ready(function($){
/* BX slider 1*/
   if ($('.slider1').length){
		$('.slider1').bxSlider({ slideWidth: 2200,  minSlides: 1, maxSlides: 8, slideMargin: 0,  speed: 1500, auto: true });
    }
  if ($('.slider2').length){
		$('.slider2').bxSlider({  mode: 'fade', slideWidth: 740, minSlides: 1, maxSlides: 8, slideMargin: 0,  speed: 1500, auto: true });
    }
	if ($('.slider3').length){
		$('.slider3').bxSlider({ slideWidth: 740, mode: 'horizontal',  useCSS: false, easing: 'easeOutElastic',  speed: 2000 });
    }
	if ($('.slider4').length){
		$('.slider4').bxSlider({ slideWidth: 370, minSlides: 1, maxSlides: 1, slideMargin: 0,  speed: 1000  });
    }
	if ($('.slider5').length){
		$('.slider5').bxSlider({ slideWidth: 572,  mode: 'horizontal',  useCSS: false, easing: 'easeOutElastic', minSlides: 1, maxSlides: 1, slideMargin: 0,  speed: 2000 });
    }
	if ($('.slider6').length){
		$('.slider6').bxSlider({ mode: 'fade',  slideWidth: 246, minSlides: 1, maxSlides: 1, slideMargin: 0,  speed: 1000, auto: true, pager: false });
    }
	if ($('.slider7').length){
		$('.slider7').bxSlider({ slideWidth: 740,  minSlides: 3, maxSlides: 9, slideMargin: 30,  speed: 2000, auto: true, pager: false });
    }
	if ($('.slider8').length){
		$('.slider8').bxSlider({ slideWidth: 570,  mode: 'horizontal',  useCSS: false, easing: 'easeOutElastic', minSlides: 1, maxSlides: 8, slideMargin: 0,  speed: 1500, pager: false });
    }
	if ($('.slider9').length){
		$('.slider9').bxSlider({ slideWidth: 770,  mode: 'horizontal',  useCSS: false, easing: 'easeOutElastic', minSlides: 1, maxSlides: 8, slideMargin: 0,  speed: 1500 });
    }
	if ($('.slider10').length){
		$('.slider10').bxSlider({ slideWidth: 1170,  mode: 'horizontal',  useCSS: false, easing: 'easeOutElastic', minSlides: 1, maxSlides: 8, slideMargin: 0,  speed: 1500 });
    }
	if ($('.slider11').length){
		$('.slider11').bxSlider({ slideWidth: 311,  mode: 'horizontal',  useCSS: false, easing: 'easeOutElastic', minSlides: 1, maxSlides: 8, slideMargin: 0,  speed: 1500 });
    }
	if ($('.slider12').length){
		$('.slider12').bxSlider({ mode: 'horizontal', slideWidth: 700,  minSlides: 1, maxSlides: 8, slideMargin: 0,  speed: 2500, auto: true, pager: false });
    }
/* BX slider 1*/

	/* Bootstrap Tooltip */
	 $("[rel='tooltip']").tooltip();
	 /* Bootstrap Tooltip */

    /* Start of Counter */
    var austDay = new Date();
    austDay = new Date(2013, 8 - 1, 5, 11, 00);
    $('#new_counter').countdown({ until: austDay });
    $('#year').text(austDay.getFullYear());
	/* End of Counter */

		$('.show_share').hide();
		$('.show_search').hide();


	$('#show_share').click(function(event){
		event.preventDefault();
		$('.show_search').hide(0);
		$('.show_share').show(1500);

	});

	$('#show_search').click(function(event){
		event.preventDefault();
		$('.show_share').hide(0);
		$('.show_search').show(1500);
	});
	/* Equal Heights
	$(".eq-col").equalHeights();
	 Equal Heights */

});
/* End BX slider*/

// $(function() {
// 	var stream = {
// 		title: "Amizade 98.7 fm",
// 		mp3: "http://174.37.99.198:9284/;"
// 	},
// 	ready = false;

// 	$("#jquery_jplayer_4").jPlayer({
// 		ready: function (event) {
// 			ready = true;
// 			$(this).jPlayer("setMedia", stream);
// 		},
// 		pause: function() {
// 			$(this).jPlayer("clearMedia");
// 		},
// 		error: function(event) {
// 			console.log(event);
// 			if(ready && event.jPlayer.error.type === $.jPlayer.error.URL_NOT_SET) {
// 				$(this).jPlayer("setMedia", stream).jPlayer("play");
// 			}
// 		},
// 		swfPath: $base_url+"assets/swf/Jplayer.swf",
// 		// supplied: "m4a",
// 		supplied: "mp3",
// 		preload: "none",
// 		wmode: "window",
// 		keyEnabled: true,
// 		cssSelectorAncestor: "#jp_container_4",
// 		volume: 1,
// 	});

// 	var $pc = $('#promocao_counter');
// 	if( $pc.length>0 ) {
// 		var $date = new Date( $pc.data("year"), $pc.data("month")-1, $pc.data("day"), $pc.data("hour"), $pc.data("minute") );
// 		$pc.countdown({ until: $date });
// 	}

// 	var $slidetwitter = $('.slidertwitter');
// 	if ( $slidetwitter.length ){
// 		$.ajax({
// 			cache   : false,
// 			// data    : $( $form ).serialize(),
// 			url     : $base_url+"redes/twitter/load/MANOCHANGES/10",
// 			type    : "get",
// 			dataType: "json",

// 			complete: function() { },

// 			success  : function( $data_ajax ) {
// 				try {
// 					if( $data_ajax.length>0 ) {
// 						for( var $i in $data_ajax ) {
// 							var $tweet = $data_ajax[$i];

// 							$slidetwitter.append('<div class="slide"><p><a target="_blank" href="http://twitter.com/MANOCHANGES/">@'+$tweet.user.screen_name+'</a> — <a target="_blank" href="http://twitter.com/MANOCHANGES/status/'+$tweet.id_str+'"><em> '+$tweet.text+'</em></a></p></div>');
// 						}
// 						$('.slidertwitter').bxSlider({ mode: 'horizontal', slideWidth: 700,  minSlides: 1, maxSlides: 8, slideMargin: 0,  speed: 2500, auto: true, pager: false });
// 					}
// 				} catch (e) { }
// 			},

// 			error   : function() { },
// 		});
// 	};

// 	$("[name=telefone]").mask( "(99) 9999-9999?9" );
// 	$('.validate-form').each(function() {
// 		$(this).validate({
// 			submitHandler: function( $form ) {
// 				var $form = $($form);
// 				var $submit = $form.find( "[type=submit]" );
// 				$submit.attr( "disabled", "disabled" ).css( "opacity", .6 );
// 				$.ajax({
// 					cache   : false,
// 					data    : $form.serialize(),
// 					url     : $form.attr("action"),
// 					type    : $form.attr("method"),
// 					dataType: "json",

// 					complete: function() {
// 						$submit.removeAttr( "disabled" ).css( "opacity", 1 );
// 					},

// 					success  : function( $data ) {
// 						try {
// 							if ( $data.success == true ) {
// 								alert( $data.message );
// 								$form.reset()
// 							} else if( !$data.success ) {
// 								alert( $data.message );
// 							}
// 						} catch (e) {
// 							alert( "Falha ao processar sua solicitação, por favor tente mais tarde!" );
// 						}
// 					},

// 					error   : function() {
// 						alert( "Falha ao processar sua solicitação, por favor tente mais tarde!" );
// 					},
// 				});
// 			}
// 		});
// 	});
// });