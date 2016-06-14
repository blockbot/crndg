(function($){

	var baseName = window.location.origin + "/wp-content/themes/crndg",
		scriptsArray = [
			"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700",
			baseName + "/library/bower_components/bootstrap/dist/css/bootstrap.min.css", 
			baseName + "/library/css/main.css"
		],
		cb = function() {

			for(var i = 0; i < scriptsArray.length; i++){

				var l = document.createElement('link'); 

				l.rel = 'stylesheet';
				l.href = scriptsArray[i];
				
				var h = document.getElementsByTagName('head')[0]; 

				h.parentNode.insertBefore(l, h);

			}			
		
		};

		var raf = requestAnimationFrame || mozRequestAnimationFrame ||
				  webkitRequestAnimationFrame || msRequestAnimationFrame;
		
		if (raf) raf(cb);
		else window.addEventListener('load', cb);

})(jQuery);