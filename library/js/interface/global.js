var global = (function($){

	var g = {

		doc: $(document),
		init: function(){
			
			$('.carousel').carousel({
				interval: false
			});

			$('#ic-contact').validator()

			g.controls();

			$(".lazy").lazyload({
				threshold: 200
			});

			$(".lazier").lazyload({
				event: "loadImages"
			});

			$(window).on("load", function() {
				var timeout = setTimeout(function() { $(".lazier").trigger("loadImages") }, 2000);
			});

		},
		controls: function(){

			//jQuery for page scrolling feature - requires jQuery Easing plugin
			g.doc.on("click", ".menu-item a, .ic-scroll-btn", function(event) {

				var $anchor = $(this);

				$('html, body').stop().animate({
					scrollTop: $($anchor.attr('href')).offset().top - 69
				}, 1000, 'easeInOutExpo');
				
				event.preventDefault();

			});

			g.doc.on("click", ".menu-item", function(){

				$(".navbar-collapse").collapse("hide");

			});

		}

	}; g.init();

	return g;

}(jQuery));