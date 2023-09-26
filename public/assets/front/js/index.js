if ($('.new-arrivals')) {
	$('.new-arrivals').owlCarousel({
		loop: true,
		margin: 10,
		responsiveClass: true,
		nav: false,
		dots: false,
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 2
			},
			768: {
				items: 3
			},
			1366: {
				items: 4
			},
			1400: {
				items: 5
			}
		},
	});
}
