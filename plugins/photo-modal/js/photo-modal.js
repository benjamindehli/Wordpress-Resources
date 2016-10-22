(function($) {
	function updateMasonry() {
	    var container = $('.masonry-row').masonry({
	        itemSelector: '.masonry-item',
	        columnWidth: '.masonry-item',
	        percentPosition: true
	    });
	    container.imagesLoaded(function () {
	        container.masonry();
	    });
	    container.masonry('reloadItems');
	    container.masonry('layout');
	}

	$(window).on('load', function () {
	    updateMasonry();
	});

	window.onscroll = function() {myFunction()};

	function myFunction() {
			var scrollPosition = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
	    	var margintop = 150 - (scrollPosition*0.2);
	    	var opacity = 1.0 - (scrollPosition / 400)
	        $("#main-title").css('margin-top', margintop + "px");
	        $("#main-title").css('opacity', opacity);
	}

	function toggleModalItem(element){
		$("#" + element.data("activate-item")).addClass("modal-active");
		$("#" + element.data("deactivate-item")).removeClass("modal-active");
	}

	function togglePrevModalItem(){
		var activeModalId = $(".modal-active").attr("id");
        	if ($("#" + activeModalId + "-toggle-prev").length){
        		var toggleButton = $("#" + activeModalId + "-toggle-prev");
        		toggleModalItem(toggleButton);
        	}
	}

	function toggleNextModalItem(){
		var activeModalId = $(".modal-active").attr("id");
        	if ($("#" + activeModalId + "-toggle-next").length){
        		var toggleButton = $("#" + activeModalId + "-toggle-next");
        		toggleModalItem(toggleButton);
        	}
	}

	$(document).ready(function (){

		// Open modal
		$(".photo-modal:not(.modal-active)").click(function (event) {
			if(event.target.className !== "photo-modal-close" && event.target.className !== "photo-modal-toggle" && event.target.className !== "toggle-icon"){
				$(this).addClass("modal-active");
			}
		});

		// Close modal
		$(".photo-modal-close").click(function () {
			$(".photo-modal").removeClass("modal-active");
		});

		$(document).on("click", ".photo-modal-toggle", function () {
			toggleModalItem($(this));
		});

		$( ".gallery-image" ).on("swiperight", ".photo-modal.modal-active", function(){
			togglePrevModalItem();
		});

		$( ".gallery-image" ).on("swipeleft", ".photo-modal.modal-active", function(){
			toggleNextModalItem();
		});

		// Set max height for image
		$(".photo-modal").click(function(){
			$(".photo-modal .uk-overlay img").css("max-height", $( window ).height() - 96);
		});
		$(".photo-modal-close").click(function () {
			$(".photo-modal .uk-overlay img").css("max-height", "none");
		});
		$( window ).resize(function() {
			$(".photo-modal.modal-active .uk-overlay img").css("max-height", $(this).height() - 96);
		});


		// Add stylesheet
		var cb = function () {
        var l = document.createElement('link');
        l.rel = 'stylesheet';
        l.href = '/wp-content/plugins/photo-modal/css/photo-modal.css';
        var h = document.getElementsByTagName('head')[0];
        h.parentNode.insertBefore(l, h);
	    };
	    var raf = requestAnimationFrame || mozRequestAnimationFrame ||
	        webkitRequestAnimationFrame || msRequestAnimationFrame;
	    if (raf) raf(cb);
	    else window.addEventListener('load', cb);

	});

	$(document).keyup(function(e) {
		if (e.keyCode == 27) { // escape key maps to keycode `27`
        	$(".photo-modal").removeClass("modal-active");
    	}
    	if (e.keyCode == 37) { // left arrow key maps to keycode `37`
    		togglePrevModalItem();
    	}
    	if (e.keyCode == 39) { // right arrow key maps to keycode `39`
    		toggleNextModalItem();
    	}
	});

	
}(jQuery));