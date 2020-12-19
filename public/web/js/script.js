(function($) {
	"use strict";
	$('[data-toggle="tooltip"]').tooltip();

	// loader
 	var loader = function() {
 		setTimeout(function() { 
 			if($('#ftco-loader').length > 0) {
 				$('#ftco-loader').removeClass('show');
 			}
 		}, 1);
 	};
 	loader();

	// Intro carousel
	var introCarousel = $(".carousel");
	var introCarouselIndicators = $(".carousel-indicators");
	introCarousel.find(".carousel-inner").children(".carousel-item").each(function(index) {
		(index === 0) ?
		introCarouselIndicators.append("<li data-target='#introCarousel' data-slide-to='" + index + "' class='active'></li>") :
		introCarouselIndicators.append("<li data-target='#introCarousel' data-slide-to='" + index + "'></li>");

		$(this).css("background-image", "url('" + $(this).children('.carousel-background').children('img').attr('src') +"')");
		$(this).children('.carousel-background').remove();
	});

	// $(".carousel").swipe({
	// 	swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
	// 		if (direction == 'left') $(this).carousel('next');
	// 		if (direction == 'right') $(this).carousel('prev');
	// 	},
	// 	allowPageScroll:"vertical"
	// });

	$(window).scroll(function (event) {
		if ($(window).scrollTop()>550) {
			if ($('#header.header-absolute').length>0) {
				$('#header.header-absolute img').attr('src', '/web/img/logo.png');
				$('#header.header-absolute p').removeClass('d-none');
			}
			$('#header').addClass('header-fixed');
		} else {
			if ($('#header.header-absolute').length>0) {
				$('#header.header-absolute img').attr('src', '/web/img/logo-white.png');
				$('#header.header-absolute p').addClass('d-none');
			}
			$('#header').removeClass('header-fixed');
		}
	});
})(jQuery);