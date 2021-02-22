var youtube=false;

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

	// Lazy load
	if($('.lazy').length) {
		var lazyLoadInstance=new LazyLoad({
			elements_selector: ".lazy"
		});
	}

 	// Lazy load de videos de youtube
 	if ($('#youtube-video').length>0) {
 		if ($(window).scrollTop()>650) {
 			youtube=true;
 			$('#youtube-video').attr('src', $('#youtube-video').attr('data-src'));
 		}
 	}

	// Intro carousel
	if ($("#introCarousel").length>0) {
		var introCarousel=$(".carousel");
		var introCarouselIndicators=$(".carousel-indicators");
		introCarousel.find(".carousel-inner").children(".carousel-item").each(function(index) {
			(index===0) ?
			introCarouselIndicators.append("<li data-target='#introCarousel' data-slide-to='" + index + "' class='active'></li>") :
			introCarouselIndicators.append("<li data-target='#introCarousel' data-slide-to='" + index + "'></li>");

			$(this).css("background-image", "url('" + $(this).children('.carousel-background').children('img').attr('src') +"')");
			$(this).children('.carousel-background').remove();
		});

		$("#introCarousel").swipe({
			swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
				if (direction=='left') $(this).carousel('next');
				if (direction=='right') $(this).carousel('prev');
			},
			allowPageScroll:"vertical"
		});
	}

	// Testimonials carousel
	if ($("#testimonialsCarousel").length>0) {
		$("#testimonialsCarousel").swipe({
			swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
				if (direction=='left') $(this).carousel('next');
				if (direction=='right') $(this).carousel('prev');
			},
			allowPageScroll:"vertical"
		});
	}

	if ($('#map-implementer').length>0) {
		var map=L.map('map', {
			center: [38.81510115312363, -99.755859375],
			zoom: 4
		});

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		const search=new GeoSearch.GeoSearchControl({
			provider: new GeoSearch.OpenStreetMapProvider(),
			style: 'bar',
			autoClose: true,
			animateZoom: true,
			searchLabel: 'Search by City, State, or ZIP'
		});
		map.addControl(search);

		var markers=new L.MarkerClusterGroup();
		var markersList=[];

		$.ajax({
			url: '/implementers/add',
			type: 'POST',
			dataType: 'json',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		})
		.done(function(obj) {
			for (var i=obj.data.length-1; i>=0; i--) {
				var latlng=new L.LatLng(obj.data[i].lat, obj.data[i].lng);
				var marker=new L.Marker(latlng);
				marker.bindPopup("<div class='row'>"+
					"<div class='col-12'>"+
					"<img src='"+obj.data[i].photo+"' class='img-fluid rounded-3' alt='"+obj.data[i].name+" "+obj.data[i].lastname+"'>"+
					"</div>"+
					"<div class='col-12'>"+
					"<p class='h6 text-center mb-2'>"+obj.data[i].name+" "+obj.data[i].lastname+"</p>"+
					"</div>"+
					"<div class='col-12 text-center'>"+
					"<a href='"+obj.data[i].profile+"' class='btn btn-blue text-white rounded-3 mb-2'>View More</a>"+
					"</div>"+
					"</div>").openPopup();
				markersList.push(marker);
				markers.addLayer(marker);
			}
			map.addLayer(markers);
		})
		.fail(function() {
			Lobibox.notify('error', {
				title: 'Error',
				sound: true,
				msg: 'An error occurred durind the process, please try again.'
			});
		});

		$('#search-name').keyup(delay(function(event) {
			var search=$('#search-name').val();
			$.ajax({
				url: '/implementers/search',
				type: 'POST',
				dataType: 'json',
				data: {search: search},
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			})
			.done(function(obj) {
				map.eachLayer(function(layer) {
					if (layer instanceof L.MarkerClusterGroup) {
						map.removeLayer(layer);
					}
				});
				map.setView([38.81510115312363, -99.755859375], 4);

				var markers=new L.MarkerClusterGroup();
				var markersList=[];

				for (var i=obj.data.length-1; i>=0; i--) {
					var latlng=new L.LatLng(obj.data[i].lat, obj.data[i].lng);
					var marker=new L.Marker(latlng);
					marker.bindPopup("<div class='row'>"+
						"<div class='col-12'>"+
						"<img src='"+obj.data[i].photo+"' class='rounded-3' alt='"+obj.data[i].name+" "+obj.data[i].lastname+"'>"+
						"</div>"+
						"<div class='col-12'>"+
						"<p class='h6 text-center mb-2'>"+obj.data[i].name+" "+obj.data[i].lastname+"</p>"+
						"</div>"+
						"<div class='col-12 text-center'>"+
						"<a href='"+obj.data[i].profile+"' class='btn btn-blue text-white rounded-3 mb-2'>View More</a>"+
						"</div>"+
						"</div>").openPopup();
					markersList.push(marker);
					markers.addLayer(marker);
				}
				map.addLayer(markers);
			})
			.fail(function() {
				Lobibox.notify('error', {
					title: 'Error',
					sound: true,
					msg: 'An error occurred durind the process, please try again.'
				});
			});
		}, 1000));
	}
})(jQuery);

