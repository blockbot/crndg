(function($){
	var nav = {
		modal: $(document).find("#crndg-modal"),
		modalTitle: $(document).find(".modal-title"),
		modalBody: $(document).find(".modal-body"),
		init: function(){
			nav.bindClicks();
		},
		bindClicks: function(){
			$(".menu-item").on("click", "a", function(e){
				var $this = $(this);

				if(!$this.parent().hasClass("no-modal")){
					e.preventDefault();
					nav.showModal($this);
				}
			});
		},
		showModal: function(btn){
			var parentId = btn.parent().attr("id");

			nav.modal.modal('show');

			if(!nav.modal.hasClass(parentId)){
				nav.modal.addClass(parentId);
				nav.modalTitle.html("Loading...");
				nav.getLinkContent(btn);
			}
		},
		updateModal: function(data){
			nav.modalTitle.html(data.title);
			nav.modalBody.html(data.html);
		},
		getLinkContent: function(btn){
			var page_url = btn.attr("href");

			$.ajax({
				type: "get",
				url:"/wp-admin/admin-ajax.php",
				data:{
					action: "get_utility_page",
					page_url: page_url
				},
				success: function(data){
					var data = JSON.parse(data);
					nav.updateModal(data);
				},
				error: function(e){
					console.log("There was an error: ", e);
				},
				timeout: 3000
			});
		}
	};
	nav.init();
})(jQuery);
