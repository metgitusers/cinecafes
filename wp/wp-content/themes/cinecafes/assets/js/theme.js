// JavaScript Document

//Banner Carousel
var bs = $('#banner-carousel');
bs.owlCarousel({
	autoplay:false,
	//autoplayTimeout:1000,
	//autoplaySpeed:700,
    loop:true,
    nav:true,
	dots:false,
	//animateOut: 'fadeOut',
    items: 1,
	navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],	
});

//Visiters Carousel
var vs = $('#visiters-carousel');
vs.owlCarousel({
	autoplay:false,
	//autoplayTimeout:1000,
	//autoplaySpeed:700,
    loop:true,
    nav:true,
	dots:false,
	//animateOut: 'fadeOut',
    items: 1,
	navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],	
});