// Desplazamiento de menu al scrolear
$(window).scroll(function (event) {
	if ($('#header.header-absolute').length>0) {
		if ($(window).scrollTop()>550) {
			$('#header.header-absolute img').attr('src', '/web/img/logo.png');
			$('#header.header-absolute').addClass('header-fixed');
		} else {
			$('#header.header-absolute img').attr('src', '/web/img/logo-white.png');
			$('#header.header-absolute').removeClass('header-fixed');
		}
	}
});

// Lazy load de videos de youtube
$(window).scroll(function (event) {
	if ($('#youtube-video').length>0 && youtube==false) {
		// if ($(window).scrollTop()>650) {
			youtube=true;
			$('#youtube-video').attr('src', $('#youtube-video').attr('data-src'));
		// }
	}
});

function delay(fn, ms) {
	let timer=0;
	return function() {
		clearTimeout(timer);
		timer=setTimeout(fn, ms || 0);
	}
}

//funciones para abrir modal de enviar mensaje
function sendMessageModal(slug) {
	$("#modal-send-message").modal();
	$('#formSendMessage').attr('action', '/implementers/' + slug + '/message');
}

//Cargar mas implementadores en la lista
$('#more-implementers').click(function(event) {
	$('#more-implementers').addClass('d-none');
	$('#loader-more-implementers').removeClass('d-none');
	var offset=$('.card-vertical-implementer').length, limit=6;
	$.ajax({
		url: '/implementers/add/'+offset+'/'+limit,
		type: 'POST',
		dataType: 'json',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	})
	.done(function(obj) {
		for (var i=0; i<obj.data.length; i++) {
			var title="<span class='badge badge-orange rounded-pill py-2 px-3'>Certified</span>";
			if(obj.data[i].title==2) {
				title="<span class='badge badge-secondary rounded-pill py-2 px-3'>Professional</span>";
			}
			$('#list-implementers').append('<div class="col-xl-4 col-lg-6 col-md-6 col-12 my-4">'+
				'<div class="card card-vertical-implementer rounded-3 py-0">'+
				'<div class="card-body p-3">'+
				'<div class="row">'+
				'<div class="col-lg-5 col-12 mb-3">'+
				'<img src="'+obj.data[i].photo+'" class="rounded-3" alt="'+obj.data[i].name+" "+obj.data[i].lastname+'">'+
				'</div>'+
				'<div class="col-lg-7 col-12 mb-3">'+
				'<h4 class="card-title text-primary font-weight-bold mb-1">'+obj.data[i].lastname+', '+obj.data[i].name+'</h4>'+
				'<p class="h6 text-muted mb-2">'+title+'</p>'+
				'<p class="h6 text-muted mb-0"><b>YPO Chapter:</b></p>'+
				'<p class="h6 text-muted small mb-2">'+obj.data[i].ypo_chapter+'</p>'+
				'<p class="h6 text-muted mb-0"><b>Service Area:</b></p>'+
				'<p class="h6 text-muted small mb-2">'+obj.data[i].service_area+'</p>'+
				'<p class="h6 text-muted mb-0"><b>Home Base:</b></p>'+
				'<p class="h6 text-muteds small mb-0">'+obj.data[i].address+'</p>'+
				'</div>'+
				'<div class="col-12">'+
				'<a href="javascript:void(0);" class="btn btn-blue text-white rounded-3 py-2 px-4 mr-4 mb-2">Send Message</a>'+
				'<a href="'+obj.data[i].profile+'" class="btn btn-white text-blue font-weight-bold rounded-3 border py-2 px-4 mb-2">View More</a>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'</div>'+
				'</div>');
		}
		if (obj.last===false) {
			$('#more-implementers').removeClass('d-none');
		}
		$('#loader-more-implementers').addClass('d-none');
	})
	.fail(function() {
		Lobibox.notify('error', {
			title: 'Error',
			sound: true,
			msg: 'An error occurred durind the process, please try again.'
		});
	});
});