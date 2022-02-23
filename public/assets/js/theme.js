	$(document).ready(function() {
			$('.stellarnav').stellarNav({
				theme: 'light',
				breakpoint: 991,
				position: 'right',
				//phoneBtn: '(780) 743-1904',
				//locationBtn: 'https://www.google.com/maps'
			});
		
	$(".caret-d").click(function(){
		$(".search-list").slideToggle();
	});


$('#slider-for').slick({
 slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  //fade: true,
  infinite: true,
  autoplay: true,
  autoplaySpeed: 4000,
});

		
			
});
