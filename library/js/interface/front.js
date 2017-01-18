(function($){

	var front = {

		portal: $(window),
		portalWidth: $(window).width(),
		portalHeight: $(window).height(),
		logo: $(".logo"),
		theCorndog: $(".the-corndog"),
		contentContainer: $("#content"),
		timeline: $("#timeline"),
		btnDetails: $("#btn-show-more-info"),
		moreInfo: $("#more-info"),
		moreInfoContent: $("#more-info").find(".container-fluid"),
		reverseBtn: $("#reverse-contain").find(".btn-advance-arrow"),
		advanceBtn: $("#advance-contain").find(".btn-advance-arrow"),
		lastPos: 0,
		workItemCount: $(".work-item").length,
		workItem: null,
		workIndex: 1,
		inFrame: 0,
		btnSwitch: false,
		init: function(){

			front.layoutSlides();

			front.workItem = $("[data-index=" + front.workIndex + "]");

			front.controls();

		},
		controls: function(){

			$(window).scroll(function(){

				front.isScrolling = true;

				front.theCorndog.css({
					'-webkit-transform': "rotate(" + $(this)[0].scrollY + "deg)",
					'-moz-transform': "rotate(" + $(this)[0].scrollY + "deg)",
					'-ms-transform': "rotate(" + $(this)[0].scrollY + "deg)",
					'-o-transform': "rotate(" + $(this)[0].scrollY + "deg)",
					"transform": "rotate(" + $(this)[0].scrollY + "deg)"
				});

				front.slideStop();

				clearTimeout($.data(this, 'scrollTimer'));

			    $.data(this, 'scrollTimer', setTimeout(function() {

 					front.btnSwitch = false;

			        if($(window).scrollTop() === 0){
			        	front.inFrame = 0;
			        	front.hideUIElements();
			        }

			    }, 250));

			});

			front.logo.on("click", function(e){

				e.preventDefault();

				front.hideUIElements();

				$("html, body").animate({scrollTop: 0}, "slow");

			});

			front.reverseBtn.on("click", function(){

				front.btnSwitch = true;

				$("html, body").animate({scrollTop: $(window).height() * front.inFrame - $(window).height()}, "slow");

				front.updateTimeline(false);

			});

			front.advanceBtn.on("click", function(){

				front.btnSwitch = true;

				var offset = front.inFrame + 1;

				$("html, body").animate({scrollTop: $(window).height() * offset}, "slow");

				front.updateTimeline(true);

			});

			front.btnDetails.on("click", function(){

				front.showHideDetails();

			});

			front.timelineControls();

		},
		layoutSlides: function(){

			var about = $("#about"),
				work = $("#work");

			about.css({
				"height": front.portal.height()
			});

			work.css({
				"height": front.portal.height() * front.workItemCount
			});

			var workItems = $(".work-item").detach();

			workItems.each(function(i){

				$(this).css({
					"height": front.portal.height(),
					"left": "0",
					"top": front.portal.height() * i
				});

				$(this).find(".img-contain").css({
					"height": front.portal.height()
				});

			});

			work.append(workItems);

			// kill video for now
			// var iframe = "";

			// iframe += '<iframe src="https://player.vimeo.com/video/164057962?autoplay=1&amp;loop=1&amp;color=ffffff&amp;title=0&amp;byline=0&amp;portrait=0&amp;background=1" '
			// iframe += 'height="' + front.portal.height() + '" ';
			// iframe += 'width="' + front.portal.width() + '" ';
			// iframe += 'frameborder="0" ';
			// iframe += 'webkitallowfullscreen ';
			// iframe += 'mozallowfullscreen ';
			// iframe += 'allowfullscreen>';
			// iframe += '</iframe>';

			// about.append(iframe);

			front.showTimeline();

		},
		showTimeline: function(){

			setTimeout(function(){

				front.timeline.animate({
					"left": "0"
				}, 2000, "easeOutCubic");

			}, 100);

		},
		updateTimeline: function(advance){

			if(advance){
				var workItem = $("[data-index=" + (front.inFrame + 1) + "]");
			} else {
				var workItem = $("[data-index=" + (front.inFrame - 1) + "]");
			}

			$(".timeline-active").removeClass("timeline-active");

			if(workItem.attr("data-work-id")){

				$("[data-timeline-id=" + workItem.attr("data-work-id") + "]").addClass("timeline-active");

				var topPos = front.timeline.position().top + $("[data-timeline-id=" + workItem.attr("data-work-id") + "]").position().top + 14,
					leftPos = front.timeline.width(),
					id = $(".timeline-active").data("timeline-id");

				front.moveBtnDetails(topPos, leftPos);

				front.getProjectDetails(id);

			} else {

			    front.showHideDetails(true);
				front.btnDetails.hide();

			}

		},
		timelineControls: function(){

			front.timeline.on("click", "a", function(e){

				e.preventDefault();

			    $(".timeline-active").removeClass("timeline-active");
			    $(this).addClass("timeline-active");

				front.btnSwitch = true;

				var hash = $(this).attr("data-slide-id"),
					workItem = $("#" + hash),
					workItemIndex = workItem.attr("data-index"),
					distance = workItemIndex * front.portalHeight,
					id = $(".timeline-active").data("timeline-id");


				$("html, body").animate({scrollTop: distance}, "slow");

				var topPos = front.timeline.position().top + $(this).position().top + 14,
					leftPos = front.timeline.width();

				front.moveBtnDetails(topPos, leftPos);

				front.getProjectDetails(id);

			});

		},
		slideStop: function(){

			if($(window).scrollTop() >= front.workItem.offset().top && front.lastPos < $(window).scrollTop()){

				front.lastPos = $(window).scrollTop();

				front.workItem.css({
					"position": "fixed",
					"top": 0
				});

				if(!front.btnSwitch){
					front.updateTimeline(true);
				}

				front.inFrame = front.workIndex;

				if(front.workIndex < front.workItemCount){
					front.workIndex++;
					front.reverseBtn.css("display", "block");
				} else {
					front.advanceBtn.css("display", "none");
				}

				front.workItem = $("[data-index=" + front.workIndex + "]");

			} else if($(window).scrollTop() <= $(window).height() * front.workIndex && front.lastPos > $(window).scrollTop()){

				front.lastPos = $(window).scrollTop();

				front.workItem.css({
					"position": "absolute",
					"top": $(window).height() * (front.workIndex - 1)
				});

				front.inFrame = front.workIndex;

				if(!front.btnSwitch){
					front.updateTimeline(false);
				}

				if(front.workIndex > 1){
					front.workIndex--;
					front.advanceBtn.css("display", "block");
				}

				front.workItem = $("[data-index=" + front.workIndex + "]");

			}

		},
		moveBtnDetails: function(topPos, leftPos){

			front.btnDetails.css({
				"-webkit-transform": "translate3d(" + leftPos + "px," + topPos + "px,0)",
				"-moz-transform": "translate3d(" + leftPos + "px," + topPos + "px,0)",
				"transform": "translate3d(" + leftPos + "px," + topPos + "px,0)"
			}).show();

		},
		showHideDetails: function(close){

			if(front.moreInfo.hasClass("open") || close){

				front.moreInfo.removeClass("open");

				front.btnDetails.text("Details");

				front.moreInfo.css({
					"width": "60%",
					"height": "32%",
					"-webkit-transform": "translate3d(0,0,0)",
					"-moz-transform": "translate3d(0,0,0)",
					"transform": "translate3d(0,0,0)"
				});

				front.moreInfoContent.hide();

			} else {

				var id = $(".timeline-active").data("timeline-id");

				front.getProjectDetails(id);

				front.moreInfo.addClass("open");

				front.btnDetails.text("X");

				front.moreInfo.css({
					"width": "76%",
					"height": "32%",
					"-webkit-transform": "translate3d(-100%,0,0)",
					"-moz-transform": "translate3d(-100%,0,0)",
					"transform": "translate3d(-100%,0,0)"
				});

			}

		},
		getProjectDetails:function(id){

			front.moreInfoContent.hide();
			front.moreInfo.addClass("loading");

			$.ajax({
				type: "get",
				url:"/wp-admin/admin-ajax.php",
				data:{
					action: "get_project",
					id: id
				},
				success: function(data){

					var data = JSON.parse(data);

					front.moreInfo.removeClass("loading");
					front.buildMoreInfoContent(data);

				},
				error: function(e){

					console.log("There was an error: ", e);

				},
				timeout: 3000
			});

		},
		buildMoreInfoContent: function(data){

			var title = data.projectTitle,
				shortDescription = data.projectShortDescription,
				description = data.projectDescription,
				details = data.projectDetails,
				url = data.projectUrl,
				list = "";

			front.moreInfoContent.find("h2").html(title + " <small>" + shortDescription + "</small>");
			front.moreInfoContent.find(".project-description").text(description);

			for(detail in details){

				var detail_escaped = unescape(details[detail]["project_tech"]);

				list += "<li>" + detail_escaped + "</li>";

			}

			front.moreInfoContent.find("ul").html(list);
			front.moreInfoContent.find("a").attr("href", url).text(url);

			front.moreInfoContent.show();

		},
		hideUIElements: function(){

			front.reverseBtn.css("display", "none");
        	$(".timeline-active").removeClass("timeline-active");
        	front.btnDetails.hide();

		}

	}; front.init();

})(jQuery);
