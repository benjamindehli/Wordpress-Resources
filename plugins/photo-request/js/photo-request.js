(function($) {

	function getRequestedPhotos(){
		return localStorage.getItem("requested-photos") !== null ? JSON.parse(localStorage.getItem("requested-photos")) : [];
	}

	function notRequested(photo, requestedPhotos){
		var url = photo.url;
		var notRequested = true;
		$(requestedPhotos).each(function(){
			if (this.url == url) notRequested = false;
		});
		return notRequested;
	}

	function requested(url, requestedPhotos){
		var requested = false;
		$(requestedPhotos).each(function(){
			if (this.url == url) requested = true;
		});
		return requested;
	}

	function getRequestedPhotosCount(){
		var requestedPhotosArray = localStorage.getItem("requested-photos") !== null ? JSON.parse(localStorage.getItem("requested-photos")) : [];
		return requestedPhotosArray.length;
	}

	function initializePhotoCart() {
		$(".tm-navbar-container").append("<div class='photo-cart'><a href='/request-photos'><span class='number-of-photos'></span><span class='icon uk-icon uk-icon-shopping-cart'></span></a></div>");
	}

	function addPlaceholderForRequestedPhotos(){
		var htmlContent = "<div class='requested-photo-item no-requested-photo'>"
						+ "<p>No photos requested<p>"
						+ "<p>Add photos from the <a href='/gallery'>gallery</a> by clicking the <span class='uk-icon uk-icon-cart-arrow-down'></span> icon</p>"
						+ "</div>";
		$("#requested-photos").append(htmlContent);
	}

	function updatePhotoCart() {
		var numberOfPhotos = getRequestedPhotosCount();
		$(".photo-cart .number-of-photos").html(numberOfPhotos);
		if (numberOfPhotos == 0){
			addPlaceholderForRequestedPhotos();
		}
	}

	function removeRequestedPhoto(url, requestedPhotos){
		var updatedPhotoArray = [];
		$(requestedPhotos).each(function(){
			if (this.url != url) updatedPhotoArray.push(this);
		});
		localStorage.setItem("requested-photos", JSON.stringify(updatedPhotoArray));
		updatePhotoCart();
	}

	function updatePhotoCartButtons(){
		var requestedPhotos = getRequestedPhotos();
		$(".localstorage-add-photo").each(function() {
			var url = $(this).data("photo-url");
			if (requested(url, requestedPhotos)) $(this).addClass("checked");
		})
	}

	$(document).ready(function (){
		initializePhotoCart();
		updatePhotoCart();
		updatePhotoCartButtons();

		$(".localstorage-add-photo").click(function(){
			var url = $(this).data("photo-url");
			var thumbnail = $(this).data("photo-thumbnail");
			var gallery = $(this).data("photo-gallery");
			var caption = $(this).data("photo-caption");
			var description = $(this).data("photo-description");
			var requestedPhotos = getRequestedPhotos();
			var requestedPhoto = {
				"url" : url,
				"thumbnail" : thumbnail,
				"gallery" : gallery,
				"caption" : caption,
				"description" : description
			};
			if (notRequested(requestedPhoto, requestedPhotos)){
				requestedPhotos.push(requestedPhoto);
				localStorage.setItem("requested-photos", JSON.stringify(requestedPhotos));
			}
			updatePhotoCart();
			updatePhotoCartButtons();
		});

		$(document).on("click", ".localstorage-remove-photo", function(){
			var url = $(this).data("photo-url");
			var requestedPhotos = getRequestedPhotos();
			removeRequestedPhoto(url, requestedPhotos);
			$(this).closest(".requested-photo-item").remove();
		});

		

		$("#requested-photos").ready(function (){
			var requestedPhotos = getRequestedPhotos();
			if (requestedPhotos.length){
				$(requestedPhotos).each(function(){
					var htmlContent = "<div class='requested-photo-item'>"
									+ "<div class='uk-grid'>"
									+ "<div class='uk-width-small-2-6 uk-width-medium-1-6'><img src='" + this.thumbnail + "' /></div>"
									+ "<div class='uk-width-small-3-6 uk-width-medium-4-6'><span class='requested-photo-title'>" + this.gallery + " - " + this.caption + "</span><span class='requested-photo-description'>" + this.description + "</span></div>"
									+ "<div class='uk-width-small-1-6 uk-width-medium-1-6'><span class='localstorage-remove-photo uk-button' data-photo-url='" + this.url + "'>Remove</span></div>"
									+ "</div></div>";
					$("#requested-photos").append(htmlContent);
				});
			}
		});
		


		// Add stylesheet
		var cb = function () {
        var l = document.createElement('link');
        l.rel = 'stylesheet';
        l.href = '/wp-content/plugins/photo-request/css/photo-request.css';
        var h = document.getElementsByTagName('head')[0];
        h.parentNode.insertBefore(l, h);
	    };
	    var raf = requestAnimationFrame || mozRequestAnimationFrame ||
	        webkitRequestAnimationFrame || msRequestAnimationFrame;
	    if (raf) raf(cb);
	    else window.addEventListener('load', cb);

	});

}(jQuery));