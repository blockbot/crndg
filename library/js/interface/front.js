(function($){

	var front = {

		theCorndog: $(".the-corndog"),		
		init: function(){

			front.controls();

		},
		controls: function(){

			$(window).scroll(function(){

				front.theCorndog.css({
					'-webkit-transform': "rotate(" + $(this)[0].scrollY + "deg)",
					'-moz-transform': "rotate(" + $(this)[0].scrollY + "deg)",
					'-ms-transform': "rotate(" + $(this)[0].scrollY + "deg)",
					'-o-transform': "rotate(" + $(this)[0].scrollY + "deg)",
					"transform": "rotate(" + $(this)[0].scrollY + "deg)"
				});

			});

		}

	}; front.init();

})(jQuery);